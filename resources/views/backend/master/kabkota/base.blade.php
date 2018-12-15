<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/01/2017
 * Time: 02:51 PM
 */
?>
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/master/kabkota.module')
        <small>@yield(('title'))</small>
    </h1>

@endsection

@section('content')
    @yield('kabkota')
    @include('backend.master.kabkota.create')
    @include('backend.master.kabkota.edit') -->
    @include('backend.master.kabkota.show')
@endsection
