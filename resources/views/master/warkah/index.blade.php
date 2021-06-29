@extends('layouts.master')
@section('level1', 'Master')
@section('level2', 'Warkah')
@section('judul', 'Master Warkah')
@section('content')
<style>
    .posisi{
        position: absolute;
        right: 0px;
        top: -50px;
    }
    </style>
<form method="post" data-toogle="validator" class="form-horzontal" id="form">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Kantor</label>
                <select id="kantor" name="kantor" class="form-control select2">
                    <option value="">-- Pilih Kantor --</option>
                    @foreach ($data->kantor as $kantor)
                        <option value="{{ $kantor->id }}">{{ $kantor->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Jenis Kegiatan</label>
                <select id="jenis" class="form-control select2" name="jenis">
                    <option value="">-- Pilih kegiatan --</option>
                    @foreach ($data->jenis as $val)
                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Desa, Kecamatan</label>
                <select id="desafilter" class="form-control select2" name="desa">
                    <option value="">-- Pilih Desa --</option>
                    @foreach ($data->desa as $des)
                        <option value="{{ $des->name }}, {{ $des->kecamatan  }}">{{ $des->name }}, {{ $des->kecamatan  }}</option>
                    @endforeach
                    <option value="99">-- Typo, Typo --</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Status</label>
                <select id="status" name="status" class="form-control select2">
                    <option value="">-- Pilih status --</option>
                    <option value="1">Tersedia</option>
                    <option value="2">Tidak Tersedia</option>
                </select>
            </div>
        </div>


    </div>
</form>
<br>
<br>
<table class="table table-hover table-striped table-borderless" style="width:100%" id="data">
    <thead>
        <tr>
            <th style="width:1px">#</th>
            <th>Kantor</th>
            <th>Album</th>
            <th>No Warkah</th>
            <th>Jenis</th>
            <th>Posisi Penyimpanan</th>
            <th>Desa Kecamatan</th>
            <th>Status</th>
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

    $('#jenis, #status, #kantor, #desafilter').on('change dp.change', function(){
        var jenis = $('#jenis').val();
        var status = $('#status').val();
        var kantor = $('#kantor').val();
        var desa = $('#desafilter').val();
        newUrl  = "{{ url('datatable/master') }}?master=warkah&jenis=" + jenis + "&status=" + status + "&kantor=" + kantor + "&desa=" + desa;
        $('#data').DataTable().ajax.url(newUrl).load();
    });

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
            dom:"<'row posisi'B>lftip",
            buttons: [{
                extend:'excel',
                filename: 'daftarWarkah',
                autoFilter: true,
                text: '<i class = "fa fa-file-excel-o"> Export Excel</i>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                },
            }],
            colReorder: true,
            processing: true,
            serverSide:true,
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
                    data: 'kantor',
                },
                {
                    data: 'album',
                },
                {
                    data: 'no_warkah',
                    render: function (data, type, row) {
                        if (data != null) {
                            return row.no_warkah_tahun;
                        }
                        return '-';
                    }
                },
                {data: 'jenis_warkah.name', orderable:false, searchable:false},
                {data: 'posisi', orderable:false, searchable:false},
                {data: 'desa',orderable:false},
                {data: 'status',orderable:false, searchable:false},
                {data: 'action',orderable:false, searchable:false},
                {data: 'updated_at',orderable:false, searchable:false, visible:false}
            ],
            order: [[ 8, 'desc' ]],
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
