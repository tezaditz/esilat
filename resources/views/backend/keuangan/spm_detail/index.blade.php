
@extends('backend.keuangan.spm_detail.base')

@section('title', trans('backend/keuangan.spm_detail.index.title'), @parent)

@section('actions')
    @role('petugas_spm')

    <a href="{{ route('keuangan.spm.kegiatan_list' , ['id' => $id] ) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Data Kegiatan</a>
    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> Data Perjadin</a>
    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> Data Layanan Perkantoran</a>
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
                	
                        <table class="table table-hover">
                        	<thead>
                                <tr>
                                    <th>@lang('backend/keuangan.spm_detail.tables.nomak')</th>
                                    <th>@lang('backend/keuangan.spm_detail.tables.nama_kegiatan')</th>
                                    <th>@lang('backend/keuangan.spm_detail.tables.nilai')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($spmdetail as $data_detail)
                                <tr>
                                    <td>{{$data_detail->no_mak}}</td>
                                    <td>{{$data_detail->deskripsi}}</td>
                                    <td>{{ number_format($data_detail->nilai_transaksi ,0, ',', '.')}}</td>
                                </tr> 
                            @empty
                            <div class="text-center">
                                <br><br>
                                <i class="fa fa-exclamation-triangle fa-2x"></i>
                                <h4 class="no-margins">@lang('backend/keuangan.SPM.index.is_empty')</h4>
                                <br><br>
                            </div>
                            @endforelse   
                            </tbody>
                            
                        </table>


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
        });
</script>

@stop