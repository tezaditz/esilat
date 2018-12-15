<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/09/2017
 * Time: 12:04 PM
 */
?>
@extends('backend.pengajuan.perkantoran.dokumenperkantoran.base')

@section('title', trans('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.index.title', ['total' => $dokumenperkantorans->total()]), @parent)

@section('actions')
    @if($dokumenperkantorans->total() > 0)
    <a href="#" class="btn bg-light-blue btn-flat btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>|
    @endif
    <a href="{{ route('pengajuan.layanan-perkantoran.draft-perkantoran', $perkantoran_id) }}" class="btn btn-success btn-flat btn-sm">@lang('backend/_globals.buttons.next') <i class="fa fa-arrow-right"></i></a>
@endsection

@section('dokumen-perkantoran')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">

                        <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('pengajuan.layanan-perkantoran.dokumen.search', $perkantoran_id) }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">

                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="cari..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="nama_dokumen">@lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.tables.nama_dokumen')</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($dokumenperkantorans->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.tables.nama_dokumen')</th>
                                <th>@lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.tables.ada')</th>
                                <th></th>
                            </tr>
                            @foreach($dokumenperkantorans as $key => $dokumenperkantoran)
                                <tr>
                                    <td>{{ $dokumenperkantoran->nama_dokumen }}</td>
                                    <td class="text-center" style="width: 90px">
                                        @if($dokumenperkantoran->ada == 1)
                                            <span class="glyphicon glyphicon-ok"></span>
                                        @else
                                            <span class="glyphicon glyphicon-remove"></span>
                                        @endif
                                    </td>
                                    <td class="text-right" style="width: 50px">
                                        <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#remove-modal{{ $dokumenperkantoran->id }}" ><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.index.is_empty')</h4>
                            <a href="#" class="btn bg-light-blue btn-flat btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $dokumenperkantorans])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($dokumenperkantorans as $dokumenperkantoran)
        <div class="modal fade" id="remove-modal{{ $dokumenperkantoran->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('pengajuan.layanan-perkantoran.dokumen.destroy', [$dokumenperkantoran->perkantoran_id, $dokumenperkantoran->id]) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.tables.nama_dokumen')</h4>
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
            </div>
        </div>
    @endforeach
@endsection