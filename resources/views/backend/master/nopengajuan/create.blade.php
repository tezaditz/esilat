<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/08/2017
 * Time: 08:00 PM
 */
?>
<div class="modal fade" id="create-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('master.no-pengajuan.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/master/nopengajuan.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="bagian_id" class="col-sm-3 control-label">@lang('backend/master/bagian.tables.nama_bagian')</label>
                        <div class="col-sm-9 {{ $errors->has('bagian_id') ? 'has-error' : '' }}">
                            @if($bagians->count() > 0)
                                <div class="input-group input-group-sm">
                                    <select name="bagian_id" class="form-control select2" id="bagian_id" style="width: 100%;">
                                        @foreach($bagians as $key => $bagian)
                                            <option value="{{ $bagian->id }}">{{ $bagian->nama_bagian }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.bagian.index') }}" class="btn  btn-flat"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('bagian_id'))
                                    <span class="help-block">
                                    {{ $errors->first('bagian_id') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.bagian.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a> @lang('backend/master/bagian.bagian.index.is_empty')
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nomor" class="col-sm-3 control-label">@lang('backend/master/nopengajuan.tables.no_pengajuan')</label>
                        <div class="col-sm-9 {{ $errors->has('nomor') ? 'has-error' : '' }}">
                            <input type="text" name="nomor" class="form-control" id="nomor" placeholder="41" required>
                            @if($errors->has('nomor'))
                                <span class="help-block">
                                    {{ $errors->first('nomor') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jenis" class="col-sm-3 control-label">@lang('backend/master/nopengajuan.tables.jenis')</label>
                        <div class="col-sm-9 {{ $errors->has('jenis') ? 'has-error' : '' }}">
                            <input type="text" name="jenis" class="form-control" id="jenis" placeholder="Kegiatan" required>
                            @if($errors->has('jenis'))
                                <span class="help-block">
                                    {{ $errors->first('jenis') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kode_transaksi" class="col-sm-3 control-label">@lang('backend/master/nopengajuan.tables.kode')</label>
                        <div class="col-sm-9 {{ $errors->has('kode_transaksi') ? 'has-error' : '' }}">
                            <input type="text" name="kode_transaksi" class="form-control" id="kode_transaksi" placeholder="01" required>
                            @if($errors->has('kode_transaksi'))
                                <span class="help-block">
                                    {{ $errors->first('kode_transaksi') }}
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
