@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Magazine Overview
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
                        <th> Magazine </th>
                        <th> Pending </th>
                        <th> Sending </th>
                        <th> Received </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($magazineData as $key => $data)
                        <tr data-entry-id="{{ $data->id }}">
                            <td>

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $data->name ?? '' }}
                            </td>

                            @php
                                $pendingMagazinesCount = App\Models\Magazine::pendingMagazinesCount($data->id);
                                $sendingMagazinesCount = App\Models\Magazine::sendingMagazinesCount($data->id);
                                $receiveMagazinesCount = App\Models\Magazine::receiveMagazinesCount($data->id);
                            @endphp

                            <td><span class="btn btn-sm btn-warning text-white">{{$pendingMagazinesCount}}</span></td>
                            <td><span class="btn btn-sm btn-info text-white">{{$sendingMagazinesCount}}</span></td>
                            <td><span class="btn btn-sm btn-success text-white">{{$receiveMagazinesCount}}</span></td>
 
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