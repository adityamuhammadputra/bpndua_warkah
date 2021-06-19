@extends('layouts.master')
@section('level1', 'Peminjaman')
@section('level2', 'Validasi')
@section('judul', 'Peminjaman Validasi')
@section('content')
    <style>
    .posisi{
        position: fixed;
        right: 25px;
        top: 180px;
    }
    .row_selected{
        color: #1caf9a; !important;
    }
    </style>
    <form method="post" data-toogle="validator" class="form-horzontal" id="form">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Jenis Kegiatan</label>
                    <select id="kegiatan" class="form-control select2" required="true" name="kegiatan">
                        <option value="">-- Pilih kegiatan --</option>
                        @foreach ($kegiatan as $val)
                            <option data-id="{{ $val->batas_waktu }}" value="{{ $val->id }}">{{ $val->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Lewat Dari</label>
                    <select id="hari_lewat" name="hari_lewat" class="form-control">
                        <option value="">-- Batas Hari --</option>
                        <option value="3">3 Hari</option>
                        <option value="5">5 Hari</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <br>
    <form method="POST" class="form-peminjaman-validasi table-responsive">
        @method('POST')
        @csrf
        <table class="table table-hover table-striped table-borderless" style="width:100%" id="data-peminjamanvalidasi">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Peminjam</th>
                    <th>Via</th>
                    <th>Kegiatan</th>
                    <th style="padding-left:0px"></th>
                    <th width="7%">Jenis</th>
                    <th width="7%">Album</th>
                    <th width="16%">Posisi</th>
                    <th style="padding-left:0px"></th>
                    <th>Tanggal Pinjam</th>
                    <th></th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </form>
    <button class="btn btn-primary pull-right alertshow" data-head="mengirim ke Pengembalian Validasi" data-type="Validasi"><i class="fa fa-check"></i> Kirim</button>


@include('peminjaman.validasi.script')
@endsection
