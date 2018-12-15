
@extends('backend.keuangan.spm_detail.base')

@section('title', trans('backend/keuangan.SPM.submodule.kegiatan.index.title'), @parent)

@section('actions')
    @role('petugas_spm')

    @endrole
@endsection

@section('spm_detail')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>




                    <div class="box-tools pull-right">
                         | 
                        <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('pengajuan.kegiatan.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">

                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="cari..." value="{{ Request::input('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="form-group pull-right">

                            </div>

                        </form>

                    </div>

                </div>
                <!-- /.box-header -->
                <form action="{{ route('keuangan.spm.simpan_kegiatan') }}" method="post">
                    {{ csrf_field() }}
                <div class="box-body table-responsive no-padding">
                	@if($total > 0)

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('backend\keuangan.SPM.submodule.kegiatan.tables.no_aju')</th>
                                    <th>@lang('backend\keuangan.SPM.submodule.kegiatan.tables.nama_kegiatan')</th>
                                    <th>@lang('backend\keuangan.SPM.submodule.kegiatan.tables.nomak')</th>
                                    <th>@lang('backend\keuangan.SPM.submodule.kegiatan.tables.tgl_aju')</th>
                                    <th>@lang('backend\keuangan.SPM.submodule.kegiatan.tables.nilai_aju')</th>
                                    <th>Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $data_kegiatan)
                                    <tr>
                                        <td>{{ $data_kegiatan->no_pengajuan2 }}</td>
                                        <td>{{ $data_kegiatan->nama_kegiatan }}</td>
                                        <td>{{ $data_kegiatan->no_mak }}.{{ $data_kegiatan->akun }}</td>
                                        <td>{{ $data_kegiatan->tgl_pengajuan }}</td>
                                        <td>{{ number_format($data_kegiatan->jumlah, 0 , '' , '.') }}
                                            <input type="hidden" name="nilai[{{ $data_kegiatan->id }}]" value="{{ $data_kegiatan->jumlah }}">
                                        </td>
                                        <td><input type="checkbox" name="chk[{{ $data_kegiatan->id }}]" id="chk[{{ $data_kegiatan->id }}]" value="{{ $data_kegiatan->id }}"></td>
                                    </tr>
                                @empty
                                @endforelse
                                <tr></tr>
                            </tbody>
                        </table>
                    @else
                    @endif
                </div>
                <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="{{ route('keuangan.spm.detail_spm', [ 'id' => $id ]) }}" type="button" class="btn btn-flat btn-danger btn-sm pull-left"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.back')</a>
                        <input type="hidden" name="idspm" id="idspm" value="{{ $id }}">
                        <button type="submit" class="btn bg-light-blue btn-flat btn-sm pull-right"><i class="fa fa-check"></i> @lang('backend/_globals.buttons.choose')</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@section('javascript')
    @parent
<script type="text/javascript">
        $(document).ready(function() {
            $('.date').datepicker({
                language: "id",
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
        });
</script>

@stop