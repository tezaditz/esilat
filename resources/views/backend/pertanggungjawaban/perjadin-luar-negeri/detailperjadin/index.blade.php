<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/23/2017
 * Time: 05:04 PM
 */
?>
@extends('backend.pertanggungjawaban.perjadin-luar-negeri.detailperjadin.base')

@section('title', trans('backend/pertanggungjawaban.submodule.detail_perjadin_luar_negri'),  @parent)

@section('actions')

@endsection

@section('detail-pertanggungjawaban-perjadin')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    {{--<li><a href="#tab_1-3" data-toggle="tab">@lang('backend/pertanggungjawaban.submodule.pelaksana')</a></li>--}}
                    <li><a href="#tab_2-2" data-toggle="tab">Pertanggungjawaban</a></li>
                    <li class="active"><a href="#tab_3-1" data-toggle="tab">@lang('backend/pertanggungjawaban.submodule.perjadin')</a></li>
                    <li class="pull-left header"><i class="fa fa-file-text-o"></i> @yield('title')</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_3-1">
                        @include('backend.pertanggungjawaban.perjadin-luar-negeri.detailperjadin.perjadin')
                    </div>
                    <div class="tab-pane" id="tab_2-2">
                        @include('backend.pertanggungjawaban.perjadin-luar-negeri.detailperjadin.data-akun')
                    </div>
                    {{--<div class="tab-pane" id="tab_1-3">--}}
                        {{--@include('backend.pertanggungjawaban.perjadin.draftperjadin.data-pelaksana-pj')--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection