<?php

namespace App\Http\Requests;

use App\Models\Major;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMajorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('major_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:majors,name,' . request()->route('major')->id,
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
