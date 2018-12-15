<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:14 AM
 */
?>
@extends('backend.pertanggungjawaban.perjadin-luar-negeri.base')

@section('title', trans('backend/pertanggungjawaban.perjadin.index.perjadin_luar_title', ['total' => $perjadins->total()]), @parent)

{{-- @section('actions')
    <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
@endsection --}}

@section('perjadin')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('pertanggungjawaban.perjadin-luar-negeri.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">
                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="cari..." value="{{ Request::input('search') }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="bagian.nama_bagian">@lang('backend/_globals.tables.bagian_id')</option>
                                    <option value="perjadin.no_pengajuan">@lang('backend/_globals.tables.no_pengajuan')</option>
                                    <option value="perjadin.tgl_pengajuan">@lang('backend/_globals.tables.tgl_pengajuan')</option>
                                    <option value="perjadin.no_mak">@lang('backend/_globals.tables.no_mak')</option>
                                    <option value="perjadin.nama_kegiatan">@lang('backend/_globals.tables.nama_kegiatan')</option>
                                    <option value="perjadin.no_surat_tugas">@lang('backend/pertanggungjawaban.perjadin.tables.no_surat_tugas')</option>
                                    <option value="perjadin.tgl_surat_tugas">@lang('backend/pertanggungjawaban.perjadin.tables.tgl_surat_tugas')</option>
                                    <option value="perjadin.tgl_awal">@lang('backend/_globals.tables.tgl_awal')</option>
                                    <option value="perjadin.tgl_akhir">@lang('backend/_globals.tables.tgl_akhir')</option>
                                    <option value="perjadin.lama">Lama</option>
                                    <option value="provinsi.title">@lang('backend/pertanggungjawaban.perjadin.tables.provinsi_id')</option>
                                    <option value="kabkota.nama">@lang('backend/_globals.tables.kabkota_id')</option>
                                    <option value="status.keterangan">@lang('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.tables.keterangan')</option>
                                    <option value="status.posisi_dokumen">@lang('backend/_globals.tables.posisi_dok')</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($perjadins->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/pertanggungjawaban.perjadin.tables.bagian_id')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.tables.no_aju')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.tables.tgl_pengajuan')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.tables.no_mak')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.tables.nama_kegiatan')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.tables.tgl_kegiatan')</th>
                                <th>Tujuan</th>
                                <th>Pengajuan</th>
                                <th>Realisasi</th>
                                <th>Pengembalian</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.tables.status')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.tables.posisi_dok')</th>
                                <th></th>
                            </tr>
                            @foreach($perjadins as $key => $perjadin)
                                <tr>
                                    <td>{{ $perjadin->bagian->nama_bagian }}</td>
                                    <td>
                                        <?php $noaju = $perjadin->no_pengajuan; ?>
                                        @if(strlen($noaju) == 1)
                                            <?php $noaju = '00' . $noaju; ?>
                                        @elseif(strlen($noaju) == 2)
                                            <?php $noaju = '0' . $noaju; ?>
                                        @endif
                                        AJU-{{ $noaju }}/{{ $perjadin->bagian->kode }}/{{ $perjadin->thn_anggaran }}  
                                    <td>{{ date('d M Y', strtotime($perjadin->tgl_pengajuan)) }}</td>
                                    <td>{{ $perjadin->no_mak }}</td>
                                    <td>{{ $perjadin->nama_kegiatan }}</td>
                                    <td>{{ date('d', strtotime($perjadin->tgl_awal)) }} s.d {{ date('d M Y', strtotime($perjadin->tgl_akhir)) }}</td>
                                    <td>{{ $perjadin->negara->nama_negara  }}</td>
                                    <td class="text-right">{{ number_format($totalpengajuans->where('perjadin_id', $perjadin->id)->
                                        where('keterangan', '=', 'perjadin-luar-negeri')->sum('jumlah_pengajuan') ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($totalpengajuans->where('perjadin_id', $perjadin->id)->
                                        where('keterangan', '=', 'perjadin-luar-negeri')->sum('pj_jumlah') ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format(($totalpengajuans->where('perjadin_id', $perjadin->id)->sum('jumlah_pengajuan') - $totalpengajuans->where('perjadin_id', $perjadin->id)->sum('pj_jumlah')) ,0, ',', '.') }}</td>
                                    <td>{{ $perjadin->status->keterangan }}</td>
                                    <td>{{ $perjadin->status->posisi_dokumen }}</td>
                                    <td class="text-right">
                                    @if($perjadin->status->kode_status == 'PR04' || $perjadin->status->kode_status == 'PR08')
                                        <a href="{{ route('pertanggungjawaban.perjadin-luar-negeri.pj_detail',[$perjadin->id]) }}" class="btn btn-default btn-flat btn-xs"><i class="fa fa-eye"></i></a>
                                    @else
                                        <a href="{{ route('pertanggungjawaban.perjadin-luar-negeri.pj_draf',[$perjadin->id]) }}" class="btn btn-default btn-flat btn-xs"><i class="fa fa-eye"></i></a>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/kegiatan.perjadin.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $perjadins])
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection