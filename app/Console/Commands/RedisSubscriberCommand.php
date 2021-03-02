<?php

namespace App\Console\Commands;

use App\Http\Repository\TopicRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use RedisException;
use Spatie\WebhookServer\WebhookCall;

class RedisSubscriberCommand extends Command
{
    /**
     * @var TopicRepository
     */
    private $repository;

    public function __construct(TopicRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribe-topic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to a Redis channel';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        try {
            $eventName = 'topic1';

            $topic = $this->repository->slug($eventName);
            $subscribers = $topic->subscribers;

            Redis::subscribe([$eventName], function ($payload) use ($topic, $subscribers) {
                foreach ($this->getOptimizedSubscribers($subscribers) as $url) {
                    WebhookCall::create()
                        ->url($url)
                        ->payload([
                            'topic' => $topic->slug,
                            'data' => json_decode($payload, true, 512, JSON_THROW_ON_ERROR)
                        ])
                        ->useSecret('sampler_must_be_great')
                        ->dispatch();
                }
            });
        } catch (RedisException | \JsonException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param Collection $subscribers
     * @return \Generator
     */
    protected function getOptimizedSubscribers(Collection $subscribers): \Generator
    {
        foreach ($subscribers as $subscriber) {
            yield $subscriber->url;
        }
    }
}
