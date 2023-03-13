<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\OpenApi(
     *      @OA\Info(
     *          version="1.0",
     *          title="Fleet manager client",
     *          description="Fleet manager client swagger documentation"
     *      ) 
     * )
     */
    use AuthorizesRequests, ValidatesRequests;

    public function responder($data = [], $errors = [], $message = null, $status = 200){
        return prepareResponse($data, $errors, $message, $status);
    }
}
