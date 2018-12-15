<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 03:35 PM
 */
?>
@extends('backend.master.status.base')

@section('title', trans('backend/master/status.status.index.title', ['total' => $statuss->total()]), @parent)

@section('actions')
    <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
@endsection

@section('status')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">

                        <a href="{{ route('master.status.index') }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('master.status.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">

                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="@lang('backend/_globals.forms.search')..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="kode_status">@lang('backend/master/status.tables.kode_status')</option>
                                    <option value="keterangan">@lang('backend/master/status.tables.keterangan')</option>
                                    <option value="posisi_dokumen">@lang('backend/master/status.tables.posisi_dokumen')</option>
                                    <option value="modul">@lang('backend/master/status.tables.modul')</option>
                                    <option value="kode_realisasi">@lang('backend/master/status.tables.kode_realisasi')</option>
                                </select>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($statuss->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/master/status.tables.kode_status')</th>
                                <th>@lang('backend/master/status.tables.keterangan')</th>
                                <th>@lang('backend/master/status.tables.posisi_dokumen')</th>
                                <th>@lang('backend/master/status.tables.modul')</th>
                                <th>@lang('backend/master/status.tables.kode_realisasi')</th>
                                <th>@lang('backend/master/status.tables.created_at')</th>
                                <th></th>
                            </tr>
                            @foreach($statuss as $key => $status)
                                <tr>
                                    <td>{{ $status->kode_status }}</td>
                                    <td>{{ $status->keterangan }}</td>
                                    <td>{{ $status->posisi_dokumen }}</td>
                                    <td>{{ $status->modul }}</td>
                                    <td>{{ $status->kode_realisasi }}</td>
                                    <td>{{ $status->created_at->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <a href="#" class="btn-default btn-sm" data-toggle="modal" data-target="#edit-modal{{ $status->id }}"><i class="fa fa-edit"></i> </a>

                                        <a href="#" class="btn-default btn-sm" data-toggle="modal" data-target="#show-modal{{ $status->id }}"><i class="fa fa-eye"></i> </a>
                                        <a href="#" class="btn-danger btn-sm" data-toggle="modal" data-target="#remove-modal{{ $status->id }}" ><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/master/status.status.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $statuss])
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

    @foreach($statuss as $status)
        <div class="modal fade" id="remove-modal{{ $status->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('master.status.destroy', $status->id) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/status.module')</h4>
                        </div>
                        <div class="modal-body">

                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            Ingin menghapus data?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">@lang('backend/_globals.buttons.cancel')</button>
                            <button type="submit" class="btn btn-danger btn-sm">@lang('backend/_globals.buttons.yes')</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
@endsection