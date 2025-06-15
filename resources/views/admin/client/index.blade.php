@extends('layouts.admin')
@section('content')
@can('client_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.client.create') }}">
                Add Client
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        Client List
        <a href="{{ route('admin.client.data.export') }}" class="btn btn-sm btn-danger float-right">
            <i class="fa fa-print"></i> Print All Client Data
        </a>
    </div>

    <!-- FILTERS -->
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3">
                <select id="filter-category" class="form-control">
                    <option value="">Filter by Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="filter-designation" class="form-control">
                    <option value="">Filter by Designation</option>
                    @foreach($designations as $designation)
                        <option value="{{ $designation->name }}">{{ $designation->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="filter-company" class="form-control">
                    <option value="">Filter by Company</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->name }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="filter-area" class="form-control">
                    <option value="">Filter by Area</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->name }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Designation</th>
                        <th>Company</th>
                        <th>Website</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Others Information</th>
                        <th>Area</th>
                        <th>Country</th>
                        <th>Pending Magazine</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientData as $key => $data)
                        <tr data-entry-id="{{ $data->id }}">
                            <td></td>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('admin.client.magazine', $data->id) }}" style="text-decoration: underline;">{{ $data->name ?? '' }}</a></td>
                            <td>{{ $data->categoryData->name ?? '' }}</td>
                            <td>{{ $data->designationData->name ?? '' }}</td>
                            <td>{{ $data->companyData->name ?? '' }}</td>
                            <td>{{ $data->website ?? '' }}</td>                        
                            <td>{{ $data->address ?? '' }}</td>
                            <td>{{ $data->email ?? '' }}</td>
                            <td>{{ $data->phone ?? '' }}</td>
                            <td>
                                Others Phone : {{ $data->others_phone ?? '' }}<br>
                                Others Email : {{ $data->others_email ?? '' }}
                            </td>
                            <td>{{ $data->areaCodeData->name ?? '' }}</td>
                            <td>{{ $data->country ?? '' }}</td>

                            @php
                                $getPendingMagazines = App\Models\MagazineSend::getPendingMagazine($data->id);
                                $getSingleMagazine = App\Models\MagazineSend::getSingleMagazine($data->id);
                            @endphp

                            <td>
                                @if(isset($getPendingMagazines))
                                    <span style="color: #0e89a7">{{ $getPendingMagazines->magazineData->name ?? '' }}</span><br>
                                    @if($getPendingMagazines->send_status == 'Pending')
                                        <span class="btn btn-sm btn-warning text-white">{{ $getPendingMagazines->send_status }}</span>
                                        <a href="{{ route('admin.magazine-send-status', $getPendingMagazines->id) }}" class="btn btn-sm btn-success text-white mt-1">
                                            <i class="fa fa-arrow-up"></i>
                                        </a>
                                    @endif
                                @else
                                    @if(isset($getSingleMagazine))
                                        <span style="color: #0e89a7">{{ $getSingleMagazine->magazineData->name ?? '' }}</span><br>
                                        @if($getSingleMagazine->send_status == 'Sending Complete')
                                            <span class="btn btn-sm btn-info text-white">{{ $getSingleMagazine->send_status }}</span>
                                        @else
                                            <span class="btn btn-sm btn-success text-white">{{ $getSingleMagazine->send_status }}</span>
                                        @endif
                                    @endif
                                @endif
                            </td>

                            <td>
                                @can('client_edit')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.client.edit', $data->id) }}">Edit</a>
                                @endcan
                                @can('client_delete')
                                    <form action="{{ route('admin.client.destroy', $data->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

        // Destroy existing table if reinitializing
        if ($.fn.DataTable.isDataTable('.datatable-User')) {
            $('.datatable-User').DataTable().clear().destroy();
        }

        let table = $('.datatable-User').DataTable({
            buttons: dtButtons,
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 100,
        });

        // Filter dropdowns by column index
        $('#filter-category').on('change', function () {
            table.column(3).search(this.value).draw();
        });

        $('#filter-designation').on('change', function () {
            table.column(4).search(this.value).draw();
        });

        $('#filter-company').on('change', function () {
            table.column(5).search(this.value).draw();
        });

        $('#filter-area').on('change', function () {
            table.column(9).search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endsection
