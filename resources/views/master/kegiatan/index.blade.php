@extends('layouts.master')
@section('level1', 'Master')
@section('level2', 'Kegiatan')
@section('judul', 'Master Kegiatan')
@section('content')
<table class="table table-hover table-striped table-borderless" style="width:100%" id="data">
    <thead>
        <tr>
            <th style="width:1px">#</th>
            <th>Nama Kegiatan</th>
            <th>Batas Waktu</th>
            <th></th>
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
                "url": "{{ url('datatable/master') }}?master=kegiatan",
                "type": 'POST',
            },
            columns: [
                {
                    data: 'id',
                    className:'text-center',
                    searchable: false,
                    orderable:false,
                },
                {data: 'nama_kegiatan'},
                {
                    data: 'batas_waktu',
                    render: function (data, row, type) {
                        if (data != null) {
                            return data + ' hari';
                        }
                        return '-';

                    }
                },
                {data: 'action',orderable:false, searchable:false},
            ],
            order: [[ 1, 'asc' ]],
            aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            iDisplayLength: 10,
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
