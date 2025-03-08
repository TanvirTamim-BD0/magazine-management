@extends('layouts.admin')
@section('content')

<style>
    .modal-content {
        border-radius: 12px;
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
    }
    .modal-header {
        background: linear-gradient(to right, rgb(52, 81, 128), rgb(73, 97, 135), rgb(128, 128, 128));
        color: white;
        border-radius: 12px 12px 0 0;
    }
    .modal-footer {
        border-top: none;
    }
    .form-control {
        border-radius: 8px;
        padding: 10px;
    }
    /* Filter Bar Styling */
    .filter-bar {
        margin-bottom: 15px;
        display: flex;
        justify-content: center; /* Centering filter bar */
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    /* User Filter Styling */
    .filter-bar select,
    .filter-bar input[type="text"] {
        flex: 1;
        max-width: 220px;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

</style>

@can('task_assign_create')
    <div class="mb-3">
        <a class="btn btn-success" href="{{ route('admin.assign-task.create') }}">
            Add Assign Task
        </a>
    </div>
@endcan

@if(Auth::user()->role == 'Admin')
<div class="filter-bar">
    <select id="assignToFilter" class="form-control">
        <option value="">-- Filter by Assign To --</option>
        @foreach($users as $user)
            <option value="{{ $user->name }}">{{ $user->name }}</option>
        @endforeach
    </select>
</div>
@endif

<div class="card">
    <div class="card-header">Task Assign List</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Assign By</th>
                        <th>Assign To</th>
                        <th>Assign Date</th>
                        <th>Deadline</th>
                        <th>Remark</th>
                        <th>Reply Comment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskAssignData as $key => $data)
                        <tr>
                            <td></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name ?? '' }}</td>
                            <td>{{ $data->userData->name ?? '' }}</td>
                            <td class="assign-to-column">{{ $data->assignData->name ?? '' }}</td>
                            <td>{{ $data->created_at ?? '' }}</td>
                            <td>{{ $data->deadline ?? '' }}</td>
                            <td>{{ $data->remark ?? '' }}</td>
                            <td>{{ $data->reply_comment ?? '' }}</td>
                            <td>
                                <span class="btn btn-sm {{ $data->status == 'Pending' ? 'btn-warning text-white' : 'btn-success text-white' }}">{{ $data->status }}</span>
                            </td>
                            <td>
                                @if(Auth::user()->id == $data->assign_to && $data->status == 'Pending')
                                    <a href="{{ route('admin.task-assign.completed', $data->id) }}" class="btn btn-sm btn-success">
                                        Completed <i class="fa fa-arrow-up"></i>
                                    </a>
                                @endif
                                @if(Auth::user()->id == $data->assign_to)
                                    <button class="btn btn-xs btn-primary text-white" data-toggle="modal" data-target="#replyComment{{ $data->id }}">
                                        Reply Comment
                                    </button>
                                @endif

                                @can('task_assign_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.assign-task.edit', $data->id) }}">
                                        Edit
                                    </a>
                                @endcan

                                @can('task_assign_delete')
                                    <form action="{{ route('admin.assign-task.destroy', $data->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        <div class="modal fade" id="replyComment{{ $data->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Reply Comment</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.reply.comment', $data->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <textarea class="form-control" name="reply_comment">{{ $data->reply_comment }}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    let table = $('.datatable').DataTable();

    $('#assignToFilter').on('change', function () {
        let assignToFilter = $(this).val().toLowerCase();
        table.rows().every(function () {
            let row = $(this.node());
            let assignTo = row.find('.assign-to-column').text().toLowerCase();
            row.toggle(assignToFilter === '' || assignTo === assignToFilter);
        });
    });
});
</script>
@endsection