@extends('layouts.admin')
@section('content')

<!-- Include jQuery and Bootstrap Datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<style>
    /* General Styling */
    body {
        background-color: #f4f6f9;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0px 6px 14px rgba(0, 0, 0, 0.15);
    }

    /* Card Header with Grey-Blue Gradient */
    .profile-header {
        background: linear-gradient(to right, rgb(52, 81, 128), rgb(73, 97, 135), rgb(128, 128, 128));
        border-radius: 10px 10px 0 0;
        padding: 15px;
        font-weight: bold;
        color: white;
        text-align: center;
    }

    /* Card Body */
    .card-body {
        padding: 20px;
        background: #ffffff;
        border-radius: 0 0 12px 12px;
    }

    /* Profile Info */
    .profile-info p {
        display: flex;
        align-items: center;
        font-size: 14px;
        margin-bottom: 12px;
        color: #333;
        font-weight: 500;
    }

    .profile-info i {
        margin-right: 10px;
        color: #007bff;
        font-size: 16px;
    }

    /* Table Styling */
    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        background: linear-gradient(to right, rgb(52, 81, 128), rgb(73, 97, 135), rgb(128, 128, 128));
        color: white;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: 0.3s;
    }

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
    }
</style>

<div class="container">
    <div class="row mt-2">
        <!-- Profile Section -->
        <div class="col-md-4">
            <div class="card">
                <div class="profile-header">Client Profile</div>
                <div class="card-body profile-info">
                    <p><i class="fas fa-user"></i> {{$clientData->name ?? ''}}</p><hr>
                    <p><i class="fas fa-mobile-alt"></i> {{$clientData->phone ?? ''}}</p><hr>
                    <p><i class="fa fa-id-badge"></i> {{$clientData->designationData->name ?? ''}}</p><hr>
                    <p><i class="fa fa-building"></i> {{$clientData->companyData->name ?? ''}}</p><hr>
                    <p><i class="fa fa-envelope"></i> {{$clientData->email ?? ''}}</p><hr>
                    <p><i class="fa fa-map-marker"></i> {{$clientData->address ?? ''}}</p><hr>
                </div>
            </div>
        </div>

        <!-- Magazine List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span style="font-weight: bold;">Magazine List</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Image</th>
                                    <th>Verify Code</th>
                                    <th>Send Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($magazineSendData as $key => $data)
                            <tr data-entry-id="{{ $data->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->magazineData->name ?? '' }}</td>
                            <td>{{ $data->created_at ?? '' }}</td>
                            <td>
                                <embed src="{{ asset('uploads/magazine/'.$data->magazineData->image) }}" width="75" height="70">
                            </td>
                            <td>{{ $data->verify_code ?? '' }}</td>

                            <td>
                                @if($data->send_status == 'Pending')
                                <span class="btn btn-sm btn-warning text-white">{{ $data->send_status ?? '' }}</span>
                                <a href="{{route('admin.magazine-send-status',$data->id)}}" class="btn btn-sm btn-success text-white mt-1"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                                @elseif($data->send_status == 'Sending Complete')
                                <span class="btn btn-sm btn-info text-white">{{ $data->send_status ?? '' }}</span>
                                <a href="{{route('admin.magazine-receive-status',$data->id)}}" class="btn btn-sm btn-success text-white mt-1"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                                @else
                                <span class="btn btn-sm btn-success text-white">{{ $data->send_status ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
