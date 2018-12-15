<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 01:25 PM
 */
?>
<div class="modal fade" id="create-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pengajuan.layanan-perkantoran.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/perkantoran.submodule.perkantoran')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="no_mak" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.no_mak')</label>
                        <div class="col-sm-10 {{ $errors->has('no_mak') ? 'has-error' : '' }}">
                            @if($rkakls->count() > 0)
                                <div class="input-group input-group-sm">
                                    <select name="no_mak" class="form-control select2" id="no_mak" style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach($rkakls as $key => $rkakl)
                                            <option value="{{ $rkakl->no_mak }}">{{ $rkakl->no_mak }} - {{ $rkakl->uraian }} - {{ number_format($rkakl->jumlah - $rkakl->realisasi, 0) }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.rkakl.index') }}" class="btn  btn-flat"><i class="fa fa-upload"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('no_mak'))
                                    <span class="help-block">
                                    {{ $errors->first('no_mak') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.rkakl.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.index.is_empty')
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="uraian" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.uraian')</label>
                        <div class="col-sm-10 {{ $errors->has('uraian') ? 'has-error' : '' }}">
                            <input type="text" name="uraian" class="form-control" id="uraian" placeholder="Memfasilitasi Pengembangan Obat dan Bahan Baku Sediaan Farmasi Dalam Negeri" required readonly>
                            @if($errors->has('uraian'))
                                <span class="help-block">
                                    {{ $errors->first('uraian') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Keterangan" class="col-sm-2 control-label">@lang('backend/perkantoran.perkantoran.tables.keterangan')</label>
                        <div class="col-sm-10 {{ $errors->has('keterangan') ? 'has-error' : '' }}">
                            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="keterangann" value="{{ old('keterangan') }}" required>
                            @if($errors->has('keterangan'))
                                <span class="help-block">
                                    {{ $errors->first('keterangan') }}
                                </span>
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

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function() {
            $('#no_mak').on('change', function() {
                var id = this.value;
                var url = "{{ route('pengajuan.layanan-perkantoran.memuat-uraian') }}"+'/'+id;
                $.ajax({
                    type: "Get",
                    url: url,
                    data: {id: id},
                    dataType: 'json',
                    success: function(result) {
                        var uraian_data = result.uraian_data;
                        var $nama_kegiatan = $("#uraian");
                        $nama_kegiatan.empty();
                        uraian_data.forEach(function(entry) {
                            $nama_kegiatan.val(entry.uraian);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@stop