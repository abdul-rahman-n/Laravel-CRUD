<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImportCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:xlsx,xls',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Please upload a file.',
            'file.mimes' => 'Only Excel files (xlsx, xls) are supported.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'File upload failed. Please ensure you upload a valid Excel file.')
        );
    }
}
