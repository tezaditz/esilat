<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/05/2017
 * Time: 01:13 PM
 */
?>
@extends('backend.upload.base')

@section('title', 'T.A', @parent)

@section('actions')
    <a href="{{ route('pengajuan.upload.generate-transaksi') }}" class="btn bg-light-blue btn-sm"><i class="fa fa-spinner"></i> Generate</a>
    <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a>
@endsection

@section('rkakl')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"></h3>

                    <div class="box-tools pull-right">

                        <a href="{{ route('master.rkakl.index') }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('master.rkakl.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">

                                <input type="text" name="search" class="form-control" placeholder="@lang('backend/_globals.forms.search')..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="kode">@lang('backend/master/rkakl.tables.kode')</option>
                                    <option value="uraian">@lang('backend/master/rkakl.tables.uraian')</option>
                                    <option value="vol">@lang('backend/master/rkakl.tables.vol')</option>
                                    <option value="hargasat">@lang('backend/master/rkakl.tables.hargasat')</option>
                                    <option value="jumlah">@lang('backend/master/rkakl.tables.jumlah')</option>
                                    <option value="sdana">@lang('backend/master/rkakl.tables.sdana')</option>
                                </select>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>@lang('backend/master/rkakl.tables.kode')</th>
                            <th>@lang('backend/master/rkakl.tables.uraian')</th>
                            <th>@lang('backend/master/rkakl.tables.vol')</th>
                            <th>@lang('backend/master/rkakl.tables.hargasat')</th>
                            <th>@lang('backend/master/rkakl.tables.jumlah')</th>
                            <th>@lang('backend/master/rkakl.tables.sdana')</th>
                        </tr>
                        @foreach($rkakls as $rkakl)
                            <tr>
                                <td>{{ $rkakl->kode }}</td>
                                <td>{{ $rkakl->uraian }}</td>
                                <td class="text-right">{{ $rkakl->vol }}</td>
                                <td class="text-right">{{ number_format($rkakl->hargasat, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($rkakl->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $rkakl->sdana }}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection