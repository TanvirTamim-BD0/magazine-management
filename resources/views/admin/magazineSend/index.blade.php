@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Magazine Send
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.magazine-send.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                    <label class="required" for="magazine_id">Magazine</label>
                        <select class="form-control select2 {{ $errors->has('magazine_id') ? 'is-invalid' : '' }}" name="magazine_id" required>
                            <option selected disabled></option>
                            @foreach($magazineData as $magazine)
                            <option value="{{$magazine->id}}">{{$magazine->name}}</option>
                            @endforeach
                        </select>
            </div>

            <div class="form-group">
                <label class="required" for="client_id">Client</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('client_id') ? 'is-invalid' : '' }}" name="client_id[]" id="client_id" multiple required>
                    @foreach($clientData as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>



@endsection