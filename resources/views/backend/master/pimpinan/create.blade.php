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
            <form class="form-horizontal" action="{{ route('master.pimpinan.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/master/pimpinan.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                   <div class="form-group">
                        <label for="bagian_id" class="col-sm-3 control-label">@lang('backend/master/pimpinan.tables.bagian_id')</label>
                        <div class="col-sm-9 {{ $errors->has('bagian_id') ? 'has-error' : '' }}">
                            @if($bagians->count() > 0)
                                <select name="bagian_id" class="form-control select2" id="bagian_id" style="width: 100%">
                                    @foreach($bagians as $key => $bagian)
                                        <option value="{{ $bagian->id }}">{{ $bagian->nama_bagian }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('bagian_id'))
                                    <span class="help-block">
                                    {{ $errors->first('bagian_id') }}
                                </span>
                                @endif
                             @else
                                <a href="{{ route('master.rkakl.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.index.is_empty')
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nip" class="col-sm-3 control-label">@lang('backend/master/pimpinan.tables.nip')</label>
                        <div class="col-sm-9 {{ $errors->has('nip') ? 'has-error' : '' }}">
                            <input type="text" name="nip" class="form-control" id="nip" placeholder="197706162003130023" required>
                            @if($errors->has('nip'))
                                <span class="help-block">
                                    {{ $errors->first('nip') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">@lang('backend/master/pimpinan.tables.nama')</label>
                        <div class="col-sm-9 {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Erick Kurniawan, S.Farm." required>
                            @if($errors->has('nama'))
                                <span class="help-block">
                                    {{ $errors->first('nama') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jabatan" class="col-sm-3 control-label">@lang('backend/master/pimpinan.tables.jabatan')</label>
                        <div class="col-sm-9 {{ $errors->has('jabatan') ? 'has-error' : '' }}">
                            <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Kasubdit Obat dan Pangan" required>
                            @if($errors->has('jabatan'))
                                <span class="help-block">
                                    {{ $errors->first('jabatan') }}
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
