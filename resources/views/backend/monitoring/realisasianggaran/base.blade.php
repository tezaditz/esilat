<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/12/2017
 * Time: 11:51 AM
 */
?>
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/monitoring/evaluasikegiatan.submodule.evaluasi_kegiatan')
        <small>@yield(('title'))</small>
    </h1>

@endsection

@section('content')
    @yield('realisasi-anggaran')
@endsection
