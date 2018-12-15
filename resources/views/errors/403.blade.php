<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/19/2017
 * Time: 12:28 PM
 */
?>
@extends('layouts.error')

@section('title')
    @lang('backend/_globals.error.unauthorize')
@endsection

@section('content')
    <section class="content">
        <div class="error-page">
            <h3><i class="fa fa-warning text-yellow"></i> @yield('title').</h3>

            <p>
                Sistem tidak bisa menemukan apa yg anda cari, akses tidak diizinkan. Sementara itu, anda bisa <a href="{{ URL::previous() }}">kembali ke halaman sebelumnya</a> atau <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">keluar dari halaman</a>.
            </p>

            <a href="{{ route('logout') }}" class="btn btn-warning btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('backend/_globals.nav.keluar')</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </section>
@endsection