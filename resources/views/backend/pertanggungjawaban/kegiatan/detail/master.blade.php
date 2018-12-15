<form class="form-horizontal">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama_bagian" class="col-sm-3 control-label">Bagian</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_bagian" value="{{ $kegiatan->bagian->nama_bagian }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="no_mak" class="col-sm-3 control-label">No.Mak</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_mak" value="{{ $kegiatan->no_mak }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_kegiatan" class="col-sm-3 control-label">Nama Kegiatan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="nama_kegiatan" rows="2" readonly>{{ $kegiatan->nama_kegiatan }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Status</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="status" value="{{ $kegiatan->status->keterangan }}" readonly>
                </div>
            </div>
            {{--@if($kegiatan->status->kode_status = 'KG11')--}}
                {{--<div class="form-group">--}}
                    {{--<label for="alasan" class="col-sm-3 control-label">Alasan</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<textarea class="form-control" id="alasan" rows="2" readonly>{{ $kegiatan->alasan }}</textarea>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="pelaksanaan" class="col-sm-3 control-label">Pelaksanaan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="pelaksanaan" value="{{ date('d', strtotime($kegiatan->tgl_awal)) }} s.d {{ date('d M Y', strtotime($kegiatan->tgl_akhir)) }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Daerah Pelaksanaan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" value="{{ $kegiatan->provinsi->title }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="total_realisasi" class="col-sm-3 control-label">Total Pengajuan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="total_realisasi" value="Rp. {{ number_format($totalpengajuan->jml_rph, 0, ',', '.') }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="total_pj" class="col-sm-3 control-label">Realisasi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="total_pj" value="Rp. {{ number_format($totalpjpengajuan->pj_jml_rph, 0, ',', '.') }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="total" class="col-sm-3 control-label">Pengembalian</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="total" value="Rp. {{ number_format($totalpengajuan->jml_rph - $totalpjpengajuan->pj_jml_rph, 0, ',', '.') }}" readonly>
                </div>
            </div>
        </div>
    </div>
</form>

@role('bendahara')

@if($kegiatan->status->kode_status == 'KG12')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('pertanggungjawaban.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            <a href="{{ route('pertanggungjawaban.kegiatan.selesai', $kegiatan->id) }}" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-check"></i> Pertanggungjawaban Selesai</a>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-sm-12">
            <label for="keterangan" class="control-label">Aksi:</label>
        </div>
    </div>
    <form method="post" action="{{ route('pertanggungjawaban.kegiatan.kirim_pj', $kegiatan->id) }}" class="form-horizontal">
        {{ csrf_field() }}
        {{--<input type="hidden" name="id" id="id" value="{{ $kegiatan->id }}">--}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{--<label for="keterangan" class="col-sm-2 control-label">Aksi</label>--}}
                    <div class="col-sm-12">
                        <select class="form-control" required name="keterangan" id="keterangan">
                            <option></option>
                            <option value="PJ30">Penyerahan Berkas Pertanggungjawaban</option>
                            <option value="PJ31">Di Tolak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="alasan" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.alasan')</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="alasan" name="alasan" rows="3" placeholder="" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('pertanggungjawaban.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                <button type="submit" class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</button>

            </div>
        </div>
    </form>
@endif
@endrole

@role('user')
    <div class="row">
        <div class="col-xs-12">
            @if($kegiatan->status->kode_status == 'KG12')
                <a href="#" class="btn btn-success btn-flat btn-sm pull-right disabled"><i class="fa fa-file-pdf-o"></i> Serahkan berkas Pertanggungjawaban ke Bendahara.</a>
                <a href="{{ route('pertanggungjawaban.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            @elseif($kegiatan->status->kode_status == 'KG09')
                <a href="{{ route('pertanggungjawaban.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            @elseif($kegiatan->status->kode_status == 'KG06' or $kegiatan->status->kode_status == 'KG08' or $kegiatan->status->kode_status == 'KG11')
{{--                <a href="{{ route('pertanggungjawaban.kegiatan.kirim-pertanggungjawaban', $kegiatan->id) }}" class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</a>--}}
                <a href="{{ route('pertanggungjawaban.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            @else
                <a href="{{ route('pertanggungjawaban.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            @endif
        </div>
    </div>
@endrole

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="keterangan"]').change(function () {
                if ($('[name="keterangan"]').val() == 'PJ31') {
                    $('[name="alasan"]').prop('disabled', false);
                } else {
                    $('[name="alasan"]').prop('disabled', true);
                }
            });
        });
    </script>
@stop