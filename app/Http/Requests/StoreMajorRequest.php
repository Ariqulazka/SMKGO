<?php

namespace App\Http\Requests;

use App\Models\Major;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMajorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('major_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:majors',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
