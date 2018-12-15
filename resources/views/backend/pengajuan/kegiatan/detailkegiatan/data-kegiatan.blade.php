<form class="form-horizontal">
    @if($kegiatan->status->kode_status == 'KG99')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_pengajuan2" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.no_aju')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_pengajuan2"
                               value="{{ $kegiatan->no_pengajuan2 }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="posisi_dokumen" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.posisi_dok')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="posisi_dokumen"
                               value="{{ $kegiatan->status->posisi_dokumen }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.status')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan"
                               value="{{ $kegiatan->status->keterangan }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alasan" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.alasan')</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="alasan" rows="3" readonly>{{ $kegiatan->alasan }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_bagian" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.bagian_id')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_bagian"
                               value="{{ $kegiatan->bagian->nama_bagian }}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_mak" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.no_mak')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_mak"
                               value="{{ $kegiatan->no_mak }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_kegiatan" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.nama_kegiatan')</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="nama_kegiatan" rows="3" readonly>{{ $kegiatan->nama_kegiatan }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl_awal" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.tgl_kegiatan')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_awal"
                               value="{{ date('d', strtotime($kegiatan->tgl_awal)) }} s.d {{ date('d M Y', strtotime($kegiatan->tgl_akhir)) }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.provinsi')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title"
                               value="{{ $kegiatan->provinsi->title }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_realisasi" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.total_realisasi')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="total_realisasi"
                               value="{{ number_format($pengajuan->jml_rph ,0, ',', '.') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_pengajuan2" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.no_aju')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_pengajuan2"
                               value="{{ $kegiatan->no_pengajuan2 }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="posisi_dokumen" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.posisi_dok')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="posisi_dokumen"
                               value="{{ $kegiatan->status->posisi_dokumen }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.status')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan"
                               value="{{ $kegiatan->status->keterangan }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_bagian" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.bagian_id')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_bagian"
                               value="{{ $kegiatan->bagian->nama_bagian }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_mak" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.no_mak')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_mak"
                               value="{{ $kegiatan->no_mak }}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_kegiatan" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.nama_kegiatan')</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="nama_kegiatan" rows="3" readonly>{{ $kegiatan->nama_kegiatan }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl_awal" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.tgl_kegiatan')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_awal"
                               value="{{ date('d', strtotime($kegiatan->tgl_awal)) }} s.d {{ date('d M Y', strtotime($kegiatan->tgl_akhir)) }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.provinsi')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title"
                               value="{{ $kegiatan->provinsi->title }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_realisasi" class="col-sm-3 control-label">@lang('backend/pengajuan.kegiatan.tables.total_realisasi')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="total_realisasi"
                               value="{{ number_format($pengajuan->jml_rph ,0, ',', '.') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>

<hr>
<form action="{{ route('pengajuan.kegiatan.simpan-bendahara') }}" method="post" class="form-horizontal">
<table class="table table-hover">
    <thead>
    <tr>
        <th>@lang('backend/pengajuan.kegiatan.tables.akun')</th>
        <th>@lang('backend/pengajuan.kegiatan.tables.uraian')</th>
        <th>@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
        @role('bendahara')
        <th>@lang('backend/master/metodebayar.tables.metode_bayar')</th>
        <th>@lang('backend/master/metodebayar.tables.status')</th>
        @endrole
    </tr>
    </thead>
    <tbody>
    @if($d_akuns->count() > 0)
        @foreach($d_akuns as $key => $d_akun)
            <tr>
                <td style="width: 90px">{{ $d_akun->akun }}</td>
                <td>{{ $d_akun->uraian }}</td>
                <td class="text-right" style="width: 140px">{{ number_format($d_akun->jumlah ,0, ',', '.') }}</td>
                @role('bendahara')
                    <td>

                    @if($kegiatan->status->kode_status == 'KG05' || $kegiatan->status->kode_status == 'KG06')
                        <select name="metode_bayar" class="form-control select2" id="metode_bayar" style="width: 100%;" disabled>
                                <option value="{{ $d_akun->metode_bayar->id }}">{{ $d_akun->metode_bayar->metode_bayar }}</option>
                        </select>
                    @else
                        <select name="metode_bayar_id[{{ $d_akun->id }}]" class="form-control select2" id="metode_bayar_id[{{ $d_akun->id }}]" style="width: 100%;" required>
                                                        @foreach($metodebayars as $key => $metodebayar)
                                                            <option value="{{ $metodebayar->id }}" {{ $d_akun->metode_bayar_id == $metodebayar->id ? 'selected' : '' }}>{{ $metodebayar->metode_bayar }}</option>
                                                        @endforeach
                        </select>
                    @endif
                    </td>

                    <td>
                    @if($kegiatan->status->kode_status == 'KG05' || $kegiatan->status->kode_status == 'KG06')
                    
                    <select name="status_id2[{{ $d_akun->id }}]" class="form-control select2" id="status_id2[{{ $d_akun->id }}]" style="width: 100%;" disabled>
                        <option value="{{ $kegiatan->status->id }}">{{ $d_akun->status->keterangan }}</option>
                    </select>
                    @else
                    <select name="status_id[{{ $d_akun->id }}]" class="form-control select2" id="status_id[{{ $d_akun->id }}]" style="width: 100%;" required>
                        @foreach($statuss as $key => $status)
                            <option value="{{ $status->id }}" {{ $d_akun->status_id == $status->id ? 'selected' : '' }}>{{ $status->keterangan }}</option>
                        @endforeach
                    </select>
                    @endif
                    </td>
                @endrole
                <td class="text-right" style="width: 10px">
                    <a href="#" class="btn  btn-default btn-flat btn-xs" data-toggle="modal" data-target="#show-modal{{ $d_akun->id }}"><i class="fa fa-eye"></i> </a>
                </td>
            </tr>
        @endforeach
    @else
        <tr class="bg-gray disabled color-palette"><td colspan="4"></td></tr>
        <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="4"><i class="fa fa-exclamation-triangle fa-2x"></i></td></tr>
        <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="4">@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.index.is_empty')</td></tr>
        <tr class="bg-gray disabled color-palette"><td colspan="4"></td></tr>
    @endif
    <tr>
        <th colspan="2" class="text-right"><b>@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</b></th>
        <th class="text-right">Rp. {{ number_format($detailkegiatans->sum('jml_rph'), 0, ',', '.') }}</th>
        <th></th>
    </tr>
</table>

<div class="row">
    <div class="col-xs-12">
        @role('bendahara')
            
            @if($kegiatan->status->kode_status == 'KG05' || $kegiatan->status->kode_status == 'KG06')
                <form action="#" method="post" class="form-horizontal">
                    <input type="hidden" name="id" id="id" value="{{ $kegiatan->id }}">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                </form>

                <hr>

                @if($kegiatan->status->kode_status == 'KG05')
                    <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>

                    <a href="{{ route('pengajuan.kegiatan.draft-kegiatan.selesai_pengajuan', $kegiatan->id) }}" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-print"></i> Selesai </a>
                    
                    @if($totalUP >= 1)
                    <a href="{{ route('pengajuan.kegiatan.draft-kegiatan.kuitansi-pembayaran-up', $kegiatan->id) }}" class="btn btn-default btn-flat btn-sm pull-right" target="_blank"><i class="fa fa-print"></i> Kuitansi Pembayaran UP</a>
                    @endif
                    @if($totalLS >= 1)
                    <a href="{{ route('pengajuan.kegiatan.draft-kegiatan.kuitansi-pembayaran', $kegiatan->id) }}" class="btn btn-default btn-flat btn-sm pull-right" target="_blank"><i class="fa fa-print"></i> Kuitansi Pembayaran LS</a>
                    @endif
                    

                    

                @elseif($kegiatan->status->kode_status == 'KG06')
                    <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                @endif

                @if($kegiatan->metode_bayar->kode == 'MB02')
                    <a href="{{ route('pengajuan.kegiatan.draft-kegiatan.print-stpjb', $kegiatan->id) }}" class="btn btn-default btn-flat btn-sm pull-right" target="_blank"><i class="fa fa-print"></i> sptjb</a>
                    <a href="{{ route('pengajuan.kegiatan.draft-kegiatan.print-stpjb-hotel', $kegiatan->id) }}" class="btn btn-default btn-flat btn-sm pull-right" target="_blank"><i class="fa fa-print" target="_blank"></i> STPJB Hotel</a>
                @endif              
            @else

                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id" value="{{ $kegiatan->id }}">
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan" class="col-sm-2 control-label">@lang('backend/master/status.tables.keterangan')</label>
                                <div class="col-sm-10">
                                    <select name="keterangan" class="form-control select2" id="keterangan" style="width: 100%;" required>
                                        <option value=""></option>
                                        <option value="PG01">Di Terima</option>
                                        <option value="PG09">Di Tolak</option>
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
                    </div>

                    <div class="box-footer">
                        @if($kegiatan->status->kode_status == 'KG01' || $kegiatan->status->kode_status == 'KG04')
                            <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                            <button type="submit" class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</button>
                        @endif

                        @if($kegiatan->status->kode_status == 'KG05')
                            <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                            <a href="#" class="btn btn-default btn-flat btn-sm pull-right"><i class="fa fa-print"></i> Kuitansi Pembayaran</a>
                        @elseif($kegiatan->status->kode_status == 'KG06')
                            <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                        @endif

                        @if($kegiatan->status->kode_status == 'KG14')
                            <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                            <a href="{{ route('pengajuan.kegiatan.sppd-terbit', $kegiatan->id) }}" class="btn btn-default btn-flat btn-sm pull-right"><i class="fa fa-check-circle-o"></i> SPPD Sudah Terbit</a>
                            <a href="#" class="btn btn-default btn-flat btn-sm pull-right"><i class="fa fa-print" target="_blank"></i> STPJB Hotel</a>
                        @endif

                        @if($kegiatan->status->kode_status == 'KG15')
                            <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                        @endif

                    </div>

                
            @endif
            </form>
        @endrole

        @role('user')
            @if($kegiatan->status->kode_status == 'KG05' or $kegiatan->status->kode_status == 'KG04')
                <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            @elseif($kegiatan->status->kode_status == 'KG06')
                <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            @elseif($kegiatan->status->kode_status == 'KG15')
                <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                <a href="{{ route('pengajuan.kegiatan.terima-sppd', $kegiatan->id) }}" class="btn btn-danger btn-flat btn-sm pull-right"><i class="fa fa-arrow-left"></i> SP2D DiTerima</a>
            @endif

            @if($kegiatan->status->kode_status == 'KG00' || $kegiatan->status->kode_status == 'KG99' )
                <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                <a href="{{ route('pengajuan.kegiatan.kirim-kegiatan', $id) }}" class="btn btn-primary btn-flat btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</a>
            @elseif($kegiatan->status->kode_status == 'KG01')
                <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            @endif
        @endrole

        @role('pimpinan')
            @if($kegiatan->status->kode_status == 'KG01')
                <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                <a href="{{ route('pengajuan.kegiatan.persetujuan-direktur', $kegiatan->id) }}" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-check"></i> Setujui</a>
            @else
                <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            @endif
        @endrole

        @role('ppk')
            @if($kegiatan->status->kode_status == 'KG02')
                <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                <a href="{{ route('pengajuan.kegiatan.persetujuan-ppk', $kegiatan->id) }}" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-check"></i> Setujui</a>
            @else
                <a href="{{ route('pengajuan.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            @endif
        @endrole
    </div>
</div>

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="keterangan"]').change(function () {
                if ($('[name="keterangan"]').val() == 'PG09') {
                    $('[name="alasan"]').prop('disabled', false);
                } else {
                    $('[name="alasan"]').prop('disabled', true);
                }
            });
        });
    </script>
@stop