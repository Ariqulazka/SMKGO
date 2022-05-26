<div>
    <div class="row mb-5 justify-content-center">
        <div wire:model='query' class="col-md-9 col-xl-7 col-xxl-6"><input class="form-control" type="text"
                placeholder="Search..." />
        </div>
    </div>


    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">


        @if (count($schools))
            @foreach ($schools as $school)
                {{-- @dd($school->majors) --}}
                <div class="col">
                    <div class="mt-1"><img class="rounded img-fluid d-block w-100 fit-cover"
                            style="height: 200px; cover; object-fit: cover;"
                            src="{{ $school->thumbnail_school->url }}" />
                        <div class="py-4">
                            <h4>{{ $school->school_name }}</h4>
                            <ul>
                                <li><strong>Alamat :</strong> {{ $school->address }}</li>
                                <li><strong>Kontak :</strong> {{ $school->contact }}
                                </li>
                                <li><strong>{{ trans('Tipe Sekolah') }} :</strong> {{ $school->type }}
                                </li>
                                {{-- <li><strong>{{ trans('global.author') }} :</strong> {{ $school->author->name }}
                                </li> --}}
                                <li><strong>Dibuat pada
                                        :</strong> {{ $school->created_at }}
                                </li>
                                <li><strong>Diperbarui pada
                                        :</strong> {{ $school->updated_at }}
                                </li>
                                <li><strong>Jurusan : </strong>
                                    @foreach ($school->majors as $major)
                                        <a class="text-decoration-none text-light"
                                            href="{{ route('admin.majors.show', $major->id) }}"><span
                                                class="badge rounded-pill bg-info me-1 p-1">{{ $major->name }}</span></a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col m-auto">
                <div class="alert alert-danger" role="alert"><span><strong>Oups.. </strong>Tidak ada data sekolah yang
                        dapat ditampilkan.</span></div>
            </div>
        @endif
    </div>

    <div class="row text-center">
        <div class="col">
            {{ $schools->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
