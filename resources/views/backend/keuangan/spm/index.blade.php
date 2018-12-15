
@extends('backend.keuangan.spm.base')

@section('title', trans('backend/keuangan.SPM.index.title'), @parent)

@section('actions')
    @role('petugas_spm')
    <a href="javascript:void(0)" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
    @endrole
@endsection

@section('spm')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">

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
                <div class="box-body table-responsive no-padding">
                	@if($total > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('backend/keuangan.SPM.tables.nomor_spm')</th>
                                    <th>@lang('backend/keuangan.SPM.tables.tanggal_spm')</th>
                                    <th>@lang('backend/keuangan.SPM.tables.nilai_spm')</th>
                                    <th>@lang('backend/keuangan.SPM.tables.nomor_sp2d')</th>
                                    <th>@lang('backend/keuangan.SPM.tables.tanggal_sp2d')</th>
                                    <th>@lang('backend/keuangan.SPM.tables.nilai_sp2d')</th>
                                </tr>      
                            </thead>
                            <tbody>
                                @forelse($spm as $data_spm)
                                <tr>
                                    <td>{{ $data_spm->nomor_spm }}</td>
                                    <td>{{ $data_spm->tanggal_spm }}</td>
                                    <td>{{ $data_spm->nilai_spm }}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/keuangan.SPM.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">

                    </div>
                </div>
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

            $('#judul').on('change', function() {
                var judul = this.value;
                var url = "{{ route('pengajuan.kegiatan.memuat-mak') }}"+'/'+judul;
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
                            $no_mak.append('<option value="'+entry.no_mak+'">'+entry.no_mak+' - '+entry.uraian+' - '+entry.pegu+'</option>');
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