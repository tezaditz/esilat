
<div class="modal fade" id="create-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal modal-lg" action="{{ route('pengajuan.perjadin-dalam-negeri.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/pertanggungjawaban.submodule.perjadin')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="bagian_id" class="col-sm-2 control-label">@lang('backend/_globals.tables.bagian_id')</label>
                        <div class="col-sm-10 {{ $errors->has('bagian_id') ? 'has-error' : '' }}">
                            <div class="input-group input-group-sm">
                                <input type="hidden" value={{ $bagians->id }} name="bagian_id">
                                <input type="text" class="form-control" id="bagian_id" placeholder="Subdirektorat Obat dan Pangan" value="{{ $bagians->nama_bagian }}" readonly>
                                <span class="input-group-btn">
                                    <a href="{{ route('master.bagian.index') }}" class="btn  btn-flat"><i class="fa fa-plus"></i></a>
                                </span>
                            </div>
                            @if($errors->has('bagian_id'))
                                <span class="help-block">
                                    {{ $errors->first('bagian_id') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="judul" class="col-sm-2 control-label">@lang('backend/_globals.tables.nama_kegiatan')</label>
                        <div class="col-sm-10 {{ $errors->has('judul') ? 'has-error' : '' }}">
                            @if(Count($rkakls) > 0)
                                <div class="input-group input-group-sm">
                                    <select name="judul" class="form-control select2" id="judul" style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach($rkakls as $key => $rkakl)
                                            <option value="{{ $rkakl['no_mak'] }}">{{ $rkakl['no_mak'] }} | {{ $rkakl['uraian'] }} | {{ number_format($rkakl['jumlah'] - $rkakl['realisasi'], 0, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.rkakl.index') }}" class="btn  btn-flat"><i class="fa fa-upload"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('judul'))
                                    <span class="help-block">
                                    {{ $errors->first('judul') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.rkakl.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.rpd.is_empty')
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_mak" class="col-sm-2 control-label">@lang('backend/_globals.tables.no_mak')</label>
                        <div class="col-sm-10 {{ $errors->has('no_mak') ? 'has-error' : '' }}">
                            <select name="no_mak" class="form-control select2" id="no_mak" style="width: 100%;" required>

                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="nama_kegiatan" class="col-sm-2 control-label">@lang('backend/_globals.tables.nama_kegiatan')</label>
                        <div class="col-sm-10 {{ $errors->has('nama_kegiatan') ? 'has-error' : '' }}">
                            <input type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan" placeholder="Memfasilitasi Pengembangan Obat dan Bahan Baku Sediaan Farmasi Dalam Negeri" required readonly>
                            @if($errors->has('nama_kegiatan'))
                                <span class="help-block">
                                    {{ $errors->first('nama_kegiatan') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_surat_tugas" class="col-sm-2 control-label"><th>@lang('backend/pertanggungjawaban.perjadin.tables.no_surat_tugas')</th></label>
                        <div class="col-sm-10 {{ $errors->has('no_surat_tugas') ? 'has-error' : '' }}">
                            <input type="text" name="no_surat_tugas" class="form-control" id="no_surat_tugas" value="{{ old('no_surat_tugas') }}" required>
                            @if($errors->has('no_surat_tugas'))
                                <span class="help-block">
                                    {{ $errors->first('no_surat_tugas') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgl_surat_tugas" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.tables.tgl_surat_tugas')</label>
                        <div class="col-sm-5 {{ $errors->has('tgl_surat_tugas') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tgl_surat_tugas" class="form-control pull-right" id="tgl_surat_tugas" required>
                            </div>
                            @if($errors->has('tgl_surat_tugas'))
                                <span class="help-block">
                                    {{ $errors->first('tgl_surat_tugas') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgl_awal" class="col-sm-2 control-label">@lang('backend/_globals.tables.tgl_awal')</label>
                        <div class="col-sm-5 {{ $errors->has('tgl_awal') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tgl_awal" class="form-control pull-right" id="tgl_awal" required>
                            </div>
                            @if($errors->has('tgl_awal'))
                                <span class="help-block">
                                    {{ $errors->first('tgl_awal') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgl_akhir" class="col-sm-2 control-label">@lang('backend/_globals.tables.tgl_akhir')</label>
                        <div class="col-sm-5 {{ $errors->has('tgl_akhir') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tgl_akhir" class="form-control pull-right" id="tgl_akhir" required>
                            </div>
                            @if($errors->has('tgl_akhir'))
                                <span class="help-block">
                                    {{ $errors->first('tgl_akhir') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="provinsi_id" class="col-sm-2 control-label">@lang('backend/_globals.tables.provinsi_id')</label>
                        <div class="col-sm-10 {{ $errors->has('provinsi_id') ? 'has-error' : '' }}">
                            @if($provinsis->count() > 0)
                                <div class="input-group input-group-sm">
                                    <select name="provinsi_id" class="form-control select2 provinsi_id" id="provinsi_id" style="width: 100%;">
                                        <option></option>
                                        @foreach($provinsis as $key => $provinsi)
                                            <option value="{{ $provinsi->id }}">{{ $provinsi->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.provinsi.index') }}" class="btn btn-flat"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('provinsi_id'))
                                    <span class="help-block">
                                    {{ $errors->first('provinsi_id') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.provinsi.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a> @lang('backend/master/provinsi.provinsi.index.is_empty')
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kabkota" class="col-sm-2 control-label">@lang('backend/_globals.tables.kabkota_id')</label>
                        <div class="col-sm-10 {{ $errors->has('kabkota') ? 'has-error' : '' }}">
                            @if($kotas->count() > 0)
                                <div class="input-group input-group-sm">
                                    <select name="kabkota" class="form-control select2 kabkota"  id="kabkota" style="width: 100%;">
                                        
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.provinsi.index') }}" class="btn btn-flat"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('kabkota'))
                                    <span class="help-block">
                                    {{ $errors->first('kabkota') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.provinsi.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a> @lang('backend/master/provinsi.provinsi.index.is_empty')
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
    </div>
</div>

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function () {
            $('.date').datepicker({
                language: "id",
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });

           $('#judul').on('change', function() {
                var judul = this.value;
                var url = "{{ route('pengajuan.perjadin-dalam-negeri.memuat-mak') }}"+'/'+judul;
                $.ajax({
                    type: "Get",
                    url: url,
                    data: {judul: judul},
                    dataType: 'json',
                    success: function(result) {
                        var maks_data = result.maks_data;
                        var $no_mak = $("#no_mak");
                        $no_mak.empty();
                        $no_mak.append('<option value=""></option>');
                        maks_data.forEach(function(entry) {
                            $no_mak.append('<option value="'+entry.no_mak+'">'+entry.no_mak+' - '+entry.uraian+' - '+entry.alokasi+'</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            $('#no_mak').on('change', function () {
                var no_mak = this.value;
                var url = "{{ route('pengajuan.perjadin-dalam-negeri.memuat-uraian') }}" + '/' + no_mak;
                $.ajax({
                    type: "Get",
                    url: url,
                    data: {no_mak: no_mak},
                    dataType: 'json',
                    success: function (result) {
                        var uraian_data = result.uraian_data;
                        var $nama_kegiatan = $("#nama_kegiatan");
                        $nama_kegiatan.empty();
                        uraian_data.forEach(function (entry) {
                            $nama_kegiatan.val(entry.uraian);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            $('.provinsi_id').on('change', function () {
                var id = this.value;
                var url = "{{ route('pengajuan.perjadin-dalam-negeri.memuat-kabkota') }}" + '/' + id;
                $.ajax({
                    type: "Get",
                    url: url,
                    data: {id: id},
                    dataType: 'json',
                    success: function (result) {
                        var kabkota_data = result.kabkota_data;
                        var $kabkota = $(".kabkota");
                        $kabkota.empty();
                        $kabkota.append('<option value=""></option>');
                        kabkota_data.forEach(function (entry) {
                            $kabkota.append('<option value="' + entry.id + '">' + entry.nama + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            });

        });
    </script>
@stop