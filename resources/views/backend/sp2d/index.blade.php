
@extends('backend.sp2d.base')

@section('title')

@section('actions')
    
    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sp2d-modal"><i class="fa fa-plus"></i> @lang('backend/sp2d.SP2D.uploads.sp2d')</a>
    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#spm-modal"><i class="fa fa-plus"></i> @lang('backend/sp2d.SP2D.uploads.spm')</a>
@endsection

@section('rkakl')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('backend/sp2d.SP2D.index.title')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            
                <div class="table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <th>@lang('backend/sp2d.SP2D.tables.nomor_sp2d')</th>
                            <th>@lang('backend/sp2d.SP2D.tables.tgl_selesai')</th>
                            <th>@lang('backend/sp2d.SP2D.tables.tgl')</th>
                            <th>@lang('backend/sp2d.SP2D.tables.nilai')</th>
                            <th>@lang('backend/sp2d.SP2D.tables.nomor_invoice')</th>
                            <th>@lang('backend/sp2d.SP2D.tables.tgl_invoice')</th>
                            <th>@lang('backend/sp2d.SP2D.tables.jenis_spm')</th>
                            <th>@lang('backend/sp2d.SP2D.tables.jenis_sp2d')</th>
                            <th>@lang('backend/sp2d.SP2D.tables.deskripsi')</th>
                        </thead>
                        <tbody>
                            
                            @foreach($Data as $key => $datas)
                            
                            <tr>
                                @if($datas->level == 7)
                                <td>{{ substr($datas->jnsbel , 0 , 6)}} - {{ $datas->ket }}</td>
                                @else
                                <td>{{$datas->ket}}</td>
                                @endif
                                <td align="right">{{number_format($datas->paguakhir , 0, ',', '.')}}</td>
                                <td align="right">{{number_format($datas->realisasi, 0, ',', '.')}}</td>
                                <td align="right">{{number_format($datas->sisa, 0, ',', '.')}}</td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
        </div>
            <!-- /.box -->
        </div>
    </div>

@endsection