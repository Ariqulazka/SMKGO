@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.major.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.majors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.major.fields.id') }}
                        </th>
                        <td>
                            {{ $major->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.major.fields.name') }}
                        </th>
                        <td>
                            {{ $major->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.major.fields.description') }}
                        </th>
                        <td>
                            {!! $major->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.majors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#major_schools" role="tab" data-toggle="tab">
                {{ trans('cruds.school.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="major_schools">
            @includeIf('admin.majors.relationships.majorSchools', ['schools' => $major->majorSchools])
        </div>
    </div>
</div>

@endsection