@extends('layouts.master')
@section('level1', 'Peminjaman')
@section('level2', 'Register')
@section('judul', 'Peminjaman Register')
@section('content')
    @include('peminjaman.register.form')
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-borderless" style="width:100%" id="data-peminjaman">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Kegiatan</th>
                        <th>Peminjaman Via</th>
                        <th>Tanggal Pinjam</th>
                        <th></th>
                        <th>Order</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@include('peminjaman.register.script')
@endsection
