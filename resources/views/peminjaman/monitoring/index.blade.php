@extends('layouts.master')
@section('level1', 'Peminjaman')
@section('level2', 'Monitoring')
@section('judul', 'Peminjaman Monitoring')
@section('content')
    <style>
     .posisi{
        position: fixed;
        right: 25px;
        top: 180px;
    }
    </style>
    <form method="post" data-toogle="validator" class="form-horzontal" id="form">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Jenis Kegiatan</label>
                    <select id="kegiatan" class="form-control" required="true" name="kegiatan">
                        <option value="">-- Pilih kegiatan --</option>
                        @foreach ($kegiatan as $val)
                            <option data-id="{{ $val->batas_waktu }}" value="{{ $val->id }}">{{ $val->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="">-- Pilih status --</option>
                        <option value="1">Di Registrasi</option>
                        <option value="2">Belum Validasi</option>
                        <option value="3">Sedang Dipinjam</option>
                        <option value="4">Sudah Kembalikan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Tanggal Peminjaman</label>
                    <div class='input-group'>
                        <input type='text' id="tanggal_mulai" name="tanggal_mulai" class="form-control date"/>
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">s / d</label>
                    <div class='input-group'>
                        <input type='text' id="tanggal_selesai" name="tanggal_selesai" class="form-control date"/>
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-borderless" style="width:100%" id="data-peminjamanmonitoring">
            <thead>
                <tr>
                    <th width="1px">No.</th>
                    <th>Peminjam</th>
                    <th>Via</th>
                    <th>Kegiatan</th>
                    <th style="padding-left:0px"></th>
                    <th style="padding-left:0px"></th>
                    <th width="5%">No.HT </th>
                    <th width="5%">No.SU</th>
                    <th width="5%">No.Warkah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tanggal Kembali</th>
                    <th width="5%"></th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@include('peminjaman.monitoring.script')
@endsection
