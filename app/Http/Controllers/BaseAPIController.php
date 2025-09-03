<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseAPIController extends Controller
{
    /**
     * Réponse standardisée avec une ressource unique.
     */
    protected function respondWithResource(JsonResource $resource, string $message = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message ?? 'Success',
            'data'    => $resource,
        ], $status);
    }

    /**
     * Réponse générique de succès (sans resource JSONResource).
     */
    protected function respondWithSuccess(mixed $data = null, string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    /**
     * Réponse d’erreur standardisée.
     */
    protected function respondWithError(string $message = 'Error', int $status = 400, mixed $errors = null): JsonResponse
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'errors'  => $errors,
        ], $status);
    }
}
