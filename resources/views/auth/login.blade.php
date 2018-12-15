@extends('layouts.app')

@section('title')
    Sistem Informasi Laporan Anggaran Terpadu - Kementerian Kesehatan Republik Indonesia
@endsection

@section('login-logo')
    <div class="login-logo">
        <img src="img/logo-kemenkes.png" style="width: 120px; height: 120px;" alt="eSilat logo">
        <br/>
        <b>
            <h3>Sistem Informasi Laporan Anggaran Terpadu</h3>
            <h4>Direktorat Jenderal Kefarmasian dan Alat Kesehatan <br>
                Kementerian Kesehatan <br>Republik Indonesia</h4>
        </b>
    </div>
@endsection

@section('content')
<div class="login-box-body">
    <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }} has-feedback">
            <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="farmalkes" autofocus required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} has-feedback">
            <input type="password" name="password" class="form-control" placeholder="********" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('backend/_globals.login.remember_me').
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-success btn-block btn-flat"><i class="fa fa-power-off"></i> Login</button>
            </div>
        </div>
    </form>

    <a href="{{ route('password.request') }}">@lang('backend/_globals.login.forgot_password').</a><br>
</div>
@endsection