<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:15 AM
 */
?>
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/pertanggungjawaban.submodule.perjadin')
        <small>@yield(('title'))</small>
    </h1>

@endsection

@section('content')
    @yield('perjadin')
    {{-- @include('backend.pengajuan.kegiatan.create') --}}
@endsection
