<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 09:04 PM
 */
?>
@foreach($pangkats as $pangkat)
    <div class="modal fade" id="edit-modal{{ $pangkat->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('master.pangkat.update', $pangkat->id) }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.edit') @lang('backend/master/pangkat.module')</h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="Pangkat" class="col-sm-3 control-label">@lang('backend/master/pangkat.tables.pangkat')</label>
                            <div class="col-sm-9 {{ $errors->has('pangkat') ? 'has-error' : '' }}">
                                <input type="text" name="pangkat" class="form-control" id="pangkat" placeholder="Pangkat" value="{{ $pangkat->pangkat }}" required>
                                @if($errors->has('pangkat'))
                                    <span class="help-block">
                                    {{ $errors->first('pangkat') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Golongan" class="col-sm-3 control-label">@lang('backend/master/pangkat.tables.golongan')</label>
                            <div class="col-sm-9 {{ $errors->has('golongan') ? 'has-error' : '' }}">
                                <input type="text" name="golongan" class="form-control" id="golongan" placeholder="Pangkat" value="{{ $pangkat->golongan }}" required>
                                @if($errors->has('golongan'))
                                    <span class="help-block">
                                    {{ $errors->first('golongan') }}
                                </span>
                                @endif
                            </div>
                        </div>s

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


