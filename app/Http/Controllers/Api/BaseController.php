<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * Class BaseController
 */
class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @param $response
     * @param int $statusCode
     * @return JsonResponse
     */
    public function sendResponse($response, int $statusCode = 200): JsonResponse
    {

        return response()->json($response, $statusCode);
    }

    /**
     * return error response.
     *
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($errorMessages = [], int $code = 404): JsonResponse
    {
        return response()->json($errorMessages, $code);
    }
}
