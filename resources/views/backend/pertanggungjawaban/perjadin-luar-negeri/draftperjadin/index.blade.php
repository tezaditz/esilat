<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/05/2017
 * Time: 01:13 PM
 */
?>
@extends('backend.pertanggungjawaban.perjadin-luar-negeri.draftperjadin.base')

@section('title', trans('backend/pertanggungjawaban.submodule.draft_perjadin_luar_negri'),  @parent)

@section('actions')

@endsection

@section('draft-perjadin-pj')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#tab_1-3" data-toggle="tab">@lang('backend/pertanggungjawaban.submodule.pelaksana')</a></li>
                    {{--<li><a href="#tab_2-2" data-toggle="tab">@lang('backend/pertanggungjawaban.submodule.akun_perjadin')</a></li>--}}
                    <li class="active"><a href="#tab_3-1" data-toggle="tab">@lang('backend/pertanggungjawaban.submodule.perjadin')</a></li>
                    <li class="pull-left header"><i class="fa fa-file-text-o"></i> @yield('title')</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_3-1">
                        @include('backend.pertanggungjawaban.perjadin-luar-negeri.draftperjadin.data-perjadin')
                    </div>
                    {{--<div class="tab-pane" id="tab_2-2">--}}
                        {{--@include('backend.pertanggungjawaban.perjadin.draftperjadin.data-akun')--}}
                    {{--</div>--}}
                    <div class="tab-pane" id="tab_1-3">
                        @include('backend.pertanggungjawaban.perjadin-luar-negeri.draftperjadin.data-pelaksana-pj')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection