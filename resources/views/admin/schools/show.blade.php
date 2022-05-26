@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Tampilkan sekolah
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>

                        <th>
                            ID
                        </th>
                        <td>
                            {{ $school->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nama Sekolah
                        </th>
                        <td>
                            {{ $school->school_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Thumbnail Sekolah
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
                            Alamat
                        </th>
                        <td>
                            {{ $school->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kontak
                        </th>
                        <td>
                            {{ $school->contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tipe
                        </th>
                        <td>
                            {{ App\Models\School::TYPE_RADIO[$school->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Pembuat
                        </th>
                        <td>
                            {{ $school->author->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Jurusan
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
                    Kembali ke daftar
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
