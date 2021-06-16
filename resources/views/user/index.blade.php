@extends('layouts.master')
@section('level1', 'User')
@section('level2', 'List')
@section('judul', 'User List')

@section('content')
    <div class="form-wrap">
    @include('user.form')
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-borderless" style="width:100%" id="data-user">
            <thead>
                <tr>
                    <th style="width:1px;">No.</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Profile</th>
                    <th>Akses</th>
                    <th>photo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@include('user.scripts')
@endsection
