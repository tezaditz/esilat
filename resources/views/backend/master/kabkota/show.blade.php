<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/01/2017
 * Time: 04:53 PM
 */
?>
@foreach($kabkotas as $kabkota)
    <div class="modal fade" id="show-modal{{ $kabkota->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/kabkota.module')</h4>
                    </div>
                    <div class="modal-body">

                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">@lang('backend/master/kabkota.tables.provinsi_id')</label>
                        <div class="col-sm-9">
                            <input readonly type="text" name="title" class="form-control" id="title" value="{{ $kabkota->provinsi->title }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">@lang('backend/master/kabkota.module')</label>
                        <div class="col-sm-9">
                            <input readonly type="text" name="title" class="form-control" id="title" placeholder="Hotel Rancamaya" value="{{ $kabkota->nama }}">
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
