@extends('layouts.admin')
@section('content')
@can('magazine_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.magazine.create') }}">
                Add Magazine
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Magazine List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            SL
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($magazineData as $key => $data)
                        <tr data-entry-id="{{ $data->id }}">
                            <td>

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $data->name ?? '' }}
                            </td>
                            <td>
                                <img src="{{ asset('uploads/magazine/'.$data->image) }}" width="75" height="70">
                            </td>
                            
                            <td>
                                @can('magazine_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.magazine.edit', $data->id) }}">
                                        Edit
                                    </a>
                                @endcan

                                @can('magazine_delete')
                                    <form action="{{ route('admin.magazine.destroy', $data->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection