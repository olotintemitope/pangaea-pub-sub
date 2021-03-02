<?php

namespace App\Http\Controllers\Api;

use App\Http\Repository\TopicRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TopicController extends BaseController
{
    /**
     * @var TopicRepository
     */
    private $topicRepository;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    /**
     * Create a topic
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|unique:topics|max:250'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 400);
        }

        try {
            $this->topicRepository->create($request->all());

            return $this->sendResponse([], 201);
        } catch (\RuntimeException $exception) {
            return $this->sendResponse($exception->getMessage());
        }
    }

    /**
     * Publish a topic
     *
     * @param Request $request
     * @param $topic
     * @return JsonResponse
     */
    public function publish(Request $request, $topic): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|exists:topics|max:250'
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

        try {
            Redis::publish('topic1', json_encode($request->all(), JSON_THROW_ON_ERROR));
            return response()->json([], Response::HTTP_OK);
        } catch (\JsonException $e) {
            return response()->json([], Response::HTTP_BAD_REQUEST);
        }
    }
}
