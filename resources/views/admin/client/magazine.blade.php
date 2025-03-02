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

                    @can('magazine_create')
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMagazine">
                        Add Magazine 
                    </button>
                    @endcan
                    
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
                                    <th>Status</th>
                                    <th>Send</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($magazineData as $key => $data)
                            <tr data-entry-id="{{ $data->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name ?? '' }}</td>
                            <td>{{ $data->date ?? '' }}</td>
                            <td>
                                <embed src="{{ asset('uploads/magazine/'.$data->image) }}" width="75" height="70">
                                <br>
                                <a class="btn btn-sm btn-primary mt-3" href="{{ asset('uploads/magazine/'.$data->image) }}" download="{{$data->image}}"> <i class="fa fa-download" aria-hidden="true"></i> Download</a>
                            </td>

                            <td>
                                @if($data->status == 'Pending')
                                <span class="btn btn-sm btn-warning text-white">{{ $data->status ?? '' }}</span>
                                @else
                                <span class="btn btn-sm btn-success text-white">{{ $data->status ?? '' }}</span>
                                @endif
                            </td>

                            <td>
                                @if($data->status == 'Pending')
                                <a href="{{ route('admin.magazine.send', $data->id) }}" class="btn btn-sm btn-success"> Send <i class="fa fa-arrow-up"></i></a>
                                @else
                                @endif
                            </td>

                            <td>
                                @can('magazine_edit')
                                    <a class="btn btn-xs btn-primary" href="#" data-toggle="modal" data-target="#editMagazine{{$data->id}}">
                                        Edit
                                    </a>
                                @endcan

                                @can('magazine_delete')
                                    <form action="{{ route('admin.magazine.destroy', $data->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
                                @endcan

                            </td>

                        </tr>

                        <!-- Edit Magazine Modal -->
                    <div class="modal fade" id="editMagazine{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editMagazineLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMagazineLabel">Edit Magazine</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('admin.magazine.update', $data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" type="text" name="name" value="{{ $data->name }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input class="form-control datepicker" type="date" name="date" value="{{ $data->date }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input class="form-control" type="file" name="image">
                                            <!-- Display current image -->
                                            @if($data->image)
                                                <br>
                                                <embed src="{{ asset('uploads/magazine/'.$data->image) }}" width="100" height="100">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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

                <!-- Add Magazine Modal -->
                <div class="modal fade" id="addMagazine">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Magazine</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route("admin.magazine.store") }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="client_id" value="{{$clientData->id}}">

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control" type="text" name="name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input class="form-control datepicker" type="date" name="date" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input class="form-control" type="file" name="image" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- End Modal -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

@endsection
