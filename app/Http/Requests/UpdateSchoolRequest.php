<?php

namespace App\Http\Requests;

use App\Models\School;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSchoolRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('school_edit');
    }

    public function rules()
    {
        return [
            'school_name' => [
                'string',
                'required',
                'unique:schools,school_name,' . request()->route('school')->id,
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
