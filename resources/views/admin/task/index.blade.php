@extends('layouts.admin')
@section('content')

<style>
    /* Modal Styling */
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

    /* Datepicker (From Date and To Date) */
    .filter-bar input[type="text"] {
        max-width: 220px;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        background-color: #fff;
        color: #333;
    }

    /* jQuery UI Datepicker Basic Style */
    .ui-datepicker {
        font-size: 14px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .ui-datepicker .ui-datepicker-header {
        background-color: #f7f7f7;
        color: #333;
        text-align: center;
        padding: 8px;
        border-bottom: 1px solid #ccc;
    }

    .ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
        background-color: transparent;
        color: #333;
        border: none;
        font-size: 18px;
        padding: 5px;
    }

    .ui-datepicker .ui-datepicker-calendar td {
        padding: 8px;
        text-align: center;
        cursor: pointer;
    }

    .ui-datepicker .ui-datepicker-calendar td:hover {
        background-color: #f1f1f1;
    }

    .ui-datepicker .ui-datepicker-calendar .ui-state-highlight {
        background-color: #ddd;
        color: #333;
    }
</style>

@can('task_create')
    <div class="mb-3">
        <a class="btn btn-success" href="{{ route('admin.task.create') }}">
            Add Task
        </a>
    </div>
@endcan

<!-- Filter Section -->
<div class="filter-bar">
    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'HR')
    <!-- User Filter -->
    <select id="userFilter" class="form-control">
        <option value="">-- Filter by User --</option>
        @foreach($users as $user)
            <option value="{{ $user->name }}">{{ $user->name }}</option>
        @endforeach
    </select>
    @endif

    @if(!request()->is('admin/task-today')) 
    <!-- Date Filter -->
    <input type="text" id="fromDate" class="form-control" placeholder="From Date">
    <input type="text" id="toDate" class="form-control" placeholder="To Date">
    @endif
</div>


<div class="card">
    <div class="card-header">Task List</div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>SL</th>
                        <th>Task Details</th>
                        <th class="user-column">User</th>
                        <th class="date-column">Assign Date</th> <!-- Marked for filtering -->
                        <th>Assign By</th>
                        <th>Deadline</th>
                        <th>Priority</th>
                        <th>Remark</th>
                        <th>Admin Comment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskData as $key => $data)
                        <tr>
                            <td></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{!! $data->name ?? '' !!}</td>
                            <td class="user-column">{{ $data->userData->name ?? '' }}</td>
                            <td class="date-column">{{ $data->assign_date ?? '' }}</td> <!-- Marked for filtering -->
                            <td>{{ $data->assignData->name ?? '' }}</td>
                            <td>{{ $data->deadline ?? '' }}</td>
                            <td>{{ $data->priority ?? '' }}</td>
                            <td>{!! $data->remark ?? '' !!}</td>
                            <td>{{ $data->admin_comment ?? '' }}</td>
                            <td>
                                @if($data->status == 'Pending')
                                    <span class="btn btn-sm btn-warning text-white">{{ $data->status }}</span>
                                @else
                                    <span class="btn btn-sm btn-success text-white">{{ $data->status }}</span>
                                @endif
                            </td>
                            <td>

                                @if(Auth::user()->id == $data->user_id && $data->status == 'Pending')
                                    <a href="{{ route('admin.task.completed', $data->id) }}" class="btn btn-sm btn-success">
                                        Completed <i class="fa fa-arrow-up"></i>
                                    </a>
                                @endif
                                @can('task_admin_comment')
                                    <button class="btn btn-xs btn-primary text-white" data-toggle="modal" data-target="#adminComment{{ $data->id }}">
                                        Admin Comment
                                    </button>
                                @endcan
                                @can('task_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.task.edit', $data->id) }}">
                                        Edit
                                    </a>
                                @endcan
                                @can('task_delete')
                                    <form action="{{ route('admin.task.destroy', $data->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
                                @endcan
                            </td>
                        </tr>

                    <!-- Admin Comment Modal -->
                    <div class="modal fade" id="adminComment{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="adminCommentLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="adminCommentLabel">Admin Comment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('admin.admin.comment', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="admin_comment">Admin Comment</label>
                                            <textarea class="form-control" type="text" name="admin_comment">{{ $data->admin_comment }}</textarea>
                                        </div>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function () {
    let table = $('.datatable').DataTable({
        orderCellsTop: true,
        order: [[1, 'desc']],
        pageLength: 100,
    });

    // User Filter (Search only in the User column)
    $('#userFilter').on('change', function () {
        let selectedUser = $(this).val().toLowerCase();
        table.columns('.user-column').search(selectedUser).draw();
    });

    // Datepicker for From Date and To Date
    $('#fromDate, #toDate').datepicker({
        dateFormat: 'yy-mm-dd', // Set the date format
        changeMonth: true,
        changeYear: true
    });

    // Date Range Filter (Search only in the Assign Date column)
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        let fromDate = $('#fromDate').val();
        let toDate = $('#toDate').val();
        let assignDate = data[4]; // The "Assign Date" column (Index 4)

        if (fromDate && toDate) {
            let dateParts = assignDate.split('-'); // Assuming YYYY-MM-DD format
            let formattedAssignDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);

            let startDate = new Date(fromDate);
            let endDate = new Date(toDate);

            return formattedAssignDate >= startDate && formattedAssignDate <= endDate;
        }
        return true;
    });

    // Apply Date Filter when date inputs change
    $('#fromDate, #toDate').on('change', function () {
        table.draw();
    });

    // Adjust table when switching tabs
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function () {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });
});
</script>
@endsection
