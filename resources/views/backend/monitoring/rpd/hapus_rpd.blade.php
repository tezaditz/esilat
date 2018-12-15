@foreach($rpd as $key => $value)
    @if($value->level == 0)
        <div class="modal fade" id="input-rpd-modal-{{ $value->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('monitoring.rpkrpd.simpan_rpd') }}" method="post">
                                <input type="hidden" name="id[{{ $value->id }}]" id="id[{{ $value->id }}]" value="{{ $value->id }}">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Hapus RPD</h4>
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
                                        <input class="form-control input-md-6" style="text-align: right; width: 110px;" id="alokasi[{{ $value->id }}]" name="alokasi[{{ $value->id }}]" placeholder="0" type="text" readonly value="{{ number_format($value->pagu,0,0,'.') }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Sisa Anggaran</label>

                                        <input class="form-control input-md
                                        -6" style="text-align: right; width: 110px;" id="saldo[{{ $value->id }}]" name="saldo[{{ $value->id }}]" placeholder="0" type="text" readonly value="{{ number_format($value->pagu - ($value->jan + $value->feb + $value->mar + $value->apr + $value->mei + $value->jun + $value->jul + $value->ags + $value->sep + $value->okt + $value->nov + $value->des),0,0,'.') }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Januari</label>
                                                <input class="form-control input-sm-2"  style="text-align: right; width: 110px;" id="jan[{{ $value->id }}]" name="jan[{{ $value->id }}]" placeholder="0" type="text" value="{{ number_format($value->jan,0,0,'.') }}" onfocus="this.select();return cek_bulan(1);" onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Februari</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="feb[{{ $value->id }}]" name="feb[{{ $value->id }}]" placeholder="0" type="text" value="{{ number_format($value->feb,0,0,'.') }}" onfocus="this.select();return cek_bulan(2);" onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Maret</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="mar[{{ $value->id }}]" name="mar[{{ $value->id }}]" placeholder="0" type="text" value="{{ number_format($value->mar,0,0,'.') }}" onfocus="this.select();" onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">April</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="apr[{{ $value->id }}]" name="apr[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->apr,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Mei</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="mei[{{ $value->id }}]" name="mei[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->mei,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Juni</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="jun[{{ $value->id }}]" name="jun[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->jun,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Juli</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="jul[{{ $value->id }}]" name="jul[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->jul,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Agustus</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="ags[{{ $value->id }}]" name="ags[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->ags,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">September</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="sep[{{ $value->id }}]" name="sep[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->sep,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Oktober</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="okt[{{ $value->id }}]" name="okt[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->okt,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">November</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="nov[{{ $value->id }}]" name="nov[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->nov,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitung(this);">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Desember</label>
                                                <input class="form-control input-sm-2" style="text-align: right; width: 110px;" id="des[{{ $value->id }}]" name="des[{{ $value->id }}]" placeholder="0" type="text"
                                                value="{{ number_format($value->des,0,0,'.') }}" onfocus="this.select();"onkeypress="return isNumber(event);" onblur="return hitung(this);">
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