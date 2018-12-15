<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/05/2017
 * Time: 01:13 PM
 */
?>
@extends('backend.pengajuan.kegiatan.nominatif.base')

@section('title', trans('backend/nominatif.nominatif.index.title'),  @parent)

@section('actions')
    <a href="{{ route('pengajuan.kegiatan.list-pegawai', $kegiatan_id) }}"
       class="btn bg-light-blue btn-sm"><i class="fa fa-save"></i> @lang('backend/_globals.buttons.save')</a>
@endsection

@section('nominatif')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    {{--<li class="active"><a href="#perjadin" data-toggle="tab">@lang('backend/nominatif.nominatif.nav.perjadin')</a></li>--}}
                    <li class="active"><a href="#fullday" data-toggle="tab">@lang('backend/nominatif.nominatif.nav.fullday')</a></li>
                    <li><a href="#fullboard" data-toggle="tab">@lang('backend/nominatif.nominatif.nav.fullboard')</a>
                    </li>
                </ul>
                <div class="tab-content">

                    {{--<div class="tab-pane active" id="perjadin">--}}
                    {{--<div class="tab-pane active" id="perjadin">    --}}
{{--                                                @include('backend.pengajuan.kegiatan.nominatif.perjadin.perjadin')--}}
                    {{--</div>  --}}
                    {{--</div>--}}

                    <div class="tab-pane active" id="fullday">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#pesertapusat" data-toggle="tab">Peserta Pusat</a></li>
                                <li><a href="#pesertalocal" data-toggle="tab">Peserta Lokal</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="pesertapusat">
                                    @include('backend.pengajuan.kegiatan.nominatif.fullday.peserta-pusat')
                                </div>
                                <div class="tab-pane" id="pesertalocal">
                                    @include('backend.pengajuan.kegiatan.nominatif.fullday.peserta-lokal')
                                </div>
                            </div>
                            <div></div>
                        </div>
                    </div>

                    <div class="tab-pane" id="fullboard">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#pesertapusatfb" data-toggle="tab">Peserta Pusat</a></li>
                                <li><a href="#pesertadaerah" data-toggle="tab">Peserta Daerah</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="pesertapusatfb">
                                    @include('backend.pengajuan.kegiatan.nominatif.fullboard.peserta-pusat-fb')
                                </div>

                                <div class="tab-pane" id="pesertadaerah">
                                    @include('backend.pengajuan.kegiatan.nominatif.fullboard.peserta-daerah-fb')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection