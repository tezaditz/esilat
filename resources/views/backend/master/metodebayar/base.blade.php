<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/04/2017
 * Time: 10:22 AM
 */
?>
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/master/metodebayar.module')
        <small>@yield(('title'))</small>
    </h1>

@endsection

@section('content')
    @yield('metode-bayar')
    @include('backend.master.metodebayar.create')
    @include('backend.master.metodebayar.show')
    @include('backend.master.metodebayar.edit')
@endsection
