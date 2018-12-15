<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 03:35 PM
 */
?>
@extends('backend.master.pegawai.base')

@section('title', trans('backend/master/pegawai.pegawai.index.title', ['total' => $pegawais->total()]), @parent)

@section('actions')
    <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
@endsection

@section('pegawai')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">

                        <a href="{{ route('master.pegawai.index') }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('master.pegawai.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">

                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="@lang('backend/_globals.forms.search')..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="nama">@lang('backend/master/pegawai.tables.nama')</option>
                                    <option value="nip">@lang('backend/master/pegawai.tables.nip')</option>
                                    <option value="tempat_lahir">@lang('backend/master/pegawai.tables.tempat_lahir')</option>
                                    <option value="tgl_lahir">@lang('backend/master/pegawai.tables.tgl_lahir')</option>
                                    <option value="alamat">@lang('backend/master/pegawai.tables.alamat')</option>
                                    <option value="jabatan.name">@lang('backend/master/pegawai.tables.jabatan_id')</option>
                                    <option value="pangkat.nama">@lang('backend/master/pegawai.tables.pangkat_id')</option>
                                    <option value="bagian.nama_bagian">@lang('backend/master/pegawai.tables.bagian_id')</option>
                                </select>
                            </div>
                        </form>

                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($pegawais->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/master/pegawai.tables.nama')</th>
                                <th>@lang('backend/master/pegawai.tables.nip')</th>
                                <th>@lang('backend/master/pegawai.tables.tempat_lahir')</th>
                                <th>@lang('backend/master/pegawai.tables.tgl_lahir')</th>
                                <th>@lang('backend/master/pegawai.tables.alamat')</th>
                                <th>@lang('backend/master/pegawai.tables.jabatan_id')</th>
                                <th>@lang('backend/master/pegawai.tables.pangkat_id')</th>
                                <th>@lang('backend/master/pegawai.tables.bagian_id')</th>
                                <th>@lang('backend/master/pegawai.tables.created_at')</th>
                                <th style="width: 120px;"></th>
                            </tr>
                            @foreach($pegawais as $key => $pegawai)
                                <tr>
                                    <td>{{ $pegawai->nama }}</td>
                                    <td>{{ $pegawai->nip }}</td>
                                    <td>{{ $pegawai->tempat_lahir }}</td>
                                    <td>{{ $pegawai->tgl_lahir }}</td>
                                    <td>{{ $pegawai->alamat }}</td>
                                    <td>{{ $pegawai->jabatan->name }}</td>
                                    <td>{{ $pegawai->pangkat->nama }}</td>
                                    <td>{{ $pegawai->bagian->nama_bagian }}</td>
                                    <td>{{ $pegawai->created_at->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <a href="#" class="btn-default btn-sm" data-toggle="modal" data-target="#edit-modal{{ $pegawai->id }}"><i class="fa fa-edit"></i> </a>

                                        <a href="#" class="btn-default btn-sm" data-toggle="modal" data-target="#show-modal{{ $pegawai->id }}"><i class="fa fa-eye"></i> </a>
                                        <a href="#" class="btn-danger btn-sm" data-toggle="modal" data-target="#remove-modal{{ $pegawai->id }}" ><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/master/pegawai.pegawai.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $pegawais])
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

    @foreach($pegawais as $pegawai)
        <div class="modal fade" id="remove-modal{{ $pegawai->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('master.pegawai.destroy', $pegawai->id) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/pegawai.module')</h4>
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