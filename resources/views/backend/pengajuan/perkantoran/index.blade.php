<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:14 AM
 */
?>
@extends('backend.pengajuan.perkantoran.base')

@section('title', trans('backend/perkantoran.perkantoran.index.title', ['total' => $perkantorans->total()]), @parent)

@section('actions')
    @role('user')
    <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
    @endrole
@endsection

@section('perkantoran')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">

                        <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('pengajuan.layanan-perkantoran.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">

                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="cari..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="perkantoran.no_pengajuan">@lang('backend/perkantoran.perkantoran.tables.no_pengajuan')</option>
                                    <option value="perkantoran.tgl_pengajuan">@lang('backend/perkantoran.perkantoran.tables.tgl_pengajuan')</option>
                                    <option value="perkantoran.no_mak">@lang('backend/perkantoran.perkantoran.tables.no_mak')</option>
                                    <option value="perkantoran.uraian">@lang('backend/perkantoran.perkantoran.tables.uraian')</option>
                                    <option value="perkantoran.keterangan">@lang('backend/perkantoran.perkantoran.tables.keterangan')</option>
                                    <option value="perkantoran.total_nilai">@lang('backend/perkantoran.perkantoran.tables.total_nilai')</option>
                                    <option value="status.keterangan">@lang('backend/perkantoran.perkantoran.tables.status_id')</option>
                                </select>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($perkantorans->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/perkantoran.perkantoran.tables.no_pengajuan')</th>
                                <th>@lang('backend/perkantoran.perkantoran.tables.tgl_pengajuan')</th>
                                <th>@lang('backend/perkantoran.perkantoran.tables.no_mak')</th>
                                <th>@lang('backend/perkantoran.perkantoran.tables.uraian')</th>
                                <th>@lang('backend/perkantoran.perkantoran.tables.keterangan')</th>
                                <th>@lang('backend/perkantoran.perkantoran.tables.total_nilai')</th>
                                <th>@lang('backend/perkantoran.perkantoran.tables.status_id')</th>
                                <th>@lang('backend/_globals.tables.posisi_dok')</th>
                                <th></th>
                            </tr>
                            @foreach($perkantorans as $key => $perkantoran)
                                @if($perkantoran->status->kode_status == 'KG02' || $perkantoran->status->kode_status == 'KG03' )
                                    <tr class="bg-yellow color-palette">
                                @elseif($perkantoran->status->kode_status == 'KG04' || $perkantoran->status->kode_status == 'KG05' )
                                    <tr class="bg-aqua-active color-palette">
                                @elseif($perkantoran->status->kode_status == 'PK00')
                                    <tr class="bg-green color-palette">
                                @endif
                                    <td>{{ $perkantoran->no_pengajuan }}</td>
                                    <td>{{ date('d M Y', strtotime($perkantoran->tgl_pengajuan)) }}</td>
                                    <td>{{ $perkantoran->no_mak }}</td>
                                    <td>{{ $perkantoran->uraian }}</td>
                                    <td>{{ $perkantoran->keterangan }}</td>
                                    <td class="text-right">{{ number_format($perkantoran->total_nilai ,0 ,',', '.') }}</td>
                                    <td>{{ $perkantoran->status->keterangan }}</td>
                                    <td>{{ $perkantoran->status->posisi_dokumen }}</td>
                                    <td class="text-right" width="120px">
                                        <a href="{{ route('pengajuan.layanan-perkantoran.draft-perkantoran', $perkantoran->id) }}" class="btn btn-default btn-flat btn-xs" title="@lang('backend/_globals.buttons.show')"><i class="fa fa-eye"></i></a>
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
                            <h4 class="no-margins">@lang('backend/perkantoran.perkantoran.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $perkantorans])
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

    @foreach($perkantorans as $perkantoran)
        <div class="modal fade" id="remove-modal{{ $perkantoran->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('pengajuan.layanan-perkantoran.destroy', $perkantoran->id) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/perkantoran.submodule.perkantora')</h4>
                        </div>
                        <div class="modal-body">

                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            Ingin menghapus data?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('backend/_globals.buttons.yes')</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
@endsection