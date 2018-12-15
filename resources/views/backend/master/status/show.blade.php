<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 10:08 PM
 */
?>
@foreach($statuss as $status)
    <div class="modal fade" id="show-modal{{ $status->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/status.module')</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="kode_status" class="col-sm-3 control-label">@lang('backend/master/status.tables.kode_status')</label>
                            <div class="col-sm-9 {{ $errors->has('kode_status') ? 'has-error' : '' }}">
                                <input type="text" name="kode_status" class="form-control" id="kode_status" placeholder="Kode status" value="{{ $status->kode_status }}" required>
                                @if($errors->has('kode_status'))
                                    <span class="help-block">
                                    {{ $errors->first('kode_status') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keterangan" class="col-sm-3 control-label">@lang('backend/master/status.tables.keterangan')</label>
                            <div class="col-sm-9 {{ $errors->has('keterangan') ? 'has-error' : '' }}">
                                <input type="text" name="keterangan" class="form-control" id="golongan" placeholder="Keterangan" value="{{ $status->keterangan }}" required>
                                @if($errors->has('keterangan'))
                                    <span class="help-block">
                                    {{ $errors->first('keterangan') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="posisi_dokumen" class="col-sm-3 control-label">@lang('backend/master/status.tables.posisi_dokumen')</label>
                            <div class="col-sm-9 {{ $errors->has('posisi_dokumen') ? 'has-error' : '' }}">
                                <input type="text" name="posisi_dokumen" class="form-control" id="posisi_dokumen" placeholder="Posisi_dokumen" value="{{ $status->posisi_dokumen }}" required>
                                @if($errors->has('posisi_dokumen'))
                                    <span class="help-block">
                                    {{ $errors->first('posisi_dokumen') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="modul" class="col-sm-3 control-label">@lang('backend/master/status.tables.modul')</label>
                            <div class="col-sm-9 {{ $errors->has('modul') ? 'has-error' : '' }}">
                                <input type="text" name="modul" class="form-control" id="modul" placeholder="Posisi_dokumen" value="{{ $status->modul }}" required>
                                @if($errors->has('modul'))
                                    <span class="help-block">
                                    {{ $errors->first('modul') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kode_realisasi" class="col-sm-3 control-label">@lang('backend/master/status.tables.kode_realisasi')</label>
                            <div class="col-sm-9 {{ $errors->has('kode_realisasi') ? 'has-error' : '' }}">
                                <input type="text" name="kode_realisasi" class="form-control" id="kode_realisasi" placeholder="Kode realisasi" value="{{ $status->kode_realisasi }}" required>
                                @if($errors->has('kode_realisasi'))
                                    <span class="help-block">
                                    {{ $errors->first('kode_realisasi') }}
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
