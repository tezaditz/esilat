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
        @lang('backend/master/rkakl.module')
        <small>@yield(('title'))  {{ $TahunAng }}</small>
    </h1>
@endsection

@section('content')
    @yield('rkakl')
    @include('backend.upload.import')
@endsection