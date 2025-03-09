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
        <a href="{{ route('admin.client.data.export') }}" class="btn btn-sm btn-danger float-right"> <i class="fa fa-print"></i> Print All Client Data</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            SL
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Designation
                        </th>
                        <th>
                            Company
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Area Code
                        </th>
                        <th>
                            Pending Magazine
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientData as $key => $data)
                        <tr data-entry-id="{{ $data->id }}">
                            <td>

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('admin.client.magazine', $data->id) }}" style="text-decoration: underline;">{{ $data->name ?? '' }} </a></td>
                            <td>{{ $data->designationData->name ?? '' }}</td>
                            <td>{{ $data->companyData->name ?? '' }}</td>
                            <td>{{ $data->address ?? '' }}</td>
                            <td>{{ $data->email ?? '' }}</td>
                            <td>{{ $data->phone ?? '' }}</td>
                            <td>{{ $data->areaCodeData->name ?? '' }}</td>

                            @php
                                $getPendingMagazines = App\Models\MagazineSend::getPendingMagazine($data->id);
                                $getSingleMagazine = App\Models\MagazineSend::getSingleMagazine($data->id);
                            @endphp


                            <td>
                            @if(isset($getPendingMagazines))
                                <span style="color: #0e89a7">
                                {{$getPendingMagazines->magazineData->name ?? ''}}</span><br>
                                @if($getPendingMagazines->send_status == 'Pending')
                                <span class="btn btn-sm btn-warning text-white">{{ $getPendingMagazines->send_status ?? '' }}</span>

                                <a href="{{route('admin.magazine-send-status',$getPendingMagazines->id)}}" class="btn btn-sm btn-success text-white mt-1"><i class="fa fa-arrow-up"></i></a>
                                @endif
                            @else
                                @if(isset($getSingleMagazine))
                                    <span style="color: #0e89a7">
                                    {{$getSingleMagazine->magazineData->name ?? ''}}</span><br>
                                        @if($getSingleMagazine->send_status == 'Sending Complete')
                                        <span class="btn btn-sm btn-info text-white">{{ $getSingleMagazine->send_status ?? '' }}</span>
                                        @else
                                        <span class="btn btn-sm btn-success text-white">{{ $getSingleMagazine->send_status ?? '' }}</span>
                                        @endif
                                @endif
                            @endif
                            </td>
                            
                            <td>
                                @can('client_edit')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.client.edit', $data->id) }}">
                                       Edit
                                    </a>
                                @endcan

                                @can('client_delete')
                                    <form action="{{ route('admin.client.destroy', $data->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection