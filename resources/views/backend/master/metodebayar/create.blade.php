<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/04/2017
 * Time: 11:28 AM
 */
?>
<div class="modal fade" id="create-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('master.metodebayar.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/master/metodebayar.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="kode" class="col-sm-3 control-label">@lang('backend/master/metodebayar.tables.kode')</label>
                        <div class="col-sm-9 {{ $errors->has('kode') ? 'has-error' : '' }}">
                            <input type="text" name="kode" class="form-control" id="kode" placeholder="M01" required>
                            @if($errors->has('kode'))
                                <span class="help-block">
                                    {{ $errors->first('kode') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="metode_bayar" class="col-sm-3 control-label">@lang('backend/master/metodebayar.tables.metode_bayar')</label>
                        <div class="col-sm-9 {{ $errors->has('metode_bayar') ? 'has-error' : '' }}">
                            <input type="text" name="metode_bayar" class="form-control" id="metode_bayar" placeholder="LS" required>
                            @if($errors->has('metode_bayar'))
                                <span class="help-block">
                                    {{ $errors->first('metode_bayar') }}
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
