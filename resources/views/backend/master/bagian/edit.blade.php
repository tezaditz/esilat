<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 09:04 PM
 */
?>
@foreach($bagians as $bagian)
    <div class="modal fade" id="edit-modal{{ $bagian->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('master.bagian.update', $bagian->id) }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.edit') @lang('backend/master/bagian.module')</h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">@lang('backend/master/bagian.tables.nama_bagian')</label>
                            <div class="col-sm-9 {{ $errors->has('nama_bagian') ? 'has-error' : '' }}">
                                <input type="text" name="nama_bagian" class="form-control" id="nama_bagian" placeholder="Nama bagian" value="{{ $bagian->nama_bagian }}" required>
                                @if($errors->has('nama_bagian'))
                                    <span class="help-block">
                                    {{ $errors->first('nama_bagian') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kode" class="col-sm-3 control-label">@lang('backend/master/bagian.tables.kode')</label>
                            <div class="col-sm-9 {{ $errors->has('kode') ? 'has-error' : '' }}">
                                <input type="text" name="kode" class="form-control" id="kode" placeholder="Kode" value="{{ $bagian->kode }}" required>
                                @if($errors->has('kode'))
                                    <span class="help-block">
                                    {{ $errors->first('kode') }}
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


