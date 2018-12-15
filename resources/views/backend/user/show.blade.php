<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 10:08 PM
 */
?>
@foreach($users as $user)
    <div class="modal fade" id="show-modal{{ $user->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/user.module')</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">@lang('backend/user.tables.name')</label>
                            <div class="col-sm-10 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <input readonly type="text" name="name" class="form-control" id="name" placeholder="Nama" value="{{ $user->name }}" required>
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
                                <input readonly type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ $user->username }}" required>
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
                                <input readonly type="text" name="email" class="form-control" id="email" placeholder="email" value="{{ $user->email }}" required>
                                @if($errors->has('email'))
                                    <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="jabatan_id" class="col-sm-2 control-label">@lang('backend/user.tables.bagian_id')</label>
                        <div class="col-sm-10 {{ $errors->has('jabatan_id') ? 'has-error' : '' }}">
                                <select readonly name="jabatan_id" class="form-control select2" id="jabatan_id">
                                        <option value="{{ $user->bagian_id }}">{{ $user->bagian->nama_bagian }}</option>
                                </select>
                                @if($errors->has('jabatan_id'))
                                    <span class="help-block">
                                    {{ $errors->first('jabatan_id') }}
                                </span>
                                @endif
                        </div>
                    </div>

                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endforeach
