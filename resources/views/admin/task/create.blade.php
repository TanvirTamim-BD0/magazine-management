@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-center align-items-center">
<div class="card" style="width: 45rem;">
    <div class="card-header">
        Create Task
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.task.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
            </div>

            <div class="form-group">
                    <label class="required" for="assign_by">Assign By</label>
                        <select class="form-control select2 {{ $errors->has('assign_by') ? 'is-invalid' : '' }}" name="assign_by" required>
                            <option selected disabled></option>
                            @foreach($userData as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
            </div>

            <div class="form-group">
                <label class="required" for="deadline">Deadline</label>
                <input class="form-control {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="date" name="deadline" id="deadline"required>
            </div>

            <div class="form-group">
                    <label class="required" for="priority">Priority</label>
                        <select class="form-control select2 {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority" required>
                            <option selected disabled></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
            </div>

            <div class="form-group">
                <label class="required" for="remark">Remark</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="date" name="remark" required></textarea>
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