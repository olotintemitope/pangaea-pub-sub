<?php

namespace App\Jobs;

use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWebHookRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $topic;
    private $payload;
    private $url;

    public function __construct($topic, $payload, $url)
    {
        $this->topic = $topic;
        $this->payload = $payload;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        $response = null;

        try {
            $response = Http::withHeaders([
                'X-Header-From' => 'pangaea_pub-sub'
            ])->post($this->url, [
                'topic' => $this->topic->slug,
                'data' => $this->payload
            ]);

            return response()->json([], $response->ok());
        } catch (ConnectionException | \RuntimeException $exception) {
            return response()->json([$exception->getMessage()], 500);
        }

    }
}
