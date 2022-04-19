<?php

/**
* @author Abdeslam Gacemi <abdobling@gmail.com>
*/

namespace App\Http\Traits;

trait ApiResponse
{
    protected function successResponse(array $data = []): array
    {
        return ['success' => true, 'data' => $data];
    }

    protected function errorResponse(array $errors = []): array
    {
        return ['success' => false, 'errors' => $errors, 'data' => []];
    }
}
