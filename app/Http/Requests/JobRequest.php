<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title' => [
                'required', 'string',// 'min:20', 'max:100',
            ],
            'subtitle' => [
                'nullable','string',// 'min:20', 'max:100',
            ],
            'job_description' => [
                'required', 'string', // 'min:50', 'max:1000',
            ],
            'job_type' => [
                'required', 'string',// 'min:5','max:30', // in must be used here
            ],
            'exp_from' => [
                'required', 'integer',
            ],
            'exp_to' => [
                'required', 'integer',
            ],
            'responsibility' => [
                'required', 'string',// 'min:50', 'max:10000',
            ],
            'requirements' => [
                'required', 'string',// 'min:20', 'max:10000',
            ],
            'skills' => [
                'required', 'string',// 'min:20', 'max:10000',
            ],
            'salary' => [
                'required', // 'min:4', 'max:100',
            ],
            'category_id' => [
                'required', 'integer',
            ],
            'active' =>[
                'required', 'integer',
            ],
        ];
    }
}
