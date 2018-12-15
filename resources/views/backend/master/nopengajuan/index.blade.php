<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/08/2017
 * Time: 07:01 PM
 */
?>
@extends('backend.master.nopengajuan.base')

@section('title', trans('backend/master/nopengajuan.no_pengajuan.index.title', ['total' => $no_pengajuans->total()]), @parent)

@section('actions')
    <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
@endsection

@section('no-pengajuan')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ route('master.no-pengajuan.index') }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('master.no-pengajuan.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">

                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="@lang('backend/_globals.forms.search')..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="bagian_id">@lang('backend/master/bagian.tables.nama_bagian')</option>
                                    <option value="no_pengajuan">@lang('backend/master/nopengajuan.tables.no_pengajuan')</option>
                                    <option value="jenis">@lang('backend/master/nopengajuan.tables.jenis')</option>
                                    <option value="kode">@lang('backend/master/nopengajuan.tables.kode')</option>
                                </select>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($no_pengajuans->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/master/bagian.tables.nama_bagian')</th>
                                <th>@lang('backend/master/nopengajuan.tables.no_pengajuan')</th>
                                <th>@lang('backend/master/nopengajuan.tables.jenis')</th>
                                <th>@lang('backend/master/nopengajuan.tables.kode')</th>
                                <th>@lang('backend/master/hotel.tables.created_at')</th>
                                <th></th>
                            </tr>
                            @foreach($no_pengajuans as $key => $no_pengajuan)
                                <tr>
                                    <td>{{ $no_pengajuan->bagian->nama_bagian }}</td>
                                    <td>{{ $no_pengajuan->nomor }}</td>
                                    <td>{{ $no_pengajuan->jenis }}</td>
                                    <td>{{ $no_pengajuan->kode_transaksi }}</td>
                                    <td>{{ $no_pengajuan->created_at->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <a href="#" class="btn-default btn-sm" data-toggle="modal" data-target="#edit-modal{{ $no_pengajuan->id }}"><i class="fa fa-edit"></i> </a>

                                        <a href="#" class="btn-default btn-sm" data-toggle="modal" data-target="#show-modal{{ $no_pengajuan->id }}"><i class="fa fa-eye"></i> </a>
                                        <a href="#" class="btn-danger btn-sm" data-toggle="modal" data-target="#remove-modal{{ $no_pengajuan->id }}" ><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/master/nopengajuan.no_pengajuan.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $no_pengajuans])
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

    @foreach($no_pengajuans as $no_pengajuan)
        <div class="modal fade" id="remove-modal{{ $no_pengajuan->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('master.no-pengajuan.destroy', $no_pengajuan->id) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/nopengajuan.module')</h4>
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

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@stop