<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 06:29 PM
 */
?>
<div class="modal fade" id="create-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('user.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/user.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">@lang('backend/user.tables.name')</label>
                        <div class="col-sm-10 {{ $errors->has('name') ? 'has-error' : '' }}">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Dra. SADIAH, M.Kes" required>
                            @if($errors->has('name'))
                                <span class="help-block">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">@lang('backend/user.tables.username')</label>
                        <div class="col-sm-10 {{ $errors->has('username') ? 'has-error' : '' }}">
                            <input type="text" name="username" class="form-control" id="username" placeholder="sadiah" required>
                            @if($errors->has('username'))
                                <span class="help-block">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">@lang('backend/user.tables.email')</label>
                        <div class="col-sm-10 {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input type="text" name="email" class="form-control" id="email" placeholder="sadiah@gmail.com" required>
                            @if($errors->has('email'))
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">@lang('backend/user.tables.password')</label>
                        <div class="col-sm-10 {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                            @if($errors->has('password'))
                                <span class="help-block">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="bagian" class="col-sm-2 control-label">@lang('backend/user.tables.bagian_id')</label>
                        <div class="col-sm-10 {{ $errors->has('bagian_id') ? 'has-error' : '' }}">
                            @if($bagians->count() > 0)
                                <div class="input-group input-group-sm">
                                    <select name="bagian_id" class="form-control select2" id="bagian_id" style="width: 100%;">
                                        <option></option>
                                        @foreach($bagians as $key => $bagian)
                                            <option value="{{ $bagian->id }}">{{ $bagian->nama_bagian }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.bagian.index') }}" class="btn  btn-flat"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('bagian_id'))
                                    <span class="help-block">
                                    {{ $errors->first('bagian_id') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.bagian.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.index.is_empty')
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">@lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit" class="btn bg-light-blue btn-sm">@lang('backend/_globals.buttons.create')</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
