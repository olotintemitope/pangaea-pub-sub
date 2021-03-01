<?php

namespace App\Http\Controllers\Api;

use App\Http\Repository\SubscriberRepository;
use App\Http\Repository\TopicRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends BaseController
{

    /**
     * @var TopicRepository
     */
    private $topicRepository;
    /**
     * @var SubscriberRepository
     */
    private $subscriberRepository;

    public function __construct(TopicRepository $topicRepository, SubscriberRepository $repository)
    {
        $this->topicRepository = $topicRepository;
        $this->subscriberRepository = $repository;
    }

    /**
     * Subscribe to a topic
     *
     * @param Request $request
     * @param $topic
     * @return JsonResponse
     */
    public function subscribe(Request $request, $topic): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:250'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 400);
        }

        $topic = $this->topicRepository->slug($topic);
        if (null === $topic) {
            return $this->sendError([
                "topic" => "Topic: {$topic} does not exist"
            ]);
        }

        $url = $request->url;
        $topicId = $topic->slug;

        try {
            $this->subscriberRepository->create([
                'topic_id' => $topic->id,
                'url' => $url
            ]);

            return $this->sendResponse([
                'topic' => $topicId,
                'url' => $url
            ], 201);

        } catch (\RuntimeException $exception) {
            return $this->sendError($exception->getMessage(), 400);
        }


    }
}
