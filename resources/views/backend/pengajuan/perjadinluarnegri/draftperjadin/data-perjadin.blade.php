<form class="form-horizontal">
    @if($perjadin->status->keterangan == 'PR91')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_pengajuan2" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.no_aju')</label>
                    <div class="col-sm-10">
                        <?php $noaju = $perjadin->no_pengajuan; ?>
                        @if(strlen($noaju) == 1)
                            <?php $noaju = '00' . $noaju; ?>
                        @elseif(strlen($noaju) == 2)
                            <?php $noaju = '0' . $noaju; ?>
                        @else
                            <?php $noaju = $noaju; ?>
                        @endif
                        <input type="text" class="form-control" id="no_pengajuan2"
                               value="AJU-{{ $noaju }}/{{ $perjadin->bagian->kode }}/{{ $perjadin->thn_anggaran }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="posisi_dokumen" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.posisi_dok')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="posisi_dokumen"
                               value="{{ $perjadin->status->posisi_dokumen }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.status')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan"
                               value="{{ $perjadin->status->keterangan }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alasan" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.alasan')</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="alasan" rows="2" readonly>{{ $perjadin->alasan }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_bagian" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.bagian_id')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_bagian"
                               value="{{ $perjadin->bagian->nama_bagian }}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_mak" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.no_mak')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_mak"
                               value="{{ $perjadin->no_mak }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_kegiatan" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.nama_kegiatan')</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="nama_kegiatan" rows="2" readonly>{{ $perjadin->nama_kegiatan }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl_awal" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.tgl_kegiatan')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_awal"
                               value="{{ date('d', strtotime($perjadin->tgl_awal)) }} s.d {{ date('d M Y', strtotime($perjadin->tgl_akhir)) }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_realisasi" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.jumlah_pengajuan')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="total_realisasi"
                               value="{{ number_format($perjadin->total_pengajuan ,0, ',', '.') }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">@lang('backend/_globals.tables.negara_id')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title"
                               value="{{ $perjadin->negara->nama_negara }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_pengajuan2" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.no_aju')</label>
                    <div class="col-sm-10">
                        <?php $noaju = $perjadin->no_pengajuan; ?>
                        @if(strlen($noaju) == 1)
                            <?php $noaju = '00' . $noaju; ?>
                        @elseif(strlen($noaju) == 2)
                            <?php $noaju = '0' . $noaju; ?>
                        @else
                            <?php $noaju = $noaju; ?>
                        @endif
                        <input type="text" class="form-control" id="no_pengajuan2"
                               value="AJU-{{ $noaju }}/{{ $perjadin->bagian->kode }}/{{ $perjadin->thn_anggaran }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="posisi_dokumen" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.posisi_dok')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="posisi_dokumen"
                               value="{{ $perjadin->status->posisi_dokumen }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.status')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan"
                               value="{{ $perjadin->status->keterangan }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_bagian" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.bagian_id')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_bagian"
                               value="{{ $perjadin->bagian->nama_bagian }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_mak" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.no_mak')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_mak"
                               value="{{ $perjadin->no_mak }}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_kegiatan" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.nama_kegiatan')</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="nama_kegiatan" rows="2" readonly>{{ $perjadin->nama_kegiatan }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl_awal" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.tgl_kegiatan')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_awal"
                               value="{{ date('d', strtotime($perjadin->tgl_awal)) }} s.d {{ date('d M Y', strtotime($perjadin->tgl_akhir)) }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_realisasi" class="col-sm-3 control-label">@lang('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.tables.jumlah_pengajuan')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="total_realisasi"
                               value="{{ number_format($perjadin->total_pengajuan ,0, ',', '.') }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">@lang('backend/_globals.tables.negara_id')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title"
                               value="{{ $perjadin->negara->nama_negara }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>
<hr>
<div class="row">
    <div class="col-xs-12">
        @role('bendahara')
        @if($perjadin->status->kode_status == 'PR00' || $perjadin->status->kode_status == 'PR01' || $perjadin->status->kode_status == 'PR02')
            <div class="row">
                <div class="col-md-12">
                    <form method="POST"
                          action="{{ route('pengajuan.perjadin-luar-negeri.draft-perjadin.kirim-bendahara') }}"
                          class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{ $perjadin->id }}">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="metode_bayar"
                                               class="col-sm-3 control-label">@lang('backend/master/metodebayar.tables.metode_bayar')</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="metode_bayar" name="metode_bayar" required>
                                                <option value="" selected="selected"></option>
                                                <option value="MB01">UP</option>
                                                <option value="MB02">LS</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="status_id"
                                               class="col-sm-3 control-label">@lang('backend/_globals.tables.status')</label>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-sm">
                                                <select class="form-control" id="status_id" name="status_id"
                                                        style="width: 100%;" required>
                                                    @foreach($statuss as $key => $status)
                                                        <option value="{{ $status->id }}">{{ $status->keterangan }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="input-group-btn">
                                                            <a href="{{ route('master.status.index') }}"
                                                               class="btn btn-flat"><i class="fa fa-plus"></i></a>
                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan" class="col-sm-3 control-label">Keterangan </label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="keterangan" name="keterangan">
                                                <option value="PR06">Di Terima</option>
                                                <option value="PR07">Di Tolak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alasan" class="col-sm-3 control-label">Alasan</label>
                                        <div class="col-sm-9">
                                            <textarea name="alasan" class="form-control" id="alasan"
                                                      disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('pengajuan.perjadin-luar-negeri.index') }}"
                               class="btn btn-danger btn-flat btn-sm pull-left"><i
                                        class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.back')</a>
                            <button type="submit" class="btn btn-primary btn-flat btn-sm pull-right"
                                    style="margin-right: 5px;">
                                <i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @elseif($perjadin->status->kode_status == 'PR03')
            <a href="{{ route('pengajuan.perjadin-luar-negeri.index') }}"
               class="btn btn-danger btn-flat btn-sm pull-left"><i
                        class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.back')</a>
            <a href="{{ route('pengajuan.perjadin-luar-negeri.draft-perjadin.uang-diserahkan', $perjadin_id) }}"
               class="btn btn-success btn-flat btn-sm pull-right"><i
                        class="fa fa-rub"></i> @lang('backend/_globals.buttons.uang_diserahkan')</a>
            <a href="{{ route('pengajuan.perjadin-luar-negeri.draft-perjadin.tanda-terima', $perjadin_id) }}"
               class="btn btn-default btn-flat btn-sm pull-right" target="_blank"><i
                        class="fa fa-print"></i> @lang('backend/_globals.buttons.tanda_terima')</a>
        @else
            <div class="box-footer">
                <a href="{{ route('pengajuan.perjadin-luar-negeri.index') }}"
                   class="btn btn-danger btn-flat btn-sm pull-left"><i
                            class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            </div>
        @endif
        @endrole

        @role('user')
        <hr>
        @if($perjadin->status->kode_status == 'PR00')
            <a href="{{ route('pengajuan.perjadin-luar-negeri.index') }}" class="btn btn-danger btn-flat btn-sm"><i
                        class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.back')</a>
            <a href="{{ route('pengajuan.perjadin-luar-negeri.draft-perjadin.kirim-perjadin', $perjadin_id) }}"
               class="btn btn-primary btn-flat btn-sm pull-right" style="margin-right: 5px;"><i
                        class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</a>
            {{--<a href="#" class="btn bg-yellow color-palette btn-flat btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-times"></i> @lang('backend/_globals.buttons.cancel')</a>--}}
        @elseif($perjadin->status->kode_status == 'PR01' || $perjadin->status->kode_status == 'PR02' || $perjadin->status->kode_status == 'PR03' || $perjadin->status->kode_status == 'PR91' )
            <a href="{{ route('pengajuan.perjadin-luar-negeri.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.back')</a>
        @endif
        @endrole
    </div>
</div>

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function () {
            $('[name="keterangan"]').change(function () {
                if ($('[name="keterangan"]').val() == 'PR07') {
                    $('[name="alasan"]').prop('disabled', false);
                } else {
                    $('[name="alasan"]').prop('disabled', true);
                }
            });
        });
    </script>
@stop