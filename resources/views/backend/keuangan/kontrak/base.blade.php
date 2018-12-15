
@extends('backend.base')

@section('content-header')
    <div class="pull-right">
        @yield('actions')
    </div>
    <h1>
        @lang('backend/keuangan.submodule.kontrak')
        <small>@yield(('title'))</small>
    </h1>

@endsection

@section('content')
    @yield('kontrak')
    
@endsection
