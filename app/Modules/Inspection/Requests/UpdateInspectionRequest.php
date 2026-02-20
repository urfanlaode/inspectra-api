<?php

namespace App\Modules\Inspection\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInspectionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'scope_of_work_id' => [
                'required',
                'integer',
                'exists:scope_of_works,id',
            ],
            'location_id' => ['required', 'integer', 'exists:locations,id'],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'is_customer_charged' => ['required', 'boolean'],
            'dc_code' => ['nullable', 'string'],
            'estimated_completion_date' => ['nullable', 'date'],
            'status' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],

            // inspection items
            'items' => ['required', 'array'],
            'items.*.item_id' => ['required', 'integer', 'exists:items,id'],
            'items.*.qty_requested' => ['required', 'integer'],
        ];
    }
}
