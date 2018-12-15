<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:14 AM
 */
?>
@extends('backend.pertanggungjawaban.perkantoran.base')

@section('title', trans('backend/pertanggungjawaban.perkantoran.index.title', ['total' => $perkantorans->total()]), @parent)

@section('perkantoran')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('pertanggungjawaban.layanan-perkantoran.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">
                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="cari..." value="{{ Request::input('search') }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="perkantoran.no_pengajuan">@lang('backend/pertanggungjawaban.perkantoran.tables.no_pengajuan')</option>
                                    <option value="perkantoran.tgl_pengajuan">@lang('backend/pertanggungjawaban.perkantoran.tables.tgl_pengajuan')</option>
                                    <option value="perkantoran.no_mak">@lang('backend/pertanggungjawaban.perkantoran.tables.no_mak')</option>
                                    <option value="perkantoran.uraian">@lang('backend/pertanggungjawaban.perkantoran.tables.uraian')</option>
                                    <option value="perkantoran.keterangan">@lang('backend/pertanggungjawaban.perkantoran.tables.keterangan')</option>
                                    <option value="perkantoran.total_nilai">@lang('backend/pertanggungjawaban.perkantoran.tables.total_nilai')</option>
                                    <option value="status.keterangan">@lang('backend/pertanggungjawaban.perkantoran.tables.status_id')</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    @if($perkantorans->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/pertanggungjawaban.perkantoran.tables.no_pengajuan')</th>
                                <th>@lang('backend/pertanggungjawaban.perkantoran.tables.tgl_pengajuan')</th>
                                <th>@lang('backend/pertanggungjawaban.perkantoran.tables.no_mak')</th>
                                <th>@lang('backend/pertanggungjawaban.perkantoran.tables.uraian')</th>
                                <th>@lang('backend/pertanggungjawaban.perkantoran.tables.keterangan')</th>
                                <th>@lang('backend/pertanggungjawaban.perkantoran.tables.total_nilai')</th>

                                <th>Realisasi</th>
                                <th>Pengembalian</th>
                                <th>@lang('backend/pertanggungjawaban.perkantoran.tables.status_id')</th>
                                <th>@lang('backend/_globals.tables.posisi_dok')</th>
                                <th></th>
                            </tr>
                            @foreach($perkantorans as $key => $perkantoran)
                                <tr>
                                    <td>{{ $perkantoran->no_pengajuan }}</td>
                                    <td>{{ date('d M Y', strtotime($perkantoran->tgl_pengajuan)) }}</td>
                                    <td>{{ $perkantoran->no_mak }}</td>
                                    <td>{{ $perkantoran->uraian }}</td>
                                    <td>{{ $perkantoran->keterangan }}</td>
                                    <td class="text-right">{{ number_format($totalpengajuans->where('perkantoran_id', $perkantoran->id)->sum('jumlah') ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($totalpengajuans->where('perkantoran_id', $perkantoran->id)->sum('pj_jumlah') ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format(($totalpengajuans->where('perkantoran_id', $perkantoran->id)->sum('jumlah') - $totalpengajuans->where('perkantoran_id', $perkantoran->id)->sum('pj_jumlah')) ,0, ',', '.') }}</td>
                                    <td>{{ $perkantoran->status->keterangan }}</td>
                                    <td>{{ $perkantoran->status->posisi_dokumen }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('pertanggungjawaban.layanan-perkantoran.detail', $perkantoran->id) }}" class="btn btn-default btn-flat btn-xs" title="@lang('backend/_globals.buttons.show')"><i class="fa fa-eye"></i></a>
                                        @if($perkantoran->status->kode_status == 'PK00')
                                            <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#remove-modal{{ $perkantoran->id }}" ><i class="fa fa-trash"></i> </a>
                                        @endif
                                        @if($perkantoran->status->kode_status == 'PK01')
                                            @role('user')
                                            <a href="{{ route('pengajuan.layanan-perkantoran.nota-dinas', $perkantoran->id) }}" class="btn btn-success btn-flat btn-xs" title="Nota Dinas" target="_blank"><i class="fa fa-print"></i></a>
                                            @endrole
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/pertanggungjawaban.perkantoran.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $perkantorans])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection