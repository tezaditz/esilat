<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 03:36 PM
 */
?>
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/master/bagian.module')
        <small>@yield(('title'))</small>
    </h1>
@endsection

@section('content')
    @yield('bagian')
    @include('backend.master.bagian.create')
    @include('backend.master.bagian.edit')
    @include('backend.master.bagian.show')
@endsection