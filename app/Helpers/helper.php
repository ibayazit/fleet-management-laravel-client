<?php

if(!function_exists('prepareResponse')){
    function prepareResponse($data = [], $errors = [], $message = null, $status = 200){
        return response([
            'message' => $message ?? 'Request executed successfully',
            'data' => $data,
            'errors' => $errors,
        ], $status)->header('Content-Type', 'application/json');
    }
}

if(!function_exists('nextChargeStatus')){
    function nextChargeStatus($currentStatus){
        if(in_array($currentStatus, ['fail', 'done'])){
            return null;
        }

        $statuses = config('fleet-management.statuses');
        $status = array_pop($statuses);

        $rand = rand(0, 100);

        if($rand >= 20 && $rand <= 40){
            $status = $statuses[array_search($currentStatus, $statuses) + 1];
        }
        else if($rand > 40){
            $status = null;
        }

        return $status;
    }
}