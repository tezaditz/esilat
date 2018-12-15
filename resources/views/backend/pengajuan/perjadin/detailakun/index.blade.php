<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/22/2017
 * Time: 04:35 PM
 */
?>
@extends('backend.pengajuan.perjadin.detailakun.base')

@section('title', trans('backend/pertanggungjawaban.perjadin.submodule.detail_akun.index.title', ['total' => $perjadinakuns->total()]), @parent)

@section('actions')
    @if($perjadinakuns->total() != 0)
        <a href="{{ route('pengajuan.perjadin-dalam-negeri.detail-akun.list-akun', $perjadin_id) }}" class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
    @endif
@endsection

@section('detail-akun-perjadin')
	    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('pengajuan.perjadin-dalam-negeri.detail-akun.search', $perjadin_id) }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">
                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="cari..." value="{{ Request::input('search') }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="kode_11">@lang('backend/_globals.tables.akun')</option>
                                    <option value="uraian">@lang('backend/_globals.tables.uraian')</option>
                                    <option value="jumlah">@lang('backend/_globals.tables.jumlah')</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($perjadinakuns->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/_globals.tables.akun')</th>
                                <th>@lang('backend/_globals.tables.uraian')</th>
                                <th>@lang('backend/_globals.tables.jumlah')</th>
                                <th></th>
                            </tr>
                            @foreach($perjadinakuns as $key => $perjadinakun)
                                <tr>
                                    <td style="width: 90px">{{ $perjadinakun->kode_11 }}</td>
                                    <td>{{ $perjadinakun->uraian }}</td>
                                    <td class="text-right" style="width: 90px">{{ number_format($perjadinakun->jumlah_pengajuan ,0, ',', '.') }}</td>
                                    <td class="text-right" style="width: 90px">
                                        <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#remove-modal{{ $perjadinakun->id }}" ><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-right" colspan="2">@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
                                <th class="text-right">{{ number_format($perjadinakuns->sum('jumlah_pengajuan') ,0, ',', '.') }}</th>
                                <th></th>
                            </tr>
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/pertanggungjawaban.perjadin.submodule.detail_akun.index.is_empty')</h4>
                            <a href="{{ route('pengajuan.perjadin-dalam-negeri.detail-akun.list-akun', $perjadin_id) }}" class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    @if($perjadinakuns->total() > 0)
                        <a href="{{ route('pengajuan.perjadin-dalam-negeri.detail-pelaksana', $perjadin_id) }}" class="btn btn-success btn-flat btn-sm">@lang('backend/_globals.buttons.next') <i class="fa fa-arrow-right"></i></a>
                    @endif
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $perjadinakuns])
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

    @foreach($perjadinakuns as $perjadinakun)
        <div class="modal fade" id="remove-modal{{ $perjadinakun->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('pengajuan.perjadin-dalam-negeri.detail-akun.destroy', $perjadinakun->id) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/pertanggungjawaban.perjadin.submodule.detail_akun.tables.akun')</h4>
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