@extends('layouts.admin')
@section('content')
<style>
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

<div class="d-flex justify-content-center align-items-center">
<div class="card" style="width: 45rem;">
    <div class="card-header">
        Edit Task 
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.task.update", [$taskData->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ $taskData->name }}" required>
            </div>

            <div class="form-group">
                    <label class="required" for="assign_by">Assign By</label>
                        <select class="form-control select2 {{ $errors->has('assign_by') ? 'is-invalid' : '' }}" name="assign_by" required>
                            <option selected disabled></option>
                            @foreach($userData as $user)
                            <option value="{{$user->id}}" {{$user->id == $taskData->assign_by ? 'selected' : ''}} >{{$user->name}}</option>
                            @endforeach
                        </select>
            </div>

            <div class="form-group">
                <label class="required" for="deadline">Deadline</label>
                <input class="form-control {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline"required value="{{ $taskData->deadline }}" >
            </div>

            <div class="form-group">
                    <label class="required" for="priority">Priority</label>
                        <select class="form-control select2 {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority" required>
                            <option selected disabled></option>
                            <option value="1" {{$taskData->priority == '1' ? 'selected' : ''}}>1</option>
                            <option value="2" {{$taskData->priority == '2' ? 'selected' : ''}} >2</option>
                            <option value="3" {{$taskData->priority == '3' ? 'selected' : ''}} >3</option>
                            <option value="4" {{$taskData->priority == '4' ? 'selected' : ''}} >4</option>
                            <option value="5" {{$taskData->priority == '5' ? 'selected' : ''}} >5</option>
                            <option value="6" {{$taskData->priority == '6' ? 'selected' : ''}} >6</option>
                            <option value="7"{{$taskData->priority == '7' ? 'selected' : ''}} >7</option>
                            <option value="8" {{$taskData->priority == '8' ? 'selected' : ''}} >8</option>
                            <option value="9" {{$taskData->priority == '9' ? 'selected' : ''}} >9</option>
                            <option value="10" {{$taskData->priority == '10' ? 'selected' : ''}} >10</option>
                        </select>
            </div>

            <div class="form-group">
                <label class="required" for="remark">Remark</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="date" name="remark" required> {{ $taskData->remark }} </textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('scripts')
@parent
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    // Datepicker for From Date and To Date
    $('#deadline').datepicker({
        dateFormat: 'yy-mm-dd', // Set the date format
        changeMonth: true,
        changeYear: true
    });
</script>
@endsection