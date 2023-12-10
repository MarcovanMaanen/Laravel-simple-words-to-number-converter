<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvertNumberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'input' => 'required|string',
        ];
    }
}