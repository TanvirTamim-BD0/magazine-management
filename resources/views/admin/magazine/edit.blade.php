@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-center align-items-center">
<div class="card" style="width: 45rem;">
    <div class="card-header">
        Edit Magazine 
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.magazine.update", [$magazineData->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('title', $magazineData->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control" type="file" name="image">
                    @if($magazineData->image)
                    <br>
                    <embed src="{{ asset('uploads/magazine/'.$magazineData->image) }}" width="100" height="100">
                    @endif
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Save
            </div>
        </form>
    </div>
</div>
</div>
@endsection