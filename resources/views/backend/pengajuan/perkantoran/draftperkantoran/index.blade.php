<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:14 AM
 */
?>
@extends('backend.pengajuan.perkantoran.draftperkantoran.base')

@section('title', trans('backend/perkantoran.submodule.draft_perkantoran'),  @parent)

@section('draft-perkantoran')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">@yield('title')</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>
                        <button type="button" class="btn btn-default btn-flat btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-default btn-flat btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <form class="form-horizontal">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_mak"
                                           class="col-sm-2 control-label">@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.no_mak')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_mak"
                                               value="{{ $perkantorans->no_mak }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uraian"
                                           class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.uraian')</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="uraian" rows="3"
                                                  readonly>{{ $perkantorans->uraian }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ket"
                                           class="col-sm-2 control-label">@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.keterangan')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ket"
                                               value="{{ $perkantorans->keterangan }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="total_nilai"
                                           class="col-sm-2 control-label">@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.total_nilai')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="total_nilai"
                                               value="{{ number_format($pengajuan->jumlah, 0, '.', '.') }}"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.col -->
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-widget">
                                <div class="box-header">
                                    <h3 class="box-title">@lang('backend/perkantoran.submodule.detail_pengajuan')</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>@lang('backend/pengajuan.kegiatan.tables.uraian')</th>
                                            <th>@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.total_pengajuan')</th>
                                        </tr>
                                        @forelse($detailPerkantorans as $detailPerkantoran)
                                            <tr>
                                                <td>{{ $detailPerkantoran->uraian }}</td>
                                                <td class="text-right" style="width: 120px">
                                                    {{ $english_format_number = number_format($detailPerkantoran->jumlah, 0, '.', '.') }}
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th class="text-right">@lang('backend/perkantoran.perkantoran.tables.total_nilai')</th>
                                                <td class="text-right">{{ number_format($detailPerkantorans->sum('jumlah'), 0, '.', '.') }}</td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-widget">
                                <div class="box-header">
                                    <h3 class="box-title">@lang('backend/perkantoran.submodule.dok_kelengkapan')</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>@lang('backend/pengajuan.kegiatan.tables.uraian')</th>
                                            <th>@lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.tables.ada')</th>
                                        </tr>
                                        @foreach($dokumenPerkantorans as $dokumenPerkantoran)
                                            <tr>
                                                <td>{{$dokumenPerkantoran->nama_dokumen}}</td>
                                                <td class="text-center" style="width: 90px">
                                                    @if($dokumenPerkantoran->ada == 1)
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                    @else
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <div class="pull-right">
                                        @include('backend._inc.pagination', ['paginator' => $dokumenPerkantorans])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <div class="box-footer clearfix">
                    @role('user')
                        @if($perkantorans->status->kode_status == 'PK00')
                            <a href="{{ route('pengajuan.layanan-perkantoran.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                            <a href="{{ route('pengajuan.layanan-perkantoran.kirim-layanan-perkantoran', $perkantorans->id ) }}" class="btn btn-primary btn-flat btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</a>
                        @else
                            <a href="{{ route('pengajuan.layanan-perkantoran.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                        @endif
                    @endrole

                    @role('bendahara')
                        @if($perkantorans->status->kode_status == 'PK01' || $perkantorans->status->kode_status == 'PK02')
                            <form method="post" action="{{ route('pengajuan.layanan-perkantoran.kirim-bendahara', $perkantorans->id) }}" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="metode" class="col-sm-3 control-label">@lang('backend/master/metodebayar.tables.metode_bayar')</label>
                                            <div class="col-sm-9">
                                                @if($metodebayars->count() > 0)
                                                    <div class="input-group input-group-sm">
                                                        <select name="metode" class="form-control select2" id="metode_bayar_id" style="width: 100%;" required>
                                                            @foreach($metodebayars as $key => $metodebayar)
                                                                <option value="{{ $metodebayar->kode }}">{{ $metodebayar->metode_bayar }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <a href="{{ route('master.metodebayar.index') }}" class="btn btn-flat"><i class="fa fa-plus"></i></a>
                                                        </span>
                                                    </div>
                                                    @if($errors->has('metode'))
                                                        <span class="help-block">
                                                            {{ $errors->first('metode') }}
                                                        </span>
                                                    @endif
                                                @else
                                                    <a href="{{ route('master.metodebayar.index') }}" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a> @lang('backend/master/metodebayar.metode_bayar.index.is_empty')
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_id" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.status')</label>
                                            <div class="col-sm-9">
                                                @if($metodebayars->count() > 0)
                                                    <div class="input-group input-group-sm">
                                                        <select name="status_id" class="form-control select2" id="status_id" style="width: 100%;" required>
                                                            @foreach($statuss as $key => $status)
                                                                <option value="{{ $status->id }}">{{ $status->keterangan }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="input-group-btn">
                                            <a href="{{ route('master.status.index') }}" class="btn btn-flat"><i class="fa fa-plus"></i></a>
                                        </span>
                                                    </div>
                                                    @if($errors->has('status_id'))
                                                        <span class="help-block">
                                        {{ $errors->first('status_id') }}
                                    </span>
                                                    @endif
                                                @else
                                                    <a href="{{ route('master.status.index') }}" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a> @lang('backend/master/status.status.index.is_empty')
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan" class="col-sm-2 control-label">@lang('backend/master/status.tables.keterangan')</label>
                                            <div class="col-sm-10">
                                                <select name="keterangan" class="form-control select2" id="keterangan" style="width: 100%;" required>
                                                    <option value=""></option>
                                                    <option value="PG01">Di Terima</option>
                                                    <option value="PG09">Di Tolak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alasan" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.alasan')</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="alasan" name="alasan" rows="3" placeholder="" disabled></textarea>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>

                                <hr>

                                    <a href="{{ route('pengajuan.layanan-perkantoran.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                                    <button type="submit" class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</button>
                            </form>
                        @else
                            <a href="{{ route('pengajuan.layanan-perkantoran.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                        @endif

                        @if($perkantorans->status->kode_status == 'PK03')
                            <a href="{{ route('pengajuan.layanan-perkantoran.serahkan-uang', $perkantorans->id) }}" class="btn btn-success btn-flat btn-sm pull-right"> Uang Diserahkan</a>
                        @endif
                    @endrole
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="keterangan"]').change(function () {
                if ($('[name="keterangan"]').val() == 'PG09') {
                    $('[name="alasan"]').prop('disabled', false);
                } else {
                    $('[name="alasan"]').prop('disabled', true);
                }
            });
        });
    </script>
@stop