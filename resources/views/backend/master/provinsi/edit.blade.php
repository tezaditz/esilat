<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/01/2017
 * Time: 05:12 PM
 */
?>
@foreach($provinsis as $provinsi)
    <div class="modal fade  " id="edit-modal{{ $provinsi->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('master.provinsi.update', $provinsi->id) }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.edit') @lang('backend/master/provinsi.module')</h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">@lang('backend/master/provinsi.module')</label>
                            <div class="col-sm-9 {{ $errors->has('title') ? 'has-error' : '' }}">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Jakarta" value="{{ $provinsi->title }}" required>
                                @if($errors->has('title'))
                                    <span class="help-block">
                                    {{ $errors->first('title') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">@lang('backend/_globals.buttons.cancel')</button>
                        <button type="submit" class="btn bg-light-blue btn-sm">@lang('backend/_globals.buttons.save')</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endforeach
