<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 06:29 PM
 */
?>
<div class="modal fade" id="create-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('master.jabatan.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/master/jabatan.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="Name" class="col-sm-3 control-label">@lang('backend/master/jabatan.tables.name')</label>
                        <div class="col-sm-9 {{ $errors->has('name') ? 'has-error' : '' }}">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Staf" required>
                            @if($errors->has('name'))
                                <span class="help-block">
                                    {{ $errors->first('name') }}
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
