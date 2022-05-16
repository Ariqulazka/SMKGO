<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySchoolRequest;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\Major;
use App\Models\School;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SchoolController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('school_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = School::with(['author', 'majors'])->select(sprintf('%s.*', (new School())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'school_show';
                $editGate = 'school_edit';
                $deleteGate = 'school_delete';
                $crudRoutePart = 'schools';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('school_name', function ($row) {
                return $row->school_name ? $row->school_name : '';
            });
            $table->editColumn('thumbnail_school', function ($row) {
                if ($photo = $row->thumbnail_school) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('contact', function ($row) {
                return $row->contact ? $row->contact : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? School::TYPE_RADIO[$row->type] : '';
            });
            $table->addColumn('author_name', function ($row) {
                return $row->author ? $row->author->name : '';
            });

            $table->editColumn('major', function ($row) {
                $labels = [];
                foreach ($row->majors as $major) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $major->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'thumbnail_school', 'author', 'major']);

            return $table->make(true);
        }

        $users  = User::get();
        $majors = Major::get();

        return view('admin.schools.index', compact('users', 'majors'));
    }

    public function create()
    {
        abort_if(Gate::denies('school_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $majors = Major::pluck('name', 'id');

        return view('admin.schools.create', compact('authors', 'majors'));
    }

    public function store(StoreSchoolRequest $request)
    {
        $school = School::create($request->all());
        $school->majors()->sync($request->input('majors', []));
        if ($request->input('thumbnail_school', false)) {
            $school->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumbnail_school'))))->toMediaCollection('thumbnail_school');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $school->id]);
        }

        return redirect()->route('admin.schools.index');
    }

    public function edit(School $school)
    {
        abort_if(Gate::denies('school_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $majors = Major::pluck('name', 'id');

        $school->load('author', 'majors');

        return view('admin.schools.edit', compact('authors', 'majors', 'school'));
    }

    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update($request->all());
        $school->majors()->sync($request->input('majors', []));
        if ($request->input('thumbnail_school', false)) {
            if (!$school->thumbnail_school || $request->input('thumbnail_school') !== $school->thumbnail_school->file_name) {
                if ($school->thumbnail_school) {
                    $school->thumbnail_school->delete();
                }
                $school->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumbnail_school'))))->toMediaCollection('thumbnail_school');
            }
        } elseif ($school->thumbnail_school) {
            $school->thumbnail_school->delete();
        }

        return redirect()->route('admin.schools.index');
    }

    public function show(School $school)
    {
        abort_if(Gate::denies('school_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->load('author', 'majors');

        return view('admin.schools.show', compact('school'));
    }

    public function destroy(School $school)
    {
        abort_if(Gate::denies('school_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->delete();

        return back();
    }

    public function massDestroy(MassDestroySchoolRequest $request)
    {
        School::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('school_create') && Gate::denies('school_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new School();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
