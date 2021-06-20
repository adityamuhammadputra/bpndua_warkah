@extends('layouts.master')
@section('level1', 'User')
@section('level2', 'Profile')
@section('dashboard')
<style>
    #hide-dashboard {
        display: none;
    }
</style>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body profile" style="background: url('{{ auth()->user()->foto }}') center center no-repeat;">
                <div class="profile-image" style="display: block;">
                    <img src="{{ auth()->user()->foto }}" alt="Nadia Ali">
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">{{ auth()->user()->name }}</div>
                    <div class="profile-data-title" style="color: #FFF;">{{ auth()->user()->jabatan }}</div>
                </div>
                <div class="profile-controls">
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-info btn-rounded btn-block"><span class="fa fa-pencil"></span> Edit</button>
                    </div>
                </div>
            </div>
            <div class="panel-body list-group border-bottom">
                <a href="#" class="list-group-item"><span class="fa fa-user"></span> {{ auth()->user()->email }}</a>
                <a href="#" class="list-group-item"><span class="fa fa-check"></span> {{ datesOuput(auth()->user()->created_at) }}</a>
                <a href="#" class="list-group-item"><span class="fa fa-map-marker"></span> {{ auth()->user()->kantor->name }}</a>
            </div>
        </div>

    </div>

    <div class="col-md-9">

        <!-- START TIMELINE -->
        <div class="timeline timeline-right" style="max-height: 750px; overflow-y:auto;">

            <!-- START TIMELINE ITEM -->
            <div class="timeline-item timeline-main">
                <div class="timeline-date">Logs</div>
            </div>
            <!-- END TIMELINE ITEM -->

            <!-- START TIMELINE ITEM -->
            <div class="timeline-item timeline-item-right">
                <div class="timeline-item-info">09:00</div>
                <div class="timeline-item-icon"><span class="fa fa-users"></span></div>
                <div class="timeline-item-content">
                    <div class="timeline-heading" style="padding-bottom: 10px;">
                        <img src="{{ auth()->user()->foto }}"/>
                        <a href="#"> {{ auth()->user()->name }} </a> <small class="text-muted pull-right">0 min ago</small>
                    </div>
                    <div class="timeline-body comments">
                        <div class="comment-item">
                            <p>View Dashboard page</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- START TIMELINE ITEM -->
            <!-- END TIMELINE ITEM -->

            <!-- START TIMELINE ITEM -->
            @foreach (range(1, 9) as $item)
            <div class="timeline-item timeline-item-right">
                <div class="timeline-item-info">10:00</div>
                <div class="timeline-item-icon"><span class="fa fa-users"></span></div>
                <div class="timeline-item-content">
                    <div class="timeline-heading" style="padding-bottom: 10px;">
                        <img src="{{ auth()->user()->foto }}"/>
                        <a href="#"> {{ auth()->user()->name }} </a> <small class="text-muted pull-right">60 min ago</small>
                    </div>
                    <div class="timeline-body comments">
                        <div class="comment-item">
                            <p>Validate Peminjaman Endang Ruhiyat, 2 data warkah</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


            <!-- START TIMELINE ITEM -->
            <div class="timeline-item timeline-main">
                <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
            </div>
            <!-- END TIMELINE ITEM -->
        </div>
        <!-- END TIMELINE -->

    </div>

</div>
@endsection
