<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/12/2017
 * Time: 03:34 PM
 */
?>
@extends('backend.monitoring.realisasianggaran.base')

@section('title', trans('backend/master/rkakl.rkakl.index.title'), @parent)

@section('actions')
@endsection

@section('realisasi-anggaran')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title') {{ date('Y') }}</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('monitoring.realisasi-anggaran.search') }}" method="post" class="pull-right">
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
                                    <option value="realisasi_3">@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.realisai')</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>@lang('backend/master/rkakl.tables.kode')</th>
                            <th>@lang('backend/master/rkakl.tables.uraian')</th>
                            <th>@lang('backend/master/rkakl.tables.vol')</th>
                            <th>@lang('backend/master/rkakl.tables.hargasat')</th>
                            <th>@lang('backend/master/rkakl.tables.jumlah')</th>
                            <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.realisai')</th>
                            <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.sisa_anggaran')</th>
                            <th></th>
                        </tr>
                        @foreach($rkakls as $rkakl)
                            @if(($rkakl->jumlah - $rkakl->realisasi_3) < 0)
                                <tr class="bg-yellow color-palette">
                            @else
                                <tr>
                            @endif
                                <td>{{ $rkakl->kode }}</td>
                                <td>{{ $rkakl->uraian }}</td>
                                <td class="text-right">{{ $rkakl->vol }}</td>
                                <td class="text-right">{{ number_format($rkakl->hargasat, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($rkakl->jumlah, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($rkakl->realisasi_3, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format(($rkakl->jumlah - $rkakl->realisasi_3), 0, ',', '.') }}</td>
                                @if(($rkakl->jumlah - $rkakl->realisasi_3) == 0)
                                    @if($rkakl->header == 0)
                                        <td>
                                            <a href="#" class="btn btn-default btn-flat btn-xs" data-toggle="modal" data-target="#show-modal{{ $rkakl->id }}"><i class="fa fa-eye"></i> </a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection