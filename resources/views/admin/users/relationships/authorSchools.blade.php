@can('school_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.schools.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.school.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.school.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-authorSchools">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.school.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.school_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.thumbnail_school') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.contact') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.author') }}
                        </th>
                        <th>
                            {{ trans('cruds.school.fields.major') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $key => $school)
                        <tr data-entry-id="{{ $school->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $school->id ?? '' }}
                            </td>
                            <td>
                                {{ $school->school_name ?? '' }}
                            </td>
                            <td>
                                @if($school->thumbnail_school)
                                    <a href="{{ $school->thumbnail_school->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $school->thumbnail_school->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $school->address ?? '' }}
                            </td>
                            <td>
                                {{ $school->contact ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\School::TYPE_RADIO[$school->type] ?? '' }}
                            </td>
                            <td>
                                {{ $school->author->name ?? '' }}
                            </td>
                            <td>
                                @foreach($school->majors as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('school_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.schools.show', $school->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('school_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.schools.edit', $school->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('school_delete')
                                    <form action="{{ route('admin.schools.destroy', $school->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('school_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.schools.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-authorSchools:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection