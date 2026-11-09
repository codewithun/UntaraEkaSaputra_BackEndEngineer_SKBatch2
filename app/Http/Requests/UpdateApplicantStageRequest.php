<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateApplicantStageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stage' => [
                'required',
                'string',
                Rule::in([
                    'applied',
                    'screening',
                    'interview',
                    'offered',
                    'hired',
                    'rejected',
                ]),
            ],
        ];
    }
}
