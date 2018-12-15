<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/23/2017
 * Time: 05:04 PM
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
    @yield('detail-pertanggungjawaban-perjadin')
@endsection
