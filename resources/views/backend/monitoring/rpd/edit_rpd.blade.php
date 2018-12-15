@foreach($rpd as $key => $value)
    @if($value->level == 0)
        <div class="modal fade" id="edit-rpd-modal-{{ $value->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('monitoring.rpkrpd.edit_rpd' , $value->id) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Rencana Penarikan Dana</h4>
                            <input type="hidden" name="id[{{ $value->id }}]" id="id[{{ $value->id }}]" value="{{ $value->id }}">
                        </div>
                        <div class="modal-body">

                            {{ csrf_field() }}
                            <div class="box box-success">
                                <div class="box-body table-responsive no-padding">

                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Uraian</label>
                                        <input type="text" class="form-control input-md-6" style="width: 200px;" name="uraian" id="uraian" value="{{ $value->uraian }}" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Jenis Transaksi</label>
                                        <label class="col-sm-2 control-label"><input type="radio" name="tupoksi[{{ $value->id }}]" value="0" 
                                            {{ $value->flag_pengadaan == 0 ? 'checked' : '' }}>Tupoksi</label>
                                        <label class="col-sm-2 control-label"><input type="radio" name="tupoksi[{{ $value->id }}]" value="1" 
                                        {{ $value->flag_pengadaan == 1 ? 'checked' : '' }}>Pengadaan</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Alokasi</label>
                                        <input class="form-control input-md-6" style="text-align: right; width: 110px;" id="alokasi[{{ $value->id }}]" name="alokasi_edit[{{ $value->id }}]" placeholder="0" type="text" readonly value="{{ number_format($value->pagu,0,0,'.') }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Sisa Anggaran</label>

                                        <input class="form-control input-md
                                        -6" style="text-align: right; width: 110px;" id="saldo_edit[{{ $value->id }}]" name="saldo_edit[{{ $value->id }}]" placeholder="0" type="text" readonly value="{{ number_format($value->pagu - ($value->jan_update + $value->feb_update + $value->mar_update + $value->apr_update + $value->mei_update + $value->jun_update + $value->jul_update + $value->ags_update + $value->sep_update + $value->okt_update + $value->nov_update + $value->des_update),0,0,'.') }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Januari</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="jan_edit[{{ $value->id }}]" name="jan_edit[{{ $value->id }}]" placeholder="0" type="text" value="{{ number_format($value->jan_update,0,0,'.') }}" onfocus="this.select();" onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Februari</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="feb_edit[{{ $value->id }}]" name="feb_edit[{{ $value->id }}]" placeholder="0" type="text" value="{{ number_format($value->feb_update,0,0,'.') }}" onfocus="this.select();" onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Maret</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="mar_edit[{{ $value->id }}]" name="mar_edit[{{ $value->id }}]" placeholder="0" type="text" value="{{ number_format($value->mar_update,0,0,'.') }}" onfocus="this.select();" onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">April</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="apr_edit[{{ $value->id }}]" name="apr_edit[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->apr_update,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Mei</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="mei_edit[{{ $value->id }}]" name="mei_edit[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->mei_update,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Juni</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="jun_edit[{{ $value->id }}]" name="jun_edit[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->jun_update,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Juli</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="jul_edit[{{ $value->id }}]" name="jul_edit[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->jul_update,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Agustus</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="ags_edit[{{ $value->id }}]" name="ags_edit[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->ags_update,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">September</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="sep_edit[{{ $value->id }}]" name="sep_edit[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->sep_update,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Oktober</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="okt_edit[{{ $value->id }}]" name="okt_edit[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->okt_update,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">November</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="nov_edit[{{ $value->id }}]" name="nov_edit[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->nov_update,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Desember</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="des_edit[{{ $value->id }}]" name="des_edit[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->des_update,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitungEdit(this);">
                                            </div>
                                        </div>
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
    @endif
@endforeach