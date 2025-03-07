@extends('layouts.admin')
@section('content')
@can('category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.task.create') }}">
                Add Task
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Task List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Assign Date</th>
                        <th>Assign By</th>
                        <th>Deadline</th>
                        <th>Priority</th>
                        <th>Remark</th>
                        <th>Admin Comment</th>
                        <th>Status</th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskData as $key => $data)
                        <tr data-entry-id="{{ $data->id }}">
                            <td>

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name ?? '' }}</td>
                            <td>{{ $data->assign_date ?? '' }}</td>
                            <td>{{ $data->userData->name ?? '' }}</td>
                            <td>{{ $data->deadline ?? '' }}</td>
                            <td>{{ $data->priority ?? '' }}</td>
                            <td>{{ $data->remark ?? '' }}</td>
                            <td></td>
                            <td>
                                @if($data->status == 'Pending')
                                <span class="btn btn-sm btn-warning text-white">{{ $data->status ?? '' }}</span>
                                @else
                                <span class="btn btn-sm btn-success text-white">{{ $data->status ?? '' }}</span>
                                @endif
                            </td>

                            <td>
                                @if($data->status == 'Pending')
                                <a href="{{ route('admin.task.completed', $data->id) }}" class="btn btn-sm btn-success"> Completed <i class="fa fa-arrow-up"></i></a>
                                @else
                                @endif
                            </td>
                            
                            <td>
                                @can('task_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.task.edit', $data->id) }}">
                                        Edit
                                    </a>
                                @endcan

                                @can('task_delete')
                                    <form action="{{ route('admin.task.destroy', $data->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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