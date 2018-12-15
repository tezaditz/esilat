@extends('backend.monitoring.rpd.base')

@section('title', trans('backend/monitoring/rpd.index.title'), @parent)


@section('actions')
 @role('user')
     <a href="{{ route('monitoring.rpkrpd.report') }}" class="btn bg-orange btn-sm" target="_blank" title="Laporan RPD"><i class="fa fa-print"></i> @lang('backend/_globals.buttons.print')</a>
    <a href="{{ route('monitoring.rpkrpd.rkakl') }}" class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
    @endrole
@endsection

@section('rpd')
<div class="row">
	<div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

               </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                	    <table class="table table-bordered" id="tableRPD">
					    	<thead class="text-center">
					    		<tr>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.kode')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.uraian')</th>
                                    <th class="text-center">@lang('backend/monitoring/rpd.tables.pagu')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.jan')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.feb')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.mar')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.apr')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.mei')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.jun')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.jul')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.ags')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.sep')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.okt')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.nov')</th>
					    			<th class="text-center">@lang('backend/monitoring/rpd.tables.des')</th>
                                    <th>Action</th>
					    		</tr>
					    	</thead>
                            <tbody>
                                @foreach($rpd as $key => $data_rpd)
                                <tr>
                                    <td>{{ $data_rpd->kode }}</td>
                                    <td>{{ $data_rpd->uraian }}
                                    </td>
                                    <td class="text-right">{{ number_format($data_rpd->pagu , 0 , 0 , ".") }}
                                    </td>
                                    @if($data_rpd->level != 7 )
                                        <td class="text-right">{{ number_format($data_rpd->jan_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->feb_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->mar_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->apr_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->mei_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->jun_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->jul_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->ags_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->sep_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->okt_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->nov_update,0,0,".") }}</td>
                                        <td class="text-right">{{ number_format($data_rpd->des_update,0,0,".") }}</td>
                                        <td>
                                            
                                            <!-- <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#input-rpd-modal-{{ $data_rpd->id }}"><i class="fa fa-pencil"></i> 
                                                @lang('backend/_globals.buttons.edit')
                                            </a> -->
                                        </td>
                                    @else
                                        <td>
                                            <table>
                                                @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 1)
                                                <tr>
                                                    <td>
                                                        <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                               
                                                    </td>
                                                </tr>
                                                
                                                @endif
                                            @empty
                                            @endforelse
                                            </table>
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 2)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 3)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 4)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 5)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 6)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 7)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 8)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 9)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 10)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 11)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($data_rpd->rpk as $data_rpk)
                                                @if($data_rpk->monthTo_update == 12)
                                                <label>{{ $data_rpk->tglFrom_update }} s.d. {{ $data_rpk->tglTo_update }}</label>
                                            
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @if($data_rpd->locked == 1)
                                            <a href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#open-rpd-{{ $data_rpd->id }}"><i class="fa fa-lock"></i></a>
                                            <a href="" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                                            @else
                                            <a href="{{ route('monitoring.rpkrpd.input_rpkrpd' , $data_rpd->id ) }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
                                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> @lang('backend/_globals.buttons.delete')</a></td>
                                            @endif
                                    @endif
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
	</div>
	
</div>

@include('backend.monitoring.rpd.open_lock')
    
@endsection

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
            $('.date').datepicker({
                language: "id",
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });           
        });

            function isNumber(evt)
            {
                var charCode = (evt.which) ? evt.which : evt.keycode;
                if (charCode != 46 && charCode > 31 
                    && ( charCode< 48 || charCode > 57))
                    return false;
                if(charCode == 13)
                    return false;

                return true;
            }

            function hitung(obj)
            {               
                var id = obj.id;
                var x = id.replace("jan" , "");
                var x = x.replace("feb" , "");
                var x = x.replace("mar" , "");
                var x = x.replace("apr" , "");
                var x = x.replace("mei" , "");
                var x = x.replace("jun" , "");
                var x = x.replace("jul" , "");
                var x = x.replace("ags" , "");
                var x = x.replace("sep" , "");
                var x = x.replace("okt" , "");
                var x = x.replace("nov" , "");
                var x = x.replace("des" , "");
                var x= x.replace("[" , "");
                var x= x.replace("]" , "");
                
                var pagu = document.getElementById('alokasi[' + x + ']').value.replace(/\D/g, '');
                var jan = document.getElementById('jan[' + x + ']').value.replace(/\D/g, '');
                var feb = document.getElementById('feb[' + x + ']').value.replace(/\D/g, '');
                var mar = document.getElementById('mar[' + x + ']').value.replace(/\D/g, '');
                var apr = document.getElementById('apr[' + x + ']').value.replace(/\D/g, '');
                var mei = document.getElementById('mei[' + x + ']').value.replace(/\D/g, '');
                var jun = document.getElementById('jun[' + x + ']').value.replace(/\D/g, '');
                var jul = document.getElementById('jul[' + x + ']').value.replace(/\D/g, '');
                var ags = document.getElementById('ags[' + x + ']').value.replace(/\D/g, '');
                var sep = document.getElementById('sep[' + x + ']').value.replace(/\D/g, '');
                var okt = document.getElementById('okt[' + x + ']').value.replace(/\D/g, '');
                var nov = document.getElementById('nov[' + x + ']').value.replace(/\D/g, '');
                var des = document.getElementById('des[' + x + ']').value.replace(/\D/g, '');

                var total = parseFloat(jan) + parseFloat(feb) + parseFloat(mar) + parseFloat(apr) + parseFloat(mei) + parseFloat(jun) + parseFloat(jul) + parseFloat(ags) + parseFloat(sep) + parseFloat(okt) + parseFloat(nov) + parseFloat(des);

                var saldo = parseFloat(pagu) - parseFloat(total);

                if(saldo < 0)
                {
                    console.log('a');
                    alert('Sisa Anggaran Kurang Dari 0 !');
                    obj.value = 0;
                    obj.select();
                    return false;
                }

                document.getElementById('saldo[' + x + ']').value = saldo.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");

                document.getElementById(obj.id).value = obj.value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."); 
            };






    </script>
@stop