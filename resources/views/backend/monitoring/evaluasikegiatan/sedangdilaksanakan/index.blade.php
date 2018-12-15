<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/12/2017
 * Time: 11:50 AM
 */
?>
@extends('backend.monitoring.evaluasikegiatan.base')

@section('title', trans('backend/monitoring/evaluasikegiatan.sedang_dilaksanakan.index.title', ['total' => $totalkegiatan]), @parent)

@section('actions')
    @role('user')
        <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn bg-light-blue btn-flat btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
    @endrole
@endsection

@section('sedang-diajukan')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('monitoring.evaluasi-kegiatan.sedang-dilaksanakan.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">
                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="@lang('backend/_globals.forms.search')..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="bagian.nama_bagian">@lang('backend/pengajuan.kegiatan.tables.bagian_id')</option>
                                    <option value="kegiatan.no_pengajuan2">@lang('backend/pengajuan.kegiatan.tables.no_aju')</option>
                                    <option value="kegiatan.tgl_pengajuan">@lang('backend/pengajuan.kegiatan.tables.tgl_pengajuan')</option>
                                    <option value="kegiatan.no_mak">@lang('backend/pengajuan.kegiatan.tables.no_mak')</option>
                                    <option value="kegiatan.nama_kegiatan">@lang('backend/pengajuan.kegiatan.tables.nama_kegiatan')</option>
                                    <option value="kegiatan.tgl_awal">@lang('backend/pengajuan.kegiatan.tables.tgl_awal')</option>
                                    <option value="kegiatan.tgl_akhir">@lang('backend/pengajuan.kegiatan.tables.tgl_akhir')</option>
                                    <option value="kegiatan.total_realisasi">@lang('backend/pengajuan.kegiatan.tables.total_realisasi')</option>
                                    <option value="status.keterangan">@lang('backend/pengajuan.kegiatan.tables.status')</option>
                                    <option value="status.posisi_dokumen">@lang('backend/pengajuan.kegiatan.tables.posisi_dok')</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    @if($totalkegiatan > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/pengajuan.kegiatan.tables.bagian_id')</th>
                                <th>@lang('backend/pengajuan.kegiatan.tables.no_aju')</th>
                                <th>@lang('backend/pengajuan.kegiatan.tables.no_mak')</th>
                                <th>@lang('backend/pengajuan.kegiatan.tables.nama_kegiatan')</th>
                                <th>@lang('backend/pengajuan.kegiatan.tables.tgl_kegiatan')</th>
                                <th>@lang('backend/pengajuan.kegiatan.tables.status')</th>
                                <th>@lang('backend/pengajuan.kegiatan.tables.posisi_dok')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.tables.total_pengajuan')</th>
                            </tr>
                            @foreach($kegiatans as $key => $kegiatan)
                                @role('bendahara')
                                    @if($kegiatan->status->kode_status == 'KG04')
                                        <tr class="bg-yellow color-palette">
                                    @elseif($kegiatan->status->kode_status == 'KG05')
                                        <tr class="bg-aqua-active color-palette">
                                    @elseif($kegiatan->status->kode_status == 'KG06')
                                        <tr class="bg-green color-palette">
                                    @else
                                        <tr>
                                    @endif
                                @endrole

                                @if($kegiatan->status->kode_status == 'KG02' || $kegiatan->status->kode_status == 'KG03')
                                    <tr class="bg-yellow color-palette">
                                @elseif($kegiatan->status->kode_status == 'KG04' || $kegiatan->status->kode_status == 'KG05')
                                    <tr class="bg-aqua-active color-palette">
                                @elseif($kegiatan->status->kode_status == 'KG06' || $kegiatan->status->kode_status == 'KG09')
                                    <tr class="bg-green color-palette">
                                @else
                                    <tr>
                                @endif
                                    <td>{{ $kegiatan->bagian->nama_bagian }}</td>
                                    <td>{{ $kegiatan->no_pengajuan2 }}</td>
                                    <td>{{ $kegiatan->no_mak }}</td>
                                    <td>{{ $kegiatan->nama_kegiatan }}</td>
                                    <td>{{ date('d', strtotime($kegiatan->tgl_awal)) }} s.d {{ date('d M Y', strtotime($kegiatan->tgl_akhir)) }}</td>
                                    <td>{{ $kegiatan->status->keterangan }}</td>
                                    <td>{{ $kegiatan->status->posisi_dokumen }}</td>
                                    <td class="text-right">{{ number_format($kegiatan->total_realisasi, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-right" colspan="7">@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
                                <th class="text-right">{{ number_format($totalrealisasi->total_realisasi, 0, ',', '.') }}</th>
                            </tr>
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/monitoring/evaluasikegiatan.sedang_diajukan.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
