<!DOCTYPE html>
<html lang="en">
    <head>
        <title>H2P Warkah</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/joli/img/bpnlogo.png"/>
        <link rel="stylesheet" type="text/css" id="theme" href="/joli/css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" href="/css/custom-theme.css?v=1"/>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="page-container">
            <div class="page-sidebar">
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="{{ url('home') }}">H2P
                            <span style="font-size: 14px;font-family: cursive;">
                                warkah.
                            </span>
                        </a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="{{ Auth::user()->foto }}" />
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="{{ Auth::user()->foto }}" />
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">{{ Auth::user()->name }}</div>
                                <div class="profile-data-title">{{ Auth::user()->jabatan }}</div>
                            </div>
                        </div>
                    </li>
                    @php  $user = request()->user() @endphp
                    <li class="xn-title">Menu</li>
                    {{--  @if ($user->hasAnyRole(['admin','dashboard',]))  --}}
                    <li class="{{ (request()->is('home*')) ? 'active' : '' }}">
                        <a href="{{ url('home') }}"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>
                    </li>
                    {{--  @endif  --}}
                    @if ($user->hasAnyRole(['admin']))
                    <li class="{{ (request()->is('peminjaman/register')) ? 'active' : '' }}">
                        <a href="{{ url('peminjaman/register') }}"><span class="fa fa-laptop"></span> <span class="xn-text">Peminjaman Register</span></a>
                    </li>
                    <li class="{{ (request()->is('peminjaman/validasi')) ? 'active' : '' }}">
                         <a href="{{ url('peminjaman/validasi') }}"><span class="fa fa-check-square-o"></span> <span class="xn-text">Peminjaman Validasi</span></a>
                    </li>
                    @endif
                    <li class="{{ (request()->is('peminjaman/monitoring')) ? 'active' : '' }}">
                        <a href="{{ url('peminjaman/monitoring') }}"><span class="fa fa-search"></span> <span class="xn-text">Peminjaman Monitoring</span></a>
                    </li>
                    @if ($user->hasAnyRole(['admin']))
                    <li class="{{ (request()->is('pengembalian/validasi')) ? 'active' : '' }}">
                         <a href="{{ url('pengembalian/validasi') }}"><span class="fa fa-refresh"></span> <span class="xn-text">Pengembalian Validasi</span></a>
                    </li>
                    <li class="{{ (request()->is('pengembalian/history')) ? 'active' : '' }}">
                         <a href="{{ url('pengembalian/history') }}"><span class="fa fa-search-plus"></span> <span class="xn-text">Pengembalian Histori</span></a>
                    </li>
                    @if ($user->hasAnyRole(['admin']))
                    <li class="xn-title">Admin</li>
                    <li class="xn-openable {{ (request()->is('user*') || request()->is('logs')) ? 'active' : '' }}">
                        <a><span class="fa fa-users"></span> <span class="xn-text">User</span></a>
                        <ul>
                            <li class="{{ (request()->is('user')) ? 'active' : '' }}">
                                <a href="{{ url('user') }}"><span class="fa fa-code"></span> Profile</a>
                            </li>
                            {{-- <li class="{{ (request()->is('logs')) ? 'active' : '' }}">
                                <a href="{{ url('logs') }}"><span class="fa fa-code"></span> Logs</a>
                            </li> --}}
                            <li class="{{ (request()->is('users')) ? 'active' : '' }}">
                                <a href="{{ url('users') }}"><span class="fa fa-code"></span> Users</a>
                            </li>
                            <li class="{{ (request()->is('userrole')) ? 'active' : '' }}">
                                <a href="{{ url('userrole') }}"><span class="fa fa-code"></span> User Roles</a>
                            </li>
                            {{-- <li class="{{ (request()->is('userpermission')) ? 'active' : '' }}">
                                <a href="{{ url('userpermission') }}"><span class="fa fa fa-unlock-alt"></span> User Permissions</a>
                            </li> --}}
                        </ul>
                    </li>
                     <li class="xn-openable {{ (request()->is('master*')) ? 'active' : '' }}">
                        <a><span class="fa fa-database"></span> <span class="xn-text">Master</span></a>
                        <ul>
                            <li class="{{ (request()->is('master/warkah')) ? 'active' : '' }}">
                                <a href="{{ url('master/warkah') }}"><span class="fa fa-code"></span> Warkah</a>
                            </li>
                            <li class="{{ (request()->is('master/kegiatan')) ? 'active' : '' }}">
                                <a href="{{ url('master/kegiatan') }}"><span class="fa fa-code"></span> Kegiatan</a>
                            </li>
                            <li class="{{ (request()->is('master/peminjam')) ? 'active' : '' }}">
                                <a href="{{ url('master/peminjam') }}"><span class="fa fa-code"></span> Peminjam</a>
                            </li>
                        </ul>
                    </li>
                    <li class="xn-title"></li>
                    <li class="xn-title"></li>
                    @endif
                    @endif
                </ul>
            </div>
            <!-- PAGE CONTENT -->
            <div class="page-content">
                <div class="">
                    <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                        <li class="xn-icon-button">
                            <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a></li>
                        <li class="xn-search">
                            <form role="form">
                                <input type="text" name="search" placeholder="Search..." />
                            </form>
                        </li>
                        <li class="xn-icon-button pull-right">

                            {{-- <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a> --}}
                            <a href="#" style="padding: 10px;">
                                <img src="{{ Auth::user()->foto }}" style="width: 100%;border-radius: 100px;"/>
                            </a>
                            <div class="informer informer-warning"></div>
                            <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-tasks"></span> Menu</h3>
                                </div>
                                <div class="panel-body list-group scroll" style="height: 125px;">
                                    <a class="list-group-item mb-control" href="#" data-box="#mb-signout">
                                        <span class="fa fa-sign-out"></span> Logout
                                    </a>
                                    <a class="list-group-item" href="/profile">
                                        <span class="fa fa-user"></span> Profile
                                    </a>
                                    {{-- <a class="list-group-item" href="/logs">
                                        <span class="fa fa-list"></span> Logs
                                    </a> --}}
                                </div>
                            </div>
                        </li>

                        <li class="xn-icon-button pull-right">
                            <a href="#" class="full-screen"><span class="fa fa-desktop"></span></a>
                        </li>
                    </ul>
                </div>
                <ul class="breadcrumb">
                    <li><a href="#">@yield('level1')</a></li>
                    <li class="active">@yield('level2')</li>
                </ul>
                <div class="page-content-wrap">
                    @yield('dashboard')
                    <div class="row" id="hide-dashboard">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                @hasSection('judul')
                                <div class="panel-heading">
                                    <h3 class="panel-title">@yield('judul')</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                @endif
                                <div class="panel-body">
                                    @include('layouts.alert')
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-success btn-lg">Yes</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- gkobal alert --}}
        <div class="message-box animated fadeIn" data-sound="fail" id="globalalert">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-warning"></span>Konfirmasi <strong class="globalalertnotif"></strong></div>
                    <div class="mb-content">
                        <p class="globalalerthead"></p>
                        <p class="globalalertjudul" style="font-size:18px;"></p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <form method="POST" id="form" class="alert-form">
                                @csrf
                                @method('')
                                <input type="hidden" id="iddata" name="id">
                                <button type="submit" class="btn btn-primary btn-lg" id="ya">Ya!</button>
                                <a id="submitpeminjamanvalidasi" class="btn btn-success btn-lg">Ya, Validasi</a>
                                <a class="btn btn-default btn-lg cancelform">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <audio id="audio-alert" src="/joli/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="/joli/audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->

        <script type="text/javascript" src="/joli/js/plugins/jquery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/jquery/jquery.min.js"></script>
        {{--  <script type="text/javascript" src="/joli/js/plugins/jquery/jquery-ui.min.js"></script>  --}}
        <script type="text/javascript" src="/joli/js/plugins/jquery/jquery-ui2.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->
        <script type='text/javascript' src='/joli/js/plugins/icheck/icheck.min.js'></script>

        <script type="text/javascript" src="/joli/js/plugins/datatables/jquery.dataTables.min.js"></script>

        <script type="text/javascript" src="/joli/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/datatables/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/datatables/buttons.flash.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/datatables/jszip.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/datatables/pdfmake.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/datatables/vfs_fonts.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/datatables/buttons.html5.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/datatables/buttons.print.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/datatables/jquery.dataTables.yadcf.0.9.2.js"></script>


        <script type="text/javascript" src="/joli/js/plugins/datatables/dataTables.checkboxes.js"></script>


        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='/joli/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="/joli/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/scrolltotop/scrolltopcontrol.js"></script>

        <script type="text/javascript" src="/joli/js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='/joli/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='/joli/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
        {{--  <script type='text/javascript' src='/joli/js/plugins/bootstrap/bootstrap-datepicker.js'></script>  --}}
        <script type='text/javascript' src='/joli/js/plugins/moment.min.js'></script>

        <script type='text/javascript' src='/joli/js/plugins/bootstrap/bootstrap-datetimepicker.min.js'></script>
        <script type='text/javascript' src='/joli/js/plugins/moment.min.js'></script>
        <script type="text/javascript" src="/joli/js/plugins/owl/owl.carousel.min.js"></script>

        <script type="text/javascript" src="/joli/js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/daterangepicker/daterangepicker.js"></script>

        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="/joli/js/settings.js"></script>

        <script type="text/javascript" src="/joli/js/plugins.js"></script>
        <script type="text/javascript" src="/joli/js/actions.js"></script>

        <script type="text/javascript" src="/joli/js/plugins/toastr/toastr.min.js"></script>
        <script type="text/javascript" src="/joli/js/select2.min.js"></script>
        <script type="text/javascript" src="/joli/js/canvasjs.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>

        {{--  <script type="text/javascript" src="/joli/js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/morris/morris.min.js"></script>
        <script type="text/javascript" src="/joli/js/demo_dashboard.js"></script>  --}}
        <script>
        $('#submitpeminjamanvalidasi').hide();

        var errorpesan = 'Terjadi kesalan, silahkan reload atau hubungi pengembang';

        $(document).on('click', '.cancelform', function(){
            $('#globalalert').hide();
            $('#globalalert #ya').show();
        });

        $('.select2').select2();

        $.extend( true, $.fn.dataTable.defaults, {
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
                aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
        } );
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        $('.full-screen').on('click', function(){
            toggleFullscreen();
        })

        function toggleFullscreen(elem) {
            elem = elem || document.documentElement;
            if (!document.fullscreenElement && !document.mozFullScreenElement &&
                !document.webkitFullscreenElement && !document.msFullscreenElement) {
                if (elem.requestFullscreen) {
                elem.requestFullscreen();
                } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
                } else if (elem.mozRequestFullScreen) {
                elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.exitFullscreen) {
                document.exitFullscreen();
                } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
                }
            }
        }
        </script>





        @stack('scripts')

        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->

    </body>
</html>






