
<div class="modal fade" id="create-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('spm.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/keuangan.submodule.SPM')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nomor_spm" class="col-sm-2 control-label">@lang('backend/keuangan.SPM.tables.nomor_spm')</label>
                        <div class="col-sm-10 {{ $errors->has('nomor_spm') ? 'has-error' : '' }}">
                            <input type="text" name="nomor_spm" class="form-control" id="nomor_spm"  required>
                            @if($errors->has('nomor_spm'))
                                <span class="help-block">
                                    {{ $errors->first('nomor_spm') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_spm" class="col-sm-2 control-label">@lang('backend/keuangan.SPM.tables.tanggal_spm')</label>
                        <div class="col-sm-5 {{ $errors->has('tanggal_spm') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tanggal_spm" class="form-control pull-right" id="tanggal_spm" required>
                            </div>
                            @if($errors->has('tanggal_spm'))
                                <span class="help-block">
                                    {{ $errors->first('tanggal_spm') }}
                                </span>
                            @endif
                        </div>
                    </div>


                   <div class="form-group">
                        <label for="metode_bayar" class="col-sm-2 control-label">@lang('backend/keuangan.SPM.tables.metode_bayar')</label>
                        <div class="col-sm-10 {{ $errors->has('metode_bayar') ? 'has-error' : '' }}">
                            @if($jnsspm->count() > 0)
                                <div class="input-group">
                                    <select name="metode_bayar" class="form-control select2" id="metode_bayar" style="width: 150px" required>
                                        <option value=""></option>
                                        @foreach($jnsspm as $key => $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->deskripsi }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @if($errors->has('metode_bayar'))
                                    <span class="help-block">
                                    {{ $errors->first('metode_bayar') }}
                                </span>
                                @endif
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