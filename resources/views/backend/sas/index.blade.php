
@extends('backend.sas.base')

@section('title')

@section('actions')
    
    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#upload-modal"><i class="fa fa-plus"></i> Upload Excel "Tayang Pagu" </a>
    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> Upload List SPM</a>
@endsection

@section('rkakl')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('backend/sas.module')</h3>
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
                            <th>Uraian</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Sisa Anggaran</th>
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