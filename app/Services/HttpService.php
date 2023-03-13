<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HttpService
{
    private $serviceUrl;

    public function __construct()
    {
        $this->serviceUrl = config('fleet-management.service_url');
    }

    private function prepareUrl($path)
    {
        return trim($this->serviceUrl, '/') . '/' . trim($path, '/');
    }

    private function prepareHeaders()
    {
        return [
            'Authorization' => Cache::get('user-auth')
        ];
    }

    private function prepareResponse($response){
        $status = $response->status();
        $data = $response->json();

        return [
            'message' => $data['message'] ?? '',
            'data' => $data['data'] ?? [],
            'errors' => $data['errors'] ?? [],
            'status' => $status
        ];
    }

    private function makeRequest($method = 'post', $path, $data = [])
    {
        $response = Http::withHeaders($this->prepareHeaders())->{$method}($this->prepareUrl($path), $data);

        return $response;
    }

    public function auth($credentials)
    {
        $response = $this->makeRequest(
            method: 'post',
            path: 'auth',
            data: $credentials
        );

        $data = $response->json();
        $token = 'Bearer ' . $data['data']['access_token'];

        Cache::put('user-auth', $token, config('fleet-management.session_life_span'));

        return $this->prepareResponse($response);
    }

    public function user()
    {
        $response = $this->makeRequest(
            method: 'get',
            path: 'auth',
        );

        return $this->prepareResponse($response);
    }

    public function charge($data)
    {
        $response = $this->makeRequest(
            method: 'post',
            path: 'charge-session',
            data: $data
        );

        return $this->prepareResponse($response);
    }

    public function activeSession()
    {
        $response = $this->makeRequest(
            method: 'get',
            path: 'charge-session'
        );

        return $this->prepareResponse($response);
    }

    public function doneSessions()
    {
        $response = $this->makeRequest(
            method: 'get',
            path: 'charge-session/done'
        );

        return $this->prepareResponse($response);
    }
}
