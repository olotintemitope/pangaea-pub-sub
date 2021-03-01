<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Repository\TopicRepository;
use Illuminate\Contracts\Validation\Validator;
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
            return $this->sendError($validator->errors());
        }

        try {
            $this->topicRepository->create($request->all());

            return $this->sendResponse([], 201);
        } catch (\RuntimeException $exception) {
            return $this->sendResponse($exception->getMessage());
        }
    }
}
