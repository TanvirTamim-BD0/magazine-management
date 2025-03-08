@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-center align-items-center">
<div class="card" style="width: 45rem;">
    <div class="card-header">
        Edit Notice 
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notice.update", [$noticeData->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">Title</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $noticeData->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" type="text" name="description" >{{$noticeData->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control" type="file" name="image">
                    @if($noticeData->image)
                    <br>
                    <embed src="{{ asset('uploads/notice/'.$noticeData->image) }}" width="100" height="100">
                    @endif
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