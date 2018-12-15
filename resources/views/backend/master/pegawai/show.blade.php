<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 10:08 PM
 */
?>
@foreach($pegawais as $pegawai)
    <div class="modal fade" id="show-modal{{ $pegawai->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/pegawai.module')</h4>
                    </div>
                    <div class="modal-body">

                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">@lang('backend/master/pegawai.tables.nama')</label>
                        <div class="col-sm-9 {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required value="{{ $pegawai->nama }}">
                            @if($errors->has('nama'))
                                <span class="help-block">
                                    {{ $errors->first('nama') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nip" class="col-sm-3 control-label">@lang('backend/master/pegawai.tables.nip')</label>
                        <div class="col-sm-9 {{ $errors->has('nip') ? 'has-error' : '' }}">
                            <input type="text" name="nip" class="form-control" id="nip" placeholder="nip" required value="{{ $pegawai->nip }}">
                            @if($errors->has('nip'))
                                <span class="help-block">
                                    {{ $errors->first('nip') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tempat_lahir" class="col-sm-3 control-label">@lang('backend/master/pegawai.tables.tempat_lahir')</label>
                        <div class="col-sm-9 {{ $errors->has('tempat_lahir') ? 'has-error' : '' }}">
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="tempat_lahir" required value="{{ $pegawai->tempat_lahir }}">
                            @if($errors->has('tempat_lahir'))
                                <span class="help-block">
                                    {{ $errors->first('tempat_lahir') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgl_lahir" class="col-sm-3 control-label">@lang('backend/master/pegawai.tables.tgl_lahir')</label>
                        <div class="col-sm-9 {{ $errors->has('tgl_lahir') ? 'has-error' : '' }}">
                            <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required value="{{ $pegawai->tgl_lahir }}">
                            @if($errors->has('tgl_lahir'))
                                <span class="help-block">
                                    {{ $errors->first('tgl_lahir') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="col-sm-3 control-label">@lang('backend/master/pegawai.tables.alamat')</label>
                        <div class="col-sm-9 {{ $errors->has('alamat') ? 'has-error' : '' }}">
                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="alamat" required value="{{ $pegawai->alamat }}">
                            @if($errors->has('alamat'))
                                <span class="help-block">
                                    {{ $errors->first('alamat') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jabatan_id" class="col-sm-3 control-label">@lang('backend/master/pegawai.tables.jabatan_id')</label>
                        <div class="col-sm-9 {{ $errors->has('jabatan_id') ? 'has-error' : '' }}">
                                <select readonly name="jabatan_id" class="form-control select2" id="jabatan_id">
                                        <option value="{{ $pegawai->jabatan_id }}">{{ $pegawai->jabatan->name }}</option>
                                </select>
                                @if($errors->has('jabatan_id'))
                                    <span class="help-block">
                                    {{ $errors->first('jabatan_id') }}
                                </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pangkat" class="col-sm-3 control-label">@lang('backend/master/pegawai.tables.pangkat_id')</label>
                        <div class="col-sm-9 {{ $errors->has('pangkat_id') ? 'has-error' : '' }}">
                                <select readonly name="pangkat_id" class="form-control select2" id="pangkat_id" >
                                        <option value="{{ $pegawai->pangkat_id }}">{{ $pegawai->pangkat->nama }}</option>
                                </select>
                                @if($errors->has('pangkat_id'))
                                    <span class="help-block">
                                    {{ $errors->first('pangkat_id') }}
                                </span>
                                @endif
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label for="bagian_id" class="col-sm-3 control-label">@lang('backend/master/pegawai.tables.bagian_id')</label>
                        <div class="col-sm-9 {{ $errors->has('bagian_id') ? 'has-error' : '' }}">
                                <select readonly name="bagian_id" class="form-control select2" id="bagian_id">
                                        <option readonly value="{{ $pegawai->bagian_id }}">{{ $pegawai->bagian->nama_bagian }}</option>
                                </select>
                                @if($errors->has('bagian_id'))
                                    <span class="help-block">
                                    {{ $errors->first('bagian_id') }}
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
