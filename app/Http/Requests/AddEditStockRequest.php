<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class AddEditStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|string|max:200",
            "brand_id" => "numeric|required",
            "quality_id" => "numeric|required",
            "city_id" => "numeric|required",
            "quantity" => "numeric|required|min:1"
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
