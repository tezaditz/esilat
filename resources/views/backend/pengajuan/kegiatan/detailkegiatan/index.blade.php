<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/05/2017
 * Time: 01:13 PM
 */
?>
@extends('backend.pengajuan.kegiatan.detailkegiatan.base')

@section('title', trans('backend/pengajuan.submodule.draft_kegiatan'),  @parent)

@section('actions')

@endsection

@section('detail-kegiatan')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#tab_1-3" data-toggle="tab">@lang('backend/master/pegawai.module')</a></li>
                    <li><a href="#tab_2-2" data-toggle="tab">@lang('backend/nominatif.module')</a></li>
                    <li class="active"><a href="#tab_3-1" data-toggle="tab">@lang('backend/pengajuan.submodule.kegiatan')</a></li>
                    <li class="pull-left header"><i class="fa fa-file-text-o"></i> @yield('title')</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_3-1">
                        @include('backend.pengajuan.kegiatan.detailkegiatan.data-kegiatan')
                    </div>
                    <div class="tab-pane" id="tab_2-2">
                        @include('backend.pengajuan.kegiatan.detailkegiatan.data-nominatif')
                    </div>
                    <div class="tab-pane" id="tab_1-3">
                        @include('backend.pengajuan.kegiatan.detailkegiatan.data-pegawai')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection