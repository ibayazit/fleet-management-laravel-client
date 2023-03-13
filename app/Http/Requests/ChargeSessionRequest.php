<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\HttpService;

class ChargeSessionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return (new HttpService)->user()['status'] == 200;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $statuses = implode(',', config('fleet-management.statuses'));
        return [
            'battery_level' => 'required|integer|min:0|max:100',
            'status' => 'required|in:' . $statuses
        ];
    }
}
