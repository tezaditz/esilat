<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/08/2017
 * Time: 07:01 PM
 */
?>
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/master/nopengajuan.module')
        <small>@yield(('title'))</small>
    </h1>

@endsection

@section('content')
    @yield('no-pengajuan')
    @include('backend.master.nopengajuan.create')
    {{--@include('backend.master.hotel.edit')--}}
    @include('backend.master.nopengajuan.show')
@endsection
