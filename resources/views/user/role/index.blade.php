@extends('layouts.master')
@section('level1', 'User')
@section('level2', 'Role')
@section('judul', 'User Role')

@section('content')
    @include('user.role.form')
    <div class="table-responsive">
        <table class="table table-hover table-striped table-borderless" style="width:100%" id="data-role">
            <thead>
                <tr>
                    <th style="width:1px;">No.</th>
                    <th>Role</th>
                    <th>Guard Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@include('user.role.scripts')
@endsection
