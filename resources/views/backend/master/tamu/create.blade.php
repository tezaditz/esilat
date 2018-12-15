<?php

?>
<div class="modal fade" id="create-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('master.tamu.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/master/tamu.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">@lang('backend/master/tamu.tables.nama')</label>
                        <div class="col-sm-9 {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
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
                            <input type="text" name="nip" class="form-control" id="nip" placeholder="nip" required>
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
                            <input type="text" name="instansi" class="form-control" id="instansi" placeholder="instansi" required>
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
                            <input type="txt" name="jabatan" class="form-control" id="jabatan" placeholder="instansi" required>
                            @if($errors->has('jabatan'))
                                <span class="help-block">
                                    {{ $errors->first('jabatan') }}
                                </span>
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
