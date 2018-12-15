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
        @lang('backend/sp2d.module')
        <small>@yield(('title'))</small>
    </h1>
@endsection

@section('content')
    @yield('rkakl')
    @include('backend.sp2d.upload_sp2d')
    @include('backend.sp2d.upload_spm')
@endsection