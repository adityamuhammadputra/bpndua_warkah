@extends('layouts.master')
@section('level1', 'Pengembalian')
@section('level2', 'Validasi')
@section('judul', 'Pengembalian Validasi')
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
                    <select id="kegiatan" class="form-control" required="true" name="kegiatan">
                        <option value="">-- Pilih kegiatan --</option>
                        @foreach ($kegiatan as $val)
                            <option data-id="{{ $val->batas_waktu }}" value="{{ $val->id }}">{{ $val->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
    <br>
    <form method="POST" class="form-pengembalian-validasi table-responsive">
        @method('POST')
        @csrf
        <table class="table table-hover table-striped table-borderless" style="width:100%" id="data-pengembalianvalidasi">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Peminjam</th>
                    <th>Via</th>
                    <th>Kegiatan</th>
                    <th style="padding-left:0px"></th>
                    <th style="padding-left:0px"></th>
                    <th width="7%">No.HT </th>
                    <th width="7%">No.SU</th>
                    <th width="7%">No.Warkah</th>
                    <th>Tanggal Pinjam</th>
                    <th><input type="checkbox" onclick="checkall(this.checked)"></th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </form>
    <button class="btn btn-primary pull-right alertshow" data-head="memvalidasi Pengembalian (data akan masuk ke History)" data-type="Validasi"><i class="fa fa-check"></i> Kirim</button>


@include('pengembalian.validasi.script')
@endsection
