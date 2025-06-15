@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-center align-items-center">
<div class="card" style="width: 45rem;">
    <div class="card-header">
        Create Client
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.client.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
            </div>

            <div class="form-group">
                    <label for="category_id">Category</label>
                        <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id">
                            <option selected disabled></option>
                            @foreach($categoryData as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
            </div>

            <div class="form-group">
                    <label for="designation_id">Designation</label>
                        <select class="form-control select2 {{ $errors->has('designation_id') ? 'is-invalid' : '' }}" name="designation_id">
                            <option selected disabled></option>
                            @foreach($designationData as $designation)
                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                            @endforeach
                        </select>
            </div>


            <div class="form-group">
                    <label class="required" for="company_id">Company</label>
                        <select class="form-control select2 {{ $errors->has('company_id') ? 'is-invalid' : '' }}" name="company_id" required>
                            <option selected disabled></option>
                            @foreach($companyData as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
            </div>

            <div class="form-group">
                    <label for="country">Country</label>
                        <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country">
                            <option selected disabled></option>
                            @foreach($countryData as $country)
                            <option value="{{$country->name}}">{{$country->name}}</option>
                            @endforeach
                        </select>
            </div>

            <div class="form-group">
                <label class="required" for="address">Address</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" required></textarea>
            </div>

            <div class="form-group">
                <label for="name">Email</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', '') }}">
            </div>


            <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone" id="phone" value="{{ old('phone', '') }}">
            </div>

            <div class="form-group">
                <label for="website">Website</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
            </div>

            <div class="form-group">
                <label for="others_phone">Others Phone</label>
                <input class="form-control {{ $errors->has('others_phone') ? 'is-invalid' : '' }}" type="text" name="others_phone" id="others_phone" value="{{ old('others_phone', '') }}">
            </div>

            <div class="form-group">
                <label for="others_email">Others Email</label>
                <input class="form-control {{ $errors->has('others_email') ? 'is-invalid' : '' }}" type="text" name="others_email" id="others_email" value="{{ old('others_email', '') }}">
            </div>

            <div class="form-group">
                    <label for="area_code">Area</label>
                        <select class="form-control select2 {{ $errors->has('area_code') ? 'is-invalid' : '' }}" name="area_code">
                            <option selected disabled></option>
                            @foreach($areaCodeData as $areaCode)
                            <option value="{{$areaCode->id}}">{{$areaCode->name}}</option>
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
</div>


@endsection