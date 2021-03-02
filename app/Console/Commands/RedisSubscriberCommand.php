<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use RedisException;

class RedisSubscriberCommand extends Command
{
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
            Redis::subscribe(['topic1'], function ($message) {
                echo $message;
            });
        } catch (RedisException $exception) {
            echo $exception->getMessage();
        }
    }
}
