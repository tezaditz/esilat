<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 10:08 PM
 */
?>
@foreach($bagians as $bagian)
    <div class="modal fade" id="show-modal{{ $bagian->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/bagian.module')</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nama_bagian" class="col-sm-3 control-label">@lang('backend/master/bagian.tables.nama_bagian')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="nama_bagian" class="form-control" id="name" placeholder="Nama bagian" value="{{ $bagian->nama_bagian }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kode" class="col-sm-3 control-label">@lang('backend/master/bagian.tables.kode')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="kode" class="form-control" id="kode" placeholder="kode" value="{{ $bagian->kode }}">
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
