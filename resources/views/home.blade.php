@extends('layouts.master')
@section('level1', 'Home')
@section('level2', 'Dashboard')
@section('dashboard')
<style>
/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #f5f5f5;
  border-radius: 2px;
}
/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: grey;
}
.detailpinjam
{
    cursor: pointer;
}
.detailpinjam:hover
{
    text-decoration: none;
}
.posisi
{
    position: fixed;
    right: 18px;
    top: 90px;
}

</style>

    <div class="row">
        <div class="col-md-3">
            <div class="widget widget-default widget-carousel">
                <div class="owl-carousel" id="owl-example">
                    @foreach ($data['peminjamanJenis'] as $item)
                        <div>
                            <div class="widget-title">{{ $item['name'] }}</div>
                            <div class="widget-subtitle">{{ $item['dateMin'] }} s/d {{ $item['dateMax'] }}</div>
                            <div class="widget-int">{{ $item['count'] }}</div>
                        </div>
                    @endforeach

                </div>
                <div class="widget-controls">
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-envelope"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count">
                        <a style="color:black;" class="detailpinjam" data-status="3" data-kegiatanid="" data-nama_kegiatan="Semua Peminjaman " data-labelfilter="Tanggal Pinjam">
                            {{ $data['peminjaman']['total'] }}
                        </a>
                    </div>
                    <div class="widget-title">Total Peminjaman</div>
                    <div class="widget-subtitle">
                        {{ $data['peminjaman']['min_tanggal'] }} s/d {{ $data['peminjaman']['max_tanggal'] }}
                    </div>
                </div>
                <div class="widget-controls">
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-user"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count">
                        <a style="color:black;" class="detailpinjam" data-status="4" data-kegiatanid="" data-nama_kegiatan="Semua Pengembalian" data-labelfilter="Tanggal Kembali">
                            {{ $data['pengembalian']['total'] }}
                        </a>
                    </div>
                    <div class="widget-title">Total Pengembalian</div>
                    <div class="widget-subtitle">
                        {{ $data['pengembalian']['min_tanggal'] }} s/d {{ $data['pengembalian']['max_tanggal'] }}
                    </div>
                </div>
                <div class="widget-controls">
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
            </div>
            <!-- END WIDGET REGISTRED -->

        </div>
        <div class="col-md-3">

            <div class="widget widget-info widget-padding-sm">
                <div class="widget-big-int plugin-clock">00:00</div>
                <div class="widget-subtitle plugin-date">Loading...</div>
                <div class="widget-controls">
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
                <div class="widget-buttons widget-c3">
                    <div class="col">
                        <a href="#"><span class="fa fa-clock-o"></span></a>
                    </div>
                    <div class="col">
                        <a href="#"><span class="fa fa-bell"></span></a>
                    </div>
                    <div class="col">
                        <a href="#"><span class="fa fa-calendar"></span></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default" style="height:330px;">
                <div class="panel-heading ui-draggable-handle">
                    <div class="panel-title-box">
                        <h3>Layanan Sistem Informasi </h3>
                        <span>Data Peminjaman, Pengaembalian Warkah Pertanahan Kantor Pertanahan Kabupaten Bogor</span>
                    </div>
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="widget widget-default widget-carousel">
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>

            </div>
        </div>
        <div class="col-md-4" >
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <div class="panel-title-box">
                        <h3>Logs</h3>
                        <span>10 Last Logs {{ auth()->user()->name }}</span>
                    </div>
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- InstaWidget -->
                </div>

                <div class="panel-body panel-body-table" style="overflow: auto;">
                    <div style="height:310px;">
                        {{-- <a href="https://instawidget.net/v/user/kantah_kabbogor" id="link-00bde5fe2115a26b63fc304528cbc5558c6a14394402723d39656c6fe40dea91">@kantah_kabbogor</a> --}}
                        {{-- <script src="https://instawidget.net/js/instawidget.js?u=00bde5fe2115a26b63fc304528cbc5558c6a14394402723d39656c6fe40dea91&width=100%"></script> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <div class="panel-title-box">
                        <h3>Dashboard 1</h3>
                    </div>
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="panel-body panel-body-table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="40%">Jenis Layanan</th>
                                    <th width="30%" class="text-center">Peminjaman</th>
                                    <th width="30%" class="text-center">Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['dashboard']['dashboard1'] as $val)
                                    <tr>
                                        <td><strong>{{ $val->nama_kegiatan }}</strong></td>
                                        <td class="text-center"><a class="detailpinjam" data-jenis="peminjaman" data-kegiatanid="{{ $val->id }}" data-status="3" data-nama_kegiatan="Peminjaman {{ $val->nama_kegiatan }}" data-labelfilter="Tanggal Pinjam"><span class="label label-danger">{{ $val->totalpinjam }}</a></span></td>
                                        <td class="text-center"><a class="detailpinjam" data-jenis="pengembalian" data-kegiatanid="{{ $val->id }}" data-status="4" data-nama_kegiatan="Pengembalian {{ $val->nama_kegiatan }}" data-labelfilter="Tanggal Kembali"><span class="label label-warning">{{ $val->totalkembali }}</a></span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <div class="panel-title-box">
                        <h3>Dashboard 2</h3>
                    </div>
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="panel-body panel-body-table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="40%">Jenis Layanan</th>
                                    <th width="30%" class="text-center">Peminjaman</th>
                                    <th width="30%" class="text-center">Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['dashboard']['dashboard2'] as $val)
                                    <tr>
                                        <td><strong>{{ $val->nama_kegiatan }}</strong></td>
                                        <td class="text-center"><a class="detailpinjam"  data-jenis="peminjaman" data-kegiatanid="{{ $val->id }}" data-status="3" data-nama_kegiatan="Peminjaman {{ $val->nama_kegiatan }}" data-labelfilter="Tanggal Pinjam"><span class="label label-danger">{{ $val->totalpinjam }}</a></span></td>
                                        <td class="text-center"><a class="detailpinjam" data-jenis="pengembalian" data-kegiatanid="{{ $val->id }}" data-status="4" data-nama_kegiatan="Pengembalian {{ $val->nama_kegiatan }}" data-labelfilter="Tanggal Kembali"><span class="label label-warning">{{ $val->totalkembali }}</a></span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <div class="panel-title-box">
                        <h3>Dashboard 3</h3>
                    </div>
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="panel-body panel-body-table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="40%">Jenis Layanan</th>
                                    <th width="30%" class="text-center">Peminjaman</th>
                                    <th width="30%" class="text-center">Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['dashboard']['dashboard3'] as $val)
                                    <tr>
                                        <td><strong>{{ $val->nama_kegiatan }}</strong></td>
                                        <td class="text-center"><a class="detailpinjam" data-jenis="peminjaman" data-kegiatanid="{{ $val->id }}" data-status="3" data-nama_kegiatan="Peminjaman {{ $val->nama_kegiatan }}" data-labelfilter="Tanggal Pinjam"><span class="label label-danger">{{ $val->totalpinjam }}</a></span></td>
                                        <td class="text-center"><a class="detailpinjam" data-jenis="pengembalian" data-kegiatanid="{{ $val->id }}" data-status="4" data-nama_kegiatan="Pengembalian {{ $val->nama_kegiatan }}" data-labelfilter="Tanggal Kembali"><span class="label label-warning">{{ $val->totalkembali }}</a></span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.gifLoading {
	position: absolute;
	left: 0px;
	top: 0px;
    width: 100%;
    height: 100%;
	z-index: 9999;
	background: url(load.gif) center no-repeat #fff;
}
</style>
<div class="modal" id="modal_large" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"><span><i class="fa fa-angle-double-down"></i></span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="largeModalHead">Judul</h4>
            </div>
            <div class="modal-body">
                <form method="post" data-toogle="validator" class="form-horzontal" id="form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="labelfilter"></label>
                                <div class='input-group'>
                                    <input type='text' id="tanggal_mulai" name="tanggal_mulai" class="form-control date" required/>
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>s / d</label>
                                <div class='input-group'>
                                    <input type='text' id="tanggal_selesai" name="tanggal_selesai" class="form-control date" required/>
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <div class="table-responsive">

                    <table class="table table-hover table-striped table-borderless table-responsive" id="data-modal" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Kegiatan</th>
                                <th>Peminjaman Via</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="gifLoading"></div>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    @push('scripts')
        <script>
            var newUrl = '',status = '', kegiatan_id = '', nama_kegiatan, jenis_kegiatan;
            $('.detailpinjam').on('click',  function(){
                jenis_kegiatan = $(this).data('jenis');
                kegiatan_id = $(this).data('kegiatanid');
                status = $(this).data('status');
                nama_kegiatan = $(this).data('nama_kegiatan');
                newUrl  = "{{ url('api/modaldashboard') }}?kegiatan_id=" + kegiatan_id + "&status=" + status;
                $('#data-modal').DataTable().ajax.url(newUrl).load();
                $('#largeModalHead').text(nama_kegiatan);
                $('.labelfilter').text($(this).data('labelfilter'));
                // $("[name='data-modal_length']").val('25').trigger('change');
                // $('#data-modal_filter').find("input[type=search]").val('');
                $('#tanggal_mulai, #tanggal_selesai').val('');
                $('.dt-buttons').css('display','none');
                $('#form').hide();
                if(jenis_kegiatan=='peminjaman'){
                    $('#data-modal').DataTable().column(5).visible(false);
                    $('#data-modal').DataTable().column(4).visible(true);
                }else{
                    $('#data-modal').DataTable().column(4).visible(false);
                    $('#data-modal').DataTable().column(5).visible(true);
                }
                $('#modal_large').modal('show');
            });
            $('.close').on('click', function(){
                $('#form').slideToggle();
                $('.dt-buttons').slideToggle();
                $(this).find('[class*="angle"]').toggleClass('fa-angle-double-down fa-angle-double-up')
            })

            $('#tanggal_selesai, #tanggal_mulai').on('dp.change', function(e){
                var mulai = $('#tanggal_mulai').val();
                var selesai = $('#tanggal_selesai').val();
                newUrl  = "{{ url('api/modaldashboard') }}?kegiatan_id=" + kegiatan_id + "&status=" + status + "&mulai=" + mulai + "&selesai=" + selesai;
                $('#data-modal').DataTable().ajax.url(newUrl).load();
                $("[name='data-modal_length']").val('-1').trigger('change');
            })

            $(document).ready(function() {
                $(function() {
                    $('#tanggal_mulai, #tanggal_selesai').datetimepicker({
                        format:'DD/MM/YYYY'
                    });
                });



                $('#hide-dashboard').hide();
            });

            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var Table;
                urlTable = "{{ url('api/modaldashboard') }}";
                'use strict';
                Table = $('#data-modal').DataTable({
                    dom:"<'row posisi'B>lftip",
                    buttons: [{
                        extend:'excel',
                        filename: function () { return nama_kegiatan; },
                        autoFilter: true,
                        text: '<i class = "fa fa-file-excel-o"> Export Excel</i>',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],
                        }
                    }],
                    colReorder: true,
                    processing: true,
                    serverSide:true,
                    ajax:{
                        "url" :urlTable,
                        "type" : "POST",
                        beforeSend: function(){
                            $('.gifLoading').show();
                        },
                        complete: function() {
                            $('.gifLoading').hide();
                        }
                    },
                    columns: [
                        {data: 'id',name:'id'},
                        {data: 'peminjamans.nama'},
                        {data: 'kegiatans.nama_kegiatan'},
                        {data: 'peminjamans.via'},
                        {data: 'tanggalpinjamstring', name:'tanggal_pinjam'},
                        {data: 'tanggalkembalistring', name:'tanggal_kembali'},
                        {data: 'created_at', orderable:false, visible:false, searchable:false},
                    ],
                        columnDefs: [ {
                        searchable: false,
                        orderable:false,
                        targets: 0
                    } ],
                    aLengthMenu: [[15,25, 50, 75, -1], [15,25, 50, 75, "Semua"]],
                    order: [[ 6, 'desc' ]],
                    iDisplayLength: 15,
                    language: {
                    lengthMenu: "Menampilkan _MENU_",
                    zeroRecords: "Data yang anda cari tidak ada, Silahkan masukan keyword lainnya",
                    info: "Halaman _PAGE_ dari _PAGES_ Halaman",
                    infoEmpty: "-",
                    infoFiltered: "(dari _MAX_ total data)",
                    loadingRecords: "Silahkan Tunggu...",
                    processing:     "Dalam Proses...",
                    search:         "Cari:",
                    paginate: {
                        first:      "Awal",
                        last:       "Akhir",
                        next:       "Selanjutnya",
                        previous:   "Kembali"
                    },
                },
                }),
                Table.on( 'draw.dt', function () {
                    var PageInfo = $('#data-modal').DataTable().page.info();
                        Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    });
                });
            });

window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
    height: 300,
    theme: "light1", // "light1", "light2", "dark1", "dark2"
	data: [{
		type: "area", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",
        dataPoints: <?php echo json_encode($grafik, JSON_NUMERIC_CHECK); ?>,
        click: function(e){
            console.log(e.dataPoint.label + e.dataPoint.y)
        }
	}]
});
chart.render();

}



// function toggleDataSeries(e) {
// if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
// e.dataSeries.visible = false;
// } else {
// e.dataSeries.visible = true;
// }
// e.chart.render();
// }

        </script>
    @endpush
@endsection
