<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/04/2017
 * Time: 11:40 AM
 */
?>

@foreach($metodebayars as $metodebayar)
    <div class="modal fade" id="show-modal{{ $metodebayar->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/metodebayar.module')</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="kode" class="col-sm-3 control-label">@lang('backend/master/metodebayar.tables.kode')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="kode" class="form-control" id="kode" value="{{ $metodebayar->kode }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="metode_bayar" class="col-sm-3 control-label">@lang('backend/master/metodebayar.tables.metode_bayar')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="metode_bayar" class="form-control" id="metode_bayar" value="{{ $metodebayar->metode_bayar }}">
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
