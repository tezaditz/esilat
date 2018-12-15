<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/05/2017
 * Time: 01:33 PM
 */
?>

<div class="modal fade" id="import-peserta-pusat">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pertanggungjawaban.kegiatan.import-fullday') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.upload') @lang('backend/pertanggungjawaban.submodule.nominatif')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="hidden" name="flag" value="2">
                        <input type="hidden" name="peserta" value="1">
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id}}">
                        <label for="import_file" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.submodule.nominatif')</label>
                        <div class="col-sm-9 {{ $errors->has('import_file') ? 'has-error' : '' }}">
                            <input type="file" name="import_file" class="form-control" id="import_file" value="{{ old('import_file') }}" required>
                            @if($errors->has('import_file'))
                                <span class="help-block">
                                    {{ $errors->first('import_file') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit" class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="import-peserta-local">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pertanggungjawaban.kegiatan.import-fullday') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.upload') @lang('backend/pertanggungjawaban.submodule.nominatif')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="hidden" name="flag" value="2">
                        <input type="hidden" name="peserta" value="2">
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id}}">
                        <label for="import_file" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.submodule.nominatif')</label>
                        <div class="col-sm-9 {{ $errors->has('import_file') ? 'has-error' : '' }}">
                            <input type="file" name="import_file" class="form-control" id="import_file" value="{{ old('import_file') }}" required>
                            @if($errors->has('import_file'))
                                <span class="help-block">
                                    {{ $errors->first('import_file') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit" class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="import-peserta-pusat-fb">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pertanggungjawaban.kegiatan.import') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.upload') @lang('backend/pertanggungjawaban.submodule.nominatif')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="hidden" name="flag" value="1">
                        <input type="hidden" name="peserta" value="1">
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id}}">
                        <label for="import_file" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.submodule.nominatif')</label>
                        <div class="col-sm-9 {{ $errors->has('import_file') ? 'has-error' : '' }}">
                            <input type="file" name="import_file" class="form-control" id="import_file" value="{{ old('import_file') }}" required>
                            @if($errors->has('import_file'))
                                <span class="help-block">
                                    {{ $errors->first('import_file') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit" class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="import-peserta-daerah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pertanggungjawaban.kegiatan.import') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.upload') @lang('backend/pertanggungjawaban.submodule.nominatif')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                         <input type="hidden" name="flag" value="1">
                        <input type="hidden" name="peserta" value="2">
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id}}">
                        <label for="import_file" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.submodule.nominatif')</label>
                        <div class="col-sm-9 {{ $errors->has('import_file') ? 'has-error' : '' }}">
                            <input type="file" name="import_file" class="form-control" id="import_file" value="{{ old('import_file') }}" required>
                            @if($errors->has('import_file'))
                                <span class="help-block">
                                    {{ $errors->first('import_file') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit" class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>