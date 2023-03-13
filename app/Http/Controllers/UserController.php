<?php

namespace App\Http\Controllers;

use App\Services\HttpService;

class UserController extends Controller
{
    /**
     * Get Auth User - Requires authentication first
     * @OA\Get (
     *     path="/api/v1/user",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(property="data", type="object"),
     *         )
     *     )
     * )
     */
    public function user()
    {
        $response = (new HttpService)->user();

        return $this->responder(
            data: $response['data'],
            errors: $response['errors'],
            message: $response['message'],
            status: $response['status']
        );
    }
}
