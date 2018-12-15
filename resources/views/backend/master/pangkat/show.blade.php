<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 10:08 PM
 */
?>
@foreach($pangkats as $pangkat)
    <div class="modal fade" id="show-modal{{ $pangkat->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/pangkat.module')</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="pangkat" class="col-sm-3 control-label">@lang('backend/master/pangkat.tables.pangkat')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="pangkat" class="form-control" id="pangkat" placeholder="Pangkat" value="{{ $pangkat->pangkat }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="golongan" class="col-sm-3 control-label">@lang('backend/master/pangkat.tables.golongan')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="golongan" class="form-control" id="golongan" placeholder="Golongan" value="{{ $pangkat->golongan }}">
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
