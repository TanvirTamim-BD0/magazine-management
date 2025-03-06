@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-center align-items-center">
<div class="card" style="width: 45rem;">
    <div class="card-header">
        Edit Client 
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.client.update", [$clientData->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $clientData->name) }}" required>
            </div>

            <div class="form-group">
                    <label for="designation_id">Designation</label>
                        <select class="form-control select2 {{ $errors->has('designation_id') ? 'is-invalid' : '' }}" name="designation_id">
                            <option selected disabled></option>
                            @foreach($designationData as $designation)
                            <option value="{{$designation->id}}" {{$designation->id == $clientData->designation_id ? 'selected' : ''}} >{{$designation->name}}</option>
                            @endforeach
                        </select>
            </div>


            <div class="form-group">
                    <label class="required" for="company_id">Company</label>
                        <select class="form-control select2 {{ $errors->has('company_id') ? 'is-invalid' : '' }}" name="company_id" required>
                            <option selected disabled></option>
                            @foreach($companyData as $company)
                            <option value="{{$company->id}}" {{$company->id == $clientData->company_id ? 'selected' : ''}} >{{$company->name}}</option>
                            @endforeach
                        </select>
            </div>

            <div class="form-group">
                <label class="required" for="address">Address</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" required>{{$clientData->address}}</textarea>
            </div>

            <div class="form-group">
                <label for="name">Email</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{$clientData->email}}">
            </div>


            <div class="form-group">
                <label class="required" for="phone">Phone</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{$clientData->phone}}" required>
            </div>

            <div class="form-group">
                <label class="required" for="area_code">Area Code</label>
                <input class="form-control {{ $errors->has('area_code') ? 'is-invalid' : '' }}" type="text" name="area_code" id="area_code" value="{{$clientData->area_code}}" required>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection