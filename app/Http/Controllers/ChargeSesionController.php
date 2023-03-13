<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use App\Http\Requests\ChargeSessionRequest;

class ChargeSesionController extends Controller
{
    /**
     * Start a charge session or update status
     * @OA\Post (
     *      path="/api/v1/charge",
     *      tags={"Charge Session"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="battery_level",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="status",
     *                          type="string"
     *                      )
     *                  ),
     *                  example={
     *                      "battery_level"="10",
     *                      "status"="waiting"
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
    public function charge(ChargeSessionRequest $request)
    {
        $response = (new HttpService)->charge($request->validated());

        return $this->responder(
            data: $response['data'],
            errors: $response['errors'],
            message: $response['message'],
            status: $response['status']
        );
    }

    /**
     * Get Active Charge Session
     * @OA\Get (
     *     path="/api/v1/charge/active-session",
     *     tags={"Charge Session"},
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
    public function activeSession(){
        $response = (new HttpService)->activeSession();

        return $this->responder(
            data: $response['data'],
            errors: $response['errors'],
            message: $response['message'],
            status: $response['status']
        );
    }

    /**
     * Get Done Charge Sessions
     * @OA\Get (
     *     path="/api/v1/charge/done-sessions",
     *     tags={"Charge Session"},
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
    public function doneSessions(){
        $response = (new HttpService)->doneSessions();

        return $this->responder(
            data: $response['data'],
            errors: $response['errors'],
            message: $response['message'],
            status: $response['status']
        );
    }
}
