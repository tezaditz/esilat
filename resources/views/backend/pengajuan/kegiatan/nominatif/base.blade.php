<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/05/2017
 * Time: 01:14 PM
 */
?>
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/pengajuan.submodule.kegiatan')
        <small>@yield(('title')) {{ date('Y') }}</small>
    </h1>
@endsection

@section('content')
    @yield('nominatif')
    @include('backend.pengajuan.kegiatan.nominatif.import')
@endsection