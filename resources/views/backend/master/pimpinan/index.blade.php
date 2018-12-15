<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 03:35 PM
 */
?>
@extends('backend.master.pimpinan.base')

@section('title', trans('backend/master/pimpinan.pimpinan.index.title', ['total' => $pimpinans->total()]), @parent)

@section('actions')
    <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
@endsection

@section('pimpinan')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">

                        <a href="{{ route('master.pimpinan.index') }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('master.pimpinan.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">

                                <input type="text" name="search" class="form-control" id="bagian_id" placeholder="@lang('backend/_globals.forms.search')..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="bagian.nama_bagian">@lang('backend/master/pimpinan.tables.bagian_id')</option>
                                    <option value="pimpinan.nip">@lang('backend/master/pimpinan.tables.nip')</option>
                                    <option value="pimpinan.nama">@lang('backend/master/pimpinan.tables.nama')</option>
                                    <option value="pimpinan.jabatan">@lang('backend/master/pimpinan.tables.jabatan')</option>
                                </select>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($pimpinans->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/master/pimpinan.tables.bagian_id')</th>
                                <th>@lang('backend/master/pimpinan.tables.nip')</th>
                                <th>@lang('backend/master/pimpinan.tables.nama')</th>
                                <th>@lang('backend/master/pimpinan.tables.jabatan')</th>
                                <!-- <th>@lang('backend/master/pimpinan.tables.created_at')</th> -->
                                <th></th>
                            </tr>
                            @foreach($pimpinans as $key => $pimpinan)
                                <tr>
                                    <td>{{ $pimpinan->bagian->nama_bagian }}</td> 
                                    {{-- <td>{{ $pimpinan->bagian_id }}</td>  --}}
                                    <td>{{ $pimpinan->nip }}</td>
                                    <td>{{ $pimpinan->nama }}</td>
                                    <td>{{ $pimpinan->jabatan }}</td>
                                    
                                    <td class="text-right">
                                        <a href="#" class="btn-default btn-sm" data-toggle="modal" data-target="#edit-modal{{ $pimpinan->id }}"><i class="fa fa-edit"></i> </a>

                                        <a href="#" class="btn-default btn-sm" data-toggle="modal" data-target="#show-modal{{ $pimpinan->id }}"><i class="fa fa-eye"></i> </a>
                                        <a href="#" class="btn-danger btn-sm" data-toggle="modal" data-target="#remove-modal{{ $pimpinan->id }}" ><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/master/pimpinan.pimpinan.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $pimpinans])
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

    @foreach($pimpinans as $pimpinan)
        <div class="modal fade" id="remove-modal{{ $pimpinan->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('master.pimpinan.destroy', $pimpinan->id) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/pimpinan.module')</h4>
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