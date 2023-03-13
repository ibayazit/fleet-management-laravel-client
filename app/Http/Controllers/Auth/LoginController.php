<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\HttpService;

class LoginController extends Controller
{
    /**
     * Login
     * @OA\Post (
     *      path="/api/v1/auth/login",
     *      tags={"Auth"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      )
     *                  ),
     *                  example={
     *                      "email"="ibrbayazit@gmail.com",
     *                      "password"="123123"
     *                  }
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(property="data", type="object"),
     *          )
     *      )
     * )
     */
    public function login(LoginRequest $request)
    {
        $response = (new HttpService)->auth($request->only('email', 'password'));

        return $this->responder(
            data: $response['data'],
            errors: $response['errors'],
            message: $response['message'],
            status: $response['status']
        );
    }
}
