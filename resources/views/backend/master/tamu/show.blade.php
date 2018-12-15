<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 10:08 PM
 */
?>
@foreach($tamus as $tamu)
    <div class="modal fade" id="show-modal{{ $tamu->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/tamu.module')</h4>
                    </div>
                    <div class="modal-body">

                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">@lang('backend/master/tamu.tables.nama')</label>
                        <div class="col-sm-9 {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required value="{{ $tamu->nama }}">
                            @if($errors->has('nama'))
                                <span class="help-block">
                                    {{ $errors->first('nama') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nip" class="col-sm-3 control-label">@lang('backend/master/tamu.tables.nip')</label>
                        <div class="col-sm-9 {{ $errors->has('nip') ? 'has-error' : '' }}">
                            <input type="text" name="nip" class="form-control" id="nip" placeholder="nip" required value="{{ $tamu->nip }}">
                            @if($errors->has('nip'))
                                <span class="help-block">
                                    {{ $errors->first('nip') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="instansi" class="col-sm-3 control-label">@lang('backend/master/tamu.tables.instansi')</label>
                        <div class="col-sm-9 {{ $errors->has('instansi') ? 'has-error' : '' }}">
                            <input type="text" name="instansi" class="form-control" id="instansi" placeholder="instansi" required value="{{ $tamu->instansi }}">
                            @if($errors->has('instansi'))
                                <span class="help-block">
                                    {{ $errors->first('instansi') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jabatan" class="col-sm-3 control-label">@lang('backend/master/tamu.tables.jabatan')</label>
                        <div class="col-sm-9 {{ $errors->has('jabatan') ? 'has-error' : '' }}">
                            <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="jabatan" required value="{{ $tamu->jabatan }}">
                            @if($errors->has('jabatan'))
                                <span class="help-block">
                                    {{ $errors->first('jabatan') }}
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
