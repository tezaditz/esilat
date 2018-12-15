<form class="form-horizontal">
    <div class="row">
        <div class="col-md-6">
            <?php $noaju = $perjadin->no_pengajuan; ?>
            @if(strlen($noaju) == 1)
                <?php $noaju = '00' . $noaju; ?>
            @elseif(strlen($noaju) == 2)
                <?php $noaju = '0' . $noaju; ?>
            @endif
            <div class="form-group">
                <label for="no_pengajuan" class="col-sm-3 control-label">No. AJU</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_pengajuan" value="AJU-{{ $noaju }}/{{ $perjadin->bagian->kode }}/{{ $perjadin->thn_anggaran }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="posisi_dokumen" class="col-sm-3 control-label">Posisi
                    Dokumen</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="posisi_dokumen" value="{{ $perjadin->status->posisi_dokumen }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="keterangan" class="col-sm-3 control-label">Status</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="keterangan" value="{{ $perjadin->status->keterangan }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_bagian" class="col-sm-3 control-label">Bagian</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_bagian" value="{{ $perjadin->bagian->nama_bagian }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="no_mak" class="col-sm-3 control-label">No. MAK</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_mak" value="{{ $perjadin->no_mak }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama_kegiatan" class="col-sm-3 control-label">Kegiatan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="2" placeholder="Enter ..." disabled="">{{ $perjadin->nama_kegiatan }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="pelaksanaan" class="col-sm-3 control-label">Pelaksanaan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="pelaksanaan" value="{{ date('d', strtotime($perjadin->tgl_awal)) }} s.d {{ date('d M Y', strtotime($perjadin->tgl_akhir)) }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Provinsi Tujuan:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" value="{{ $perjadin->provinsi->title }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Daerah Tujuan:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" value="{{ $perjadin->kabkota->nama }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="total_pengajuan" class="col-sm-3 control-label">Total
                    Pengajuan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="total_pengajuan" value="Rp. {{ number_format($perjadin->total_pengajuan ,0, ',', '.') }}" readonly>
                </div>
            </div>
        </div>
    </div>
</form>

@if(Auth::user()->roles->first()->name == 'bendahara')
    <hr>
    <div class="row">
        <div class="col-xs-12">
            {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="inputtext3" class="col-sm-3 control-label">Metode</label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<select class="form-control" id="metode" name="metode" required>--}}
                            {{--<option value="" selected="selected">-- Pilih Metode --</option>--}}
                            {{--<option value="MB01">UP</option>--}}
                            {{--<option value="MB02">LS</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <form method="POST" action="{{ route('pertanggungjawaban.perjadin-dalam-negeri.kirimbendahara', $perjadin->id) }}" class="form-horizontal">
                {{ csrf_field() }}
                <div class="col-md-offset-6 col-md-6">
                    <div class="form-group">
                        <label for="status_id" class="col-sm-3 control-label">Status:</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="status_id" name="status_id" required>
                                <option></option>
                                @foreach($statuss as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <a href="{{ route('pertanggungjawaban.perjadin-dalam-negeri.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                            <button type="submit" class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-12">
            <hr>
            <a href="{{ route('pertanggungjawaban.perjadin-dalam-negeri.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
        </div>
    </div>
@endif