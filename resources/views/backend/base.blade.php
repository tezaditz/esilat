<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 11:20 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-kemenkes.ico') }}"/>
    <meta name="description" content="">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @section('stylesheet')
        <link rel="stylesheet" href="{{ asset('PACE/themes/white/pace-theme-minimal.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/skins/_all-skins.min.css') }}">
        {!! Charts::assets() !!}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @show
</head>
<body class="fixed skin-black sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{ asset('img/logo-kemenkes.png') }}" style="width: 40px; height: 40px;" alt=""></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="{{ asset('img/logo-kemenkes.png') }}" style="width: 50px; height: 50px;" alt=""><b>{{ config('app.name') }}</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <span class="navbar-brand"><b>{{ \Carbon\Carbon::now('Asia/Jakarta')->format('d/m/Y') }}</b></span>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ Gravatar::src(Auth::user()->email) }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                 <img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-circle" alt="User Image">
                                <p>
                                    {{ Auth::user()->name }} - {{ Auth::user()->roles->first()->display_name }}
                                    <small>@lang('backend/_globals.member') {{ Auth::user()->created_at->diffForHumans() }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            {{--<li class="user-body"></li>--}}
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('backend/_globals.nav.keluar')</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                     <img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{ Request::url() == route('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>@lang('backend/_globals.nav.home')</span></a></li>
                <li class="{{ Request::url() == route('keuangan.sas.dashboard-sas') ? 'active' : '' }}"><a href="{{ route('keuangan.sas.dashboard-sas') }}"><i class="fa fa-area-chart"></i> <span>@lang('backend/_globals.nav.sas')</span></a></li>

                <li class="treeview {{ Request::segment(1) == 'pengajuan' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>@lang('backend/pengajuan.module')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::url() == route('pengajuan.kegiatan.index') ? 'active' : '' }}"><a href="{{ route('pengajuan.kegiatan.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/pengajuan.submodule.kegiatan')</a></li>
                        <li class="{{ (Request::url() == route('pengajuan.perjadin-dalam-negeri.index') ? 'active' : '') }}"><a href="{{ route('pengajuan.perjadin-dalam-negeri.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.perjadin_dalam_negeri')</a></li>

                        <li class="{{ (Request::url() == route('pengajuan.perjadin-luar-negeri.index') ? 'active' : '') }}"><a href="{{ route('pengajuan.perjadin-luar-negeri.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.perjadin_luar_negeri')</a></li>

                        <li class="{{ Request::url() == route('pengajuan.layanan-perkantoran.index') ? 'active' : '' }}"><a href="{{ route('pengajuan.layanan-perkantoran.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.layanan_perkantoran')</a></li>
                        {{--<li><a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.pengadaan')</a></li>--}}

                        <li class="{{ Request::url() == route('pengajuan.upload.index') ? 'active' : '' }}"><a href="{{ route('pengajuan.upload.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.upload_pengajuan')</a></li>

                    </ul>
                </li>
                <li class="treeview {{ Request::segment(1) == 'pertanggungjawaban' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-check-circle"></i> <span>@lang('backend/_globals.nav.pertanggungjawaban')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::url() == route('pertanggungjawaban.kegiatan.index') ? 'active' : '' }}"><a href="{{ route('pertanggungjawaban.kegiatan.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/pengajuan.submodule.kegiatan')</a></li>

                        <li class="{{ Request::url() == route('pertanggungjawaban.perjadin-dalam-negeri.index') ? 'active' : '' }}"><a href="{{ route('pertanggungjawaban.perjadin-dalam-negeri.index') }}"><i class="fa fa-circle-o"></i> Perjadin Dalam Negeri</a></li>

                        <li class="{{ (Request::url() == route('pertanggungjawaban.perjadin-luar-negeri.index')) ? 'active' : '' }}"><a href="{{ route('pertanggungjawaban.perjadin-luar-negeri.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.perjadin_luar_negeri')</a></li>

                        <li class="{{ Request::url() == route('pertanggungjawaban.layanan-perkantoran.index') ? 'active' : '' }}"><a href="{{ route('pertanggungjawaban.layanan-perkantoran.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.layanan_perkantoran')</a></li>
                        {{--<li><a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.pengadaan')</a></li>--}}
                    </ul>
                </li>
                <li class="treeview {{ Request::segment(1) == 'monitoring' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-tachometer"></i> <span>@lang('backend/_globals.nav.monitoring')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('monitoring.rpkrpd.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.rpkrpd')</a></li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.perbendaharanaan')
                                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.evaluasi_kehadiran_pegawai')</a></li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.berkas_rampung')</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.realisasi_kinerja')</a></li>
                        <li class="{{ Request::segment(2) == 'realisasi-anggaran' ? 'active' : '' }}"><a href="{{ route('monitoring.realisasi-anggaran.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.realisasi_anggaran')</a></li>
                        <li class="treeview {{ Request::segment(2) == 'evaluasi-kegiatan' ? 'active' : '' }}">
                            <a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.evaluasi_kegiatan')
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Request::segment(3) == 'sedang-diajukan' ? 'active' : '' }}"><a href="{{ route('monitoring.evaluasi-kegiatan.sedang-diajukan') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.sedang_diajukan')</a></li>
                                <li class="{{ Request::segment(3) == 'sedang-dilaksanakan' ? 'active' : '' }}"><a href="{{ route('monitoring.evaluasi-kegiatan.sedang-dilaksanakan') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.sedang_dilaksanakan')</a></li>
                                <li class="{{ Request::segment(3) == 'selesai-dilaksanakan' ? 'active' : '' }}"><a href="{{ route('monitoring.evaluasi-kegiatan.selesai-dilaksanakan') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.selesai_dilaksanakan')</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.rekapitulasi_pajak_ns_dan_honor')</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.evaluasi_kehadiran_pegawai')</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.rekap_surat_tugas')</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.rencana_tahun_depan')</a></li>
                    </ul>
                </li>
                <li class="treeview {{ Request::segment(1) == 'master' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-database"></i> <span>@lang('backend/_globals.nav.master')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::url() == route('master.pimpinan.index') ? 'active' : '' }}"><a href="{{ route('master.pimpinan.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/pimpinan.module')</a></li>
                        <li class="{{ Request::url() == route('master.rkakl.index') ? 'active' : '' }}"><a href="{{ route('master.rkakl.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/rkakl.module')</a></li>
                        <li class="{{ Request::url() == route('master.no-pengajuan.index') ? 'active' : '' }}"><a href="{{ route('master.no-pengajuan.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/nopengajuan.module')</a></li>
                        <li class="{{ Request::url() == route('master.hotel.index') ? 'active' : '' }}"><a href="{{ route('master.hotel.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/hotel.module')</a></li>
                        <li class="{{ Request::url() == route('master.provinsi.index') ? 'active' : '' }}"><a href="{{ route('master.provinsi.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/provinsi.module')</a></li>
                        <li class="{{ Request::url() == route('master.metodebayar.index') ? 'active' : '' }}"><a href="{{ route('master.metodebayar.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/metodebayar.module')</a></li>
                        <li class="{{ Request::url() == route('master.jabatan.index') ? 'active' : '' }}"><a href="{{ route('master.jabatan.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/jabatan.module')</a></li>
                        <li class="{{ Request::url() == route('master.bagian.index') ? 'active' : '' }}"><a href="{{ route('master.bagian.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/bagian.module')</a></li>
                        <li class="{{ Request::url() == route('master.pangkat.index') ? 'active' : '' }}"><a href="{{ route('master.pangkat.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/pangkat.module')</a></li>
                        <li class="{{ Request::url() == route('master.status.index') ? 'active' : '' }}"><a href="{{ route('master.status.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/status.module')</a></li>
                        <li class="{{ Request::url() == route('master.eselon.index') ? 'active' : '' }}"><a href="{{ route('master.eselon.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/eselon.module')</a></li>
                        <li class="{{ Request::url() == route('master.pegawai.index') ? 'active' : '' }}"><a href="{{ route('master.pegawai.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/pegawai.module')</a></li>
                        <li class="{{ Request::url() == route('master.tamu.index') ? 'active' : '' }}"><a href="{{ route('master.tamu.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/master/tamu.module')</a></li>
                    </ul>
                </li>
                <li class="treeview {{ Request::segment(1) == 'keuangan' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>@lang('backend/keuangan.module')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
<!--                     <ul class="treeview-menu">
                        <li class="{{ Request::url() == route('keuangan.spm.index') ? 'active' : '' }}"><a href="{{ route('keuangan.spm.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/keuangan.submodule.SPM')</a></li>
                        
                    </ul> -->
                    <ul class="treeview-menu">
                        <li class="{{ Request::url() == route('keuangan.sas.index') ? 'active' : '' }}"><a href="{{ route('keuangan.sas.index') }}"><i class="fa fa-circle-o"></i> @lang('backend/_globals.nav.sas_index')</a></li>
                        <li class="{{ Request::url() == route('keuangan.sp2d.index') ? 'active' : '' }}"><a href="{{ route('keuangan.sp2d.index') }}"><i class="fa fa-circle-o"></i> SP2D</a></li>
                    </ul>
                </li>

                @role('administrator')
                <li class="header">@lang('backend/_globals.nav.other')</li>
                <li class="{{ Request::url() == route('user.index') ? 'active' : '' }}" ><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> @lang('backend/user.module')</a></li>
                @endrole

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            @yield('content-header')

        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Hosted with</b> <i class="fa fa-heart"></i> <b>by</b> <i class="fa fa-github"></i> - <strong>{{ config('app.version') }}</strong>
        </div>
        <strong>Copyright &copy; {{ date('Y') }} <a href="#">{{ config('app.name') }}</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@section('javascript')
    <script src="{{ asset('PACE/pace.min.js') }}"></script>
    <script src="{{ asset('jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
    <script src="{{ asset('chartjs/Chart.min.js') }}"></script>
    

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@show
</body>
</html>