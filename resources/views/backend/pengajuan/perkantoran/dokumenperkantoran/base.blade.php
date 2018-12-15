<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/09/2017
 * Time: 12:05 PM
 */
?>
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/perkantoran.submodule.perkantoran')
        <small>@yield(('title'))</small>
    </h1>

@endsection

@section('content')
    @yield('dokumen-perkantoran')
    @include('backend.pengajuan.perkantoran.dokumenperkantoran.create')
@endsection
