<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTranscribeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'image_id' => 'required|exists:App\Models\Image,id',
            'parties' => 'array|required',
            'parties.*.id' => 'required|exists:App\Models\Party,id',
            'parties.*.score' => 'required|numeric',
            'polling_unit_id' => 'required|exists:App\Models\PollingUnit,id',
            'has_corrections' => 'required|boolean',
            'is_unclear' => 'required|boolean',
        ];
    }
}
