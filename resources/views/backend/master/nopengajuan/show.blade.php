<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/08/2017
 * Time: 08:42 PM
 */
?>
@foreach($no_pengajuans as $no_pengajuan)
    <div class="modal fade" id="show-modal{{ $no_pengajuan->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/nopengajuan.module')</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="bagian_id" class="col-sm-3 control-label">@lang('backend/master/bagian.tables.nama_bagian')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="bagian_id" class="form-control" id="bagian_id" value="{{ $no_pengajuan->bagian->nama_bagian }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">@lang('backend/master/nopengajuan.tables.no_pengajuan')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="nomor" class="form-control" id="nomor" value="{{ $no_pengajuan->nomor }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis" class="col-sm-3 control-label">@lang('backend/master/nopengajuan.tables.jenis')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="jenis" class="form-control" id="jenis" value="{{ $no_pengajuan->jenis }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kode_transaksi" class="col-sm-3 control-label">@lang('backend/master/nopengajuan.tables.kode')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="kode_transaksi" class="form-control" id="kode_transaksi" value="{{ $no_pengajuan->kode_transaksi }}">
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
