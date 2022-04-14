<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

trait APIResponse
{
    /**
     * Send response with success.
     *
     * @param Model|Collection|null $result
     * @param string|null $message
     * @param int $code
     *
     * @return JsonResponse
     */
    protected function sendResponse(Model|Collection $result = null, ?string $message = null, int $code = 200): JsonResponse
    {
        return response()->json($this->makeResponse(true, $result, $message), $code);
    }

    /**
     * Send response with error.
     *
     * @param null $error
     * @param int $code
     * @param Collection|null $data
     *
     * @return JsonResponse
     */
    protected function sendError($error = null, int $code = 400, null|Collection $data = null): JsonResponse
    {
        return response()->json($this->makeResponse(false, $data, $error), $code);
    }

    /**
     * Generate data array for response.
     *
     * @param bool $success
     * @param Model|Collection|null $data
     *
     * @param string|null $message
     *
     * @return array
     */
    protected function makeResponse(bool $success = true, Model|Collection $data = null, ?string $message = null): array
    {
        $result = [
            'success' => $success,
        ];
        if (null !== $data) {
            $result['data'] = $data;
        }
        if (null !== $message) {
            $result['message'] = $message;
        }

        return $result;
    }
}
