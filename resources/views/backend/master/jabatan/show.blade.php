<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 10:08 PM
 */
?>
@foreach($jabatans as $jabatan)
    <div class="modal fade" id="show-modal{{ $jabatan->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/jabatan.module')</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">@lang('backend/master/jabatan.tables.name')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="name" class="form-control" id="name" placeholder="Jabatan" value="{{ $jabatan->name }}">
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
