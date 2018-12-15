<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/01/2017
 * Time: 03:54 PM
 */
?>

<div class="modal fade" id="create-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('master.kabkota.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/master/kabkota.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="provinsi_id" class="col-sm-3 control-label">@lang('backend/master/kabkota.tables.provinsi_id')</label>
                        <div class="col-sm-9 {{ $errors->has('provinsi_id') ? 'has-error' : '' }}">
                            @if($provinsis->count() > 0)
                                <div class="input-group input-group-sm">
                                    <select name="provinsi_id" class="form-control select2" id="provinsi_id" style="width: 100%;">
                                        @foreach($provinsis as $key => $provinsi)
                                            <option value="{{ $provinsi->id }}">{{ $provinsi->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.provinsi.index') }}" class="btn btn-flat"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('provinsi_id'))
                                    <span class="help-block">
                                    {{ $errors->first('provinsi_id') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.provinsi.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a> @lang('backend/master/provinsi.provinsi.index.is_empty')
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">@lang('backend/master/kabkota.tables.nama_kab')</label>
                        <div class="col-sm-9 {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Kabupaten / Kota" required>
                            @if($errors->has('nama'))
                                <span class="help-block">
                                    {{ $errors->first('nama') }}
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