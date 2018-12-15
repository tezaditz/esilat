<div class="row">
    <div class="col-md-6">
        <div class="box-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="inputtext3" class="col-sm-2 control-label">No. AJU</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputtext3"
                               value="{{$perkantorans->no_pengajuan}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtext3" class="col-sm-2 control-label">No. MAK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputtext3" value="{{ $perkantorans->no_mak}}"
                               readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtext3" class="col-sm-2 control-label">Uraian</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputtext3" value="{{ $perkantorans->uraian }}"
                               readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtext3" class="col-sm-2 control-label">Keterangan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputtext3"
                               value="{{ $perkantorans->keterangan }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtext3" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputtext3"
                               value="{{$perkantorans->status->keterangan}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtext3" class="col-sm-2 control-label">Total Nilai</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputtext3"
                               value="Rp. {{number_format(@$perkantorans->total_nilai, 0, ',', '.')}}" readonly>
                    </div>
                </div>
                @if($perkantorans->status->kode_status == 'PK09' || $perkantorans->status->kode_status == 'PK11' || $perkantorans->status->kode_status == 'PK12' || $perkantorans->status->kode_status == 'PK15' || $perkantorans->status->kode_status == 'PK99' )
                    <div class="form-group">
                        <label for="alasan" class="col-sm-2 control-label">Alasan</label>
                        <div class="col-sm-9">
                                <textarea class="form-control" id="alasan" rows="2"
                                          readonly>{{ $perkantorans->alasan }}</textarea>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box-header with-border">
            <h3 class="box-title">Dokumen pengajuan Layanan Perkantoran</h3>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>@lang('backend/pengajuan.kegiatan.tables.uraian')</th>
                    <th>@lang('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.tables.ada')</th>
                </tr>
                @foreach($dokumenPerkantorans as $dokumenPerkantoran)
                    <tr>
                        <td>{{$dokumenPerkantoran->nama_dokumen}}</td>
                        <td class="text-center" style="width: 90px">
                            @if($dokumenPerkantoran->ada == 1)
                                <span class="glyphicon glyphicon-ok"></span>
                            @else
                                <span class="glyphicon glyphicon-remove"></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer clearfix">
            <div class="pull-right">
                @include('backend._inc.pagination', ['paginator' => $dokumenPerkantorans])
            </div>
        </div>
    </div>
</div>

<hr>

@role('user')
<div class="row">
    <div class="col-xs-12">
        @if($perkantorans->status->kode_status == 'PK12')
            <a href="{{ route('pertanggungjawaban.layanan-perkantoran.kirim-pertanggungjawaban', $perkantorans->id) }}" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-file-pdf-o"></i> Telah menyerahkan berkas Pertanggungjawaban ke Bendahara.</a>
            <a href="{{ route('pertanggungjawaban.layanan-perkantoran.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
        @elseif($perkantorans->status->kode_status == 'PK09')
            <a href="{{ route('pertanggungjawaban.layanan-perkantoran.index') }}"
               class="btn btn-danger btn-flat btn-sm"><i
                        class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
        @elseif($perkantorans->status->kode_status == 'PK06' or $perkantorans->status->kode_status == 'PK08' or $perkantorans->status->kode_status == 'PK11')
            <a href="{{ route('pertanggungjawaban.layanan-perkantoran.kirim-pertanggungjawaban', $perkantorans->id) }}"
               class="btn btn-primary btn-flat btn-sm pull-right"><i
                        class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</a>
            <a href="{{ route('pertanggungjawaban.layanan-perkantoran.index') }}"
               class="btn btn-danger btn-flat btn-sm"><i
                        class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
        @else
            <a href="{{ route('pertanggungjawaban.layanan-perkantoran.index') }}"
               class="btn btn-danger btn-flat btn-sm"><i
                        class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
        @endif
    </div>
</div>
@endrole

@role('bendahara')
@if($perkantorans->status->kode_status == 'PK09')
    <form method="post" action="{{ route('pertanggungjawaban.layanan-perkantoran.kirim-status', $perkantorans->id) }}" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="keterangan" class="col-sm-2 control-label">Aksi</label>
                    <div class="col-sm-9">
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
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('pertanggungjawaban.layanan-perkantoran.index')}}" class="btn btn-danger btn-flat btn-sm pull-left"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
                <button type="submit" class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</button>
            </div>
        </div>
    </form>
@elseif($perkantorans->status->kode_status != 'PK13')
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('pertanggungjawaban.layanan-perkantoran.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            <a href="{{ route('pertanggungjawaban.layanan-perkantoran.selesai', $perkantorans->id) }}" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-check"></i> Pertanggungjawaban Selesai</a>
        </div>
    </div>
@else
    <a href="{{ route('pertanggungjawaban.layanan-perkantoran.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
@endif
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