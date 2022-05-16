@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.school.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.schools.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.id') }}
                        </th>
                        <td>
                            {{ $school->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.school_name') }}
                        </th>
                        <td>
                            {{ $school->school_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.thumbnail_school') }}
                        </th>
                        <td>
                            @if($school->thumbnail_school)
                                <a href="{{ $school->thumbnail_school->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $school->thumbnail_school->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.address') }}
                        </th>
                        <td>
                            {{ $school->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.contact') }}
                        </th>
                        <td>
                            {{ $school->contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\School::TYPE_RADIO[$school->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.author') }}
                        </th>
                        <td>
                            {{ $school->author->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.major') }}
                        </th>
                        <td>
                            @foreach($school->majors as $key => $major)
                                <span class="label label-info">{{ $major->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.schools.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection