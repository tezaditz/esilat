<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/22/2017
 * Time: 04:36 PM
 */
?>
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/pertanggungjawaban.submodule.perjadin_luar_negri')
        <small>@yield(('title'))</small>
    </h1>

@endsection

@section('content')
    @yield('draft-perjadin-pj')
@endsection