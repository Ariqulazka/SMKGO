<?php

namespace App\Http\Requests;

use App\Models\School;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSchoolRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('school_create');
    }

    public function rules()
    {
        return [
            'school_name' => [
                'string',
                'required',
                'unique:schools',
            ],
            'thumbnail_school' => [
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'contact' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'author_id' => [
                'required',
                'integer',
            ],
            'majors.*' => [
                'integer',
            ],
            'majors' => [
                'required',
                'array',
            ],
        ];
    }
}
