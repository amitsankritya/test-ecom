<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class StockFiltersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "brands" => "nullable|string",
            "quantity" => "nullable|integer|min:1",
            "page" => "nullable|integer|min:1|max:100",
            "location" => "nullable|string"
        ];
    }

    /**
     * @param Validator $validator
     * @return JsonResponse
     */
    public function failedValidation(Validator $validator): JsonResponse {

        $json = [
            "success" => false,
            "error" => $validator->getMessageBag()
        ];

        return new JsonResponse($json, 422);
    }
}
