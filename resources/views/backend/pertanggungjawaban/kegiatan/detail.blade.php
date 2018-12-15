<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/11/2017
 * Time: 09:13 PM
 */
?>
@extends('backend.pertanggungjawaban.kegiatan.base')

@section('title', 'Draft Pertanggungjawaban Kegiatan', @parent)

@section('kegiatan')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#tab_1-1" data-toggle="tab">Nominatif</a></li>
                    <li><a href="#tab_1-2" data-toggle="tab">Detail</a></li>
                    <li class="active"><a href="#tab_1-3" data-toggle="tab">Kegiatan</a></li>
                    <li class="pull-left header"><i class="fa fa-file-text-o"></i> @yield('title')</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-3">
                        @include('backend.pertanggungjawaban.kegiatan.detail.master')
                    </div>
                    <div class="tab-pane" id="tab_1-2">
                        @include('backend.pertanggungjawaban.kegiatan.detail.detail_kegiatan')
                    </div>
                    <div class="tab-pane" id="tab_1-1">
                        @include('backend.pertanggungjawaban.kegiatan.detail.nominatif')
                        @include('backend.pertanggungjawaban.kegiatan.detail.import')
                        @include('backend.pertanggungjawaban.kegiatan.detail.destroy')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection