@extends('layouts.master')
@section('level1', 'Master')
@section('level2', 'Warkah')
@section('judul', 'Master Warkah')
@section('content')
<table class="table table-hover table-striped table-borderless" style="width:100%" id="data">
    <thead>
        <tr>
            <th style="width:1px">#</th>
            <th>Album</th>
            <th>No Warkah</th>
            <th>Jenis</th>
            <th>Posisi Penyimpanan</th>
            <th>Desa Kecamatan</th>
            <th></th>
            <th>Order</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@include('master.global')
@push('scripts')
    <script>
    var Table;
    $(document).ready(function () {
          //datatables
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        'use strict';
        var Table;
        Table = $('#data').DataTable({
            ajax:{
                "url": "{{ url('datatable/master') }}?master=warkah",
                "type": 'POST',
            },
            columns: [
                {
                    data: 'id',
                    className:'text-center',
                    searchable: false,
                    orderable:false,
                },
                {
                    data: 'album',
                },
                {
                    data: 'no_warkah_tahun',
                    searchable:false
                },
                {data: 'jenis_warkah.name'},
                {data: 'posisi', searchable:false},
                {data: 'desa',orderable:false, searchable:false},
                {data: 'action',orderable:false, searchable:false},
                {data: 'updated_at',orderable:false, searchable:false, visible:false}
            ],
            order: [[ 7, 'desc' ]],
            aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            iDisplayLength: 15,
        }),
        Table.on( 'draw.dt', function () {
            var PageInfo = $('#data').DataTable().page.info();
                Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
        });
    });
    </script>
@endpush
@endsection
