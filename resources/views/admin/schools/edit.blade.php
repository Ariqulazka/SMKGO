@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Sekolah
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.schools.update", [$school->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="school_name">Sekolah</label>
                <input class="form-control {{ $errors->has('school_name') ? 'is-invalid' : '' }}" type="text" name="school_name" id="school_name" value="{{ old('school_name', $school->school_name) }}" required>
                @if($errors->has('school_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('school_name') }}
                    </div>
                @endif
                <span class="help-block">Masukka nama sekolah</span>
            </div>
            <div class="form-group">
                <label class="required" for="thumbnail_school">{{ trans('cruds.school.fields.thumbnail_school') }}</label>
                <div class="needsclick dropzone {{ $errors->has('thumbnail_school') ? 'is-invalid' : '' }}" id="thumbnail_school-dropzone">
                </div>
                @if($errors->has('thumbnail_school'))
                    <div class="invalid-feedback">
                        {{ $errors->first('thumbnail_school') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.thumbnail_school_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.school.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $school->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact">{{ trans('cruds.school.fields.contact') }}</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', $school->contact) }}" required>
                @if($errors->has('contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.school.fields.type') }}</label>
                @foreach(App\Models\School::TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', $school->type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author_id">{{ trans('cruds.school.fields.author') }}</label>
                <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" required>
                    @foreach($authors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('author_id') ? old('author_id') : $school->author->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('author'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="majors">{{ trans('cruds.school.fields.major') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('majors') ? 'is-invalid' : '' }}" name="majors[]" id="majors" multiple required>
                    @foreach($majors as $id => $major)
                        <option value="{{ $id }}" {{ (in_array($id, old('majors', [])) || $school->majors->contains($id)) ? 'selected' : '' }}>{{ $major }}</option>
                    @endforeach
                </select>
                @if($errors->has('majors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('majors') }}
                    </div>
                @endif
                <span class="help-block">Pilih jurusan yang terdapat pada sekolah Anda</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.thumbnailSchoolDropzone = {
    url: '{{ route('admin.schools.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="thumbnail_school"]').remove()
      $('form').append('<input type="hidden" name="thumbnail_school" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="thumbnail_school"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($school) && $school->thumbnail_school)
      var file = {!! json_encode($school->thumbnail_school) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="thumbnail_school" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
