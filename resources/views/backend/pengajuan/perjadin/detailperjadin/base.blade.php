
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
    @yield('detail-perjadin')
    @include('backend.pengajuan.perjadin.detailperjadin.create')
    @include('backend.pengajuan.perjadin.detailperjadin.createguest')
@endsection