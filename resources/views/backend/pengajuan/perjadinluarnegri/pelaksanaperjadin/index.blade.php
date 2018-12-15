<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/22/2017
 * Time: 04:35 PM
 */
?>
@extends('backend.pengajuan.perjadinluarnegri.pelaksanaperjadin.base')

@section('title', trans('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.index.title', ['total' => $dataperjadins->total()]), @parent)

@section('actions')
   {{--  @role('user')
        <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
    @endrole --}}
@endsection

@section('pelaksana-perjadin-luarnegri')
	    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>
                    <div class="box-tools pull-right">

                        <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('pengajuan.perjadin-luar-negeri.detail-pelaksana.search', $perjadin_id) }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">
                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="cari..." value="{{ Request::input('search') }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="nip">@lang('backend/_globals.tables.nip')</option>
                                    <option value="nama_pelaksana">@lang('backend/_globals.tables.nama_pelaksana')</option>
                                    
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($dataperjadins->total() > 0)
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>@lang('backend/_globals.tables.nama_pelaksana')</th>
                                <th>@lang('backend/_globals.tables.nip')</th>
                                <th>@lang('backend/_globals.tables.uang_harian')</th>
                                <th>@lang('backend/_globals.tables.transport')</th>
                                <th>@lang('backend/_globals.tables.pesawat')</th>
                                <th>@lang('backend/_globals.tables.penginapan')</th>
                                <th>@lang('backend/_globals.tables.total')</th>
                                <th></th>
                            </tr>
                            @foreach($dataperjadins as $key => $dataperjadin)
                                <tr>
                                    <td>{{ $dataperjadin->nama_pelaksana }}</td>
                                    <td>{{ $dataperjadin->nip }}</td>
                                    <td class="text-right">{{ number_format($dataperjadin->uang_harian ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($dataperjadin->taksi_provinsi + $dataperjadin->taksi_kab_kota ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($dataperjadin->pesawat ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($dataperjadin->penginapan ,0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format(($dataperjadin->uang_harian + $dataperjadin->taksi_provinsi + $dataperjadin->taksi_kab_kota + $dataperjadin->pesawat + $dataperjadin->penginapan) ,0, ',', '.') }}</td>
                                    <td class="text-right" style="width: 30px">
                                        <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#remove-modal{{ $dataperjadin->id }}" ><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-right" colspan="2">@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
                                <th class="text-right">{{ number_format($dataperjadins->sum('uang_harian') ,0, ',', '.') }}</th>
                                <th class="text-right">{{ number_format($dataperjadins->sum('taksi_provinsi') + $dataperjadins->sum('taksi_kab_kota') ,0, ',', '.') }}</th>
                                <th class="text-right">{{ number_format($dataperjadins->sum('pesawat') ,0, ',', '.') }}</th>
                                <th class="text-right">{{ number_format($dataperjadins->sum('penginapan') ,0, ',', '.') }}</th>
                                <th class="text-right">{{ number_format($dataperjadins->sum('uang_harian') + $dataperjadins->sum('taksi_provinsi') + $dataperjadins->sum('taksi_kab_kota') + $dataperjadins->sum('pesawat') + $dataperjadins->sum('penginapan') ,0, ',', '.') }}</th>
                                <th class="text-right">
                                @role('user')
                                    <a href="#" class="btn bg-light-blue tn-flat btn-xs" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i></a>
                                @endrole
                                </th>
                            </tr>
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/pertanggungjawaban.perjadin.submodule.detail_akun.index.is_empty')</h4>
                            @role('user')
                                <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
                            @endrole
                            <br><br>
                        </div>
                    @endif
                </div>
                <div class="box-footer clearfix">
                    @if($dataperjadins->total() > 0)
                        <a href="{{ route('pengajuan.perjadin-luar-negeri.draft-perjadin', $perjadin_id) }}" class="btn btn-success btn-flat btn-sm">@lang('backend/_globals.buttons.next') <i class="fa fa-arrow-right"></i></a>
                    @endif
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $dataperjadins])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($dataperjadins as $dataperjadin)
        <div class="modal fade" id="remove-modal{{ $dataperjadin->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('pengajuan.perjadin-luar-negeri.detail-pelaksana.destroy', $dataperjadin->id) }}" method="post">
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
            </div>
        </div>
    @endforeach
@endsection