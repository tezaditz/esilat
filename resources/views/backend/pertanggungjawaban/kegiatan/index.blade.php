<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:14 AM
 */
?>
@extends('backend.pertanggungjawaban.kegiatan.base')

@section('title', trans('backend/pertanggungjawaban.kegiatan.index.title', ['total' => $kegiatans->total()]), @parent)

@section('actions')
    @role('user')
    <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
    @endrole
@endsection

@section('kegiatan')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('pertanggungjawaban.kegiatan.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">

                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="cari..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="bagian.nama_bagian">@lang('backend/pertanggungjawaban.kegiatan.tables.bagian_id')</option>
                                    <option value="kegiatan.no_pengajuan2">@lang('backend/pertanggungjawaban.kegiatan.tables.no_aju')</option>
                                    <option value="kegiatan.tgl_pengajuan">@lang('backend/pertanggungjawaban.kegiatan.tables.tgl_pengajuan')</option>
                                    <option value="kegiatan.no_mak">@lang('backend/pertanggungjawaban.kegiatan.tables.no_mak')</option>
                                    <option value="kegiatan.nama_kegiatan">@lang('backend/pertanggungjawaban.kegiatan.tables.nama_kegiatan')</option>
                                    <option value="kegiatan.tgl_awal">@lang('backend/pertanggungjawaban.kegiatan.tables.tgl_awal')</option>
                                    <option value="kegiatan.tgl_akhir">@lang('backend/pertanggungjawaban.kegiatan.tables.tgl_akhir')</option>
                                    <option value="kegiatan.total_realisasi">@lang('backend/pertanggungjawaban.kegiatan.tables.total_realisasi')</option>
                                    <option value="status.keterangan">@lang('backend/pertanggungjawaban.kegiatan.tables.status')</option>
                                    <option value="status.posisi_dokumen">@lang('backend/pertanggungjawaban.kegiatan.tables.posisi_dok')</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    @if($kegiatans->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/pertanggungjawaban.kegiatan.tables.bagian_id')</th>
                                <th>@lang('backend/pertanggungjawaban.kegiatan.tables.no_aju')</th>
                                <th>@lang('backend/pertanggungjawaban.kegiatan.tables.tgl_pengajuan')</th>
                                <th>@lang('backend/pertanggungjawaban.kegiatan.tables.no_mak')</th>
                                <th>@lang('backend/pertanggungjawaban.kegiatan.tables.nama_kegiatan')</th>
                                <th>@lang('backend/pertanggungjawaban.kegiatan.tables.tgl_kegiatan')</th>
                                <th>@lang('backend/pertanggungjawaban.kegiatan.tables.total_realisasi')</th>
                                <th>Realisasi</th>
                                <th>Pengembalian</th>
                                <th>@lang('backend/pertanggungjawaban.kegiatan.tables.status')</th>
                                <th>@lang('backend/pertanggungjawaban.kegiatan.tables.posisi_dok')</th>
                                <th></th>
                            </tr>
                            @foreach($kegiatans as $key => $kegiatan)
                                <tr>
                                    <td>{{ $kegiatan->bagian->nama_bagian }}</td>
                                    <td>{{ $kegiatan->no_pengajuan2 }}</td>
                                    <td>{{ date('d M Y', strtotime($kegiatan->tgl_pertanggungjawaban)) }}</td>
                                    <td>{{ $kegiatan->no_mak }}</td>
                                    <td>{{ $kegiatan->nama_kegiatan }}</td>
                                    <td>{{ date('d', strtotime($kegiatan->tgl_awal)) }} s.d {{ date('d M Y', strtotime($kegiatan->tgl_akhir)) }}</td>
                                    <td class="text-right">{{ number_format($kegiatan->total_realisasi ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($totalpengajuans->where('kegiatan_id', $kegiatan->id)->sum('pj_jml_rph') ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format(($totalpengajuans->where('kegiatan_id', $kegiatan->id)->sum('jml_rph') - $totalpengajuans->where('kegiatan_id', $kegiatan->id)->sum('pj_jml_rph')) ,0, ',', '.') }}</td>
                                    <td>{{ $kegiatan->status->keterangan }}</td>
                                    <td>{{ $kegiatan->status->posisi_dokumen }}</td>
                                    <td class=" text-right">
                                        <a href="{{ route('pertanggungjawaban.kegiatan.detail',[$kegiatan->id]) }}" class="btn btn-default btn-flat btn-xs"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/pengajuan.kegiatan.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $kegiatans])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection