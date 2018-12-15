@extends('backend.monitoring.rpd.base')

@section('title', trans('backend/monitoring/rpd.index.title_rkakl'), @parent)


@section('actions')

@endsection

@section('rpd')
<div class="row">
    <div class="col-xs-12">
        <form action="{{ route('monitoring.rpkrpd.simpan_rkakl') }}" method="POST">

            {{ csrf_field() }}
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">
                    @role('user')
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success btn-sm">
                    @endrole
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">@lang('backend/monitoring/rpd.rkakl_tables.kode')</th>
                                    <th class="text-center">@lang('backend/monitoring/rpd.rkakl_tables.uraian')</th>
                                    <th class="text-center">@lang('backend/monitoring/rpd.rkakl_tables.alokasi')</th>
                                    <th class="text-center">Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rkakl as $key => $data_rkakl)
                                    <tr>
                                        <td>{{ $data_rkakl->no_mak }}</td>
                                        <td>{{ $data_rkakl->uraian }}</td>
                                        <td class="text-right">{{ number_format($data_rkakl->jumlah ,0 , 0, ".") }}</td>
                                        <td> <input type="checkbox" id="checkbox{{ $data_rkakl->id }}" name="checkbox[{{ $data_rkakl->id }}]" value="{{ $data_rkakl->id }}"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</div>

@endsection