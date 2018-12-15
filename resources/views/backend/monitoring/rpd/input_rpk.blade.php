@foreach($rpd as $key => $data_rpd)
                        @forelse($data_rpd->rpk as $data_rpk)
<div class="modal fade" id="input-rpk-modal-{{ $data_rpd->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('monitoring.rpkrpd.simpan_rpk'  ) }}" method="post">
                <input type="hidden" name="id" id="id" value="{{ $data_rpd->id }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/monitoring/rpd.form_rpk.title') </h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="tglFrom" class="col-sm-2 control-label">Tanggal Awal</label>
                        <div class="col-sm-5 {{ $errors->has('tglFrom') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tglFrom[{{ $data_rpd->id }}]" class="form-control pull-right" id="tglFrom[{{ $data_rpd->id }}]" value="{{ $data_rpk->tglFrom_update }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tglTo" class="col-sm-2 control-label">Tanggal Akhir</label>
                        <div class="col-sm-5 {{ $errors->has('tglTo') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tglTo[{{ $data_rpd->id }}]" class="form-control pull-right" id="tglTo[{{ $data_rpd->id }}]" value="{{ $data_rpk->tglTo_update }}" required>
                            </div>
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
@empty
<div class="modal fade" id="input-rpk-modal-{{ $data_rpd->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('monitoring.rpkrpd.simpan_rpk') }}" method="post">
                <input type="hidden" name="id" id="id" value="{{ $data_rpd->id }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/monitoring/rpd.form_rpk.title') </h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="tglFrom" class="col-sm-2 control-label">Tanggal Awal</label>
                        <div class="col-sm-5 {{ $errors->has('tglFrom') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tglFrom[{{ $data_rpd->id }}]" class="form-control pull-right" id="tglFrom[{{ $data_rpd->id }}]" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tglTo" class="col-sm-2 control-label">Tanggal Akhir</label>
                        <div class="col-sm-5 {{ $errors->has('tglTo') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tglTo[{{ $data_rpd->id }}]" class="form-control pull-right" id="tglTo[{{ $data_rpd->id }}]" required>
                            </div>
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
@endforelse
@endforeach