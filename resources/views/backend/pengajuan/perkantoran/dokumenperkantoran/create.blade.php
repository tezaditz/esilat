<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/09/2017
 * Time: 01:21 PM
 */
?>
<div class="modal fade" id="create-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pengajuan.layanan-perkantoran.dokumen.store', $perkantoran_id) }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.tables.nama_dokumen')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nama_dokumen" class="col-sm-2 control-label">@lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.tables.nama_dokumen')</label>
                        <div class="col-sm-10 {{ $errors->has('nama_dokumen') ? 'has-error' : '' }}">
                            <input type="text" name="nama_dokumen" class="form-control" id="nama_dokumen" placeholder="Kwitansi ATK" required>
                            @if($errors->has('nama_dokumen'))
                                <span class="help-block">
                                    {{ $errors->first('nama_dokumen') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ada" class="col-sm-2 control-label">@lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.tables.ada')</label>
                        <div class="col-sm-10 {{ $errors->has('ada') ? 'has-error' : '' }}">
                            <select name="ada" class="form-control select2" id="ada" style="width: 100%;" required>
                                <option value=""></option>
                                <option value="1">Ada.</option>
                                <option value="0">Tidak ada.</option>
                            </select>
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