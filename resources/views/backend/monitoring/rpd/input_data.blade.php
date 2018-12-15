@extends('backend.monitoring.rpd.base')

@section('title', trans('backend/monitoring/rpd.index.title'), @parent)


@section('actions')
 
@endsection

@section('rpd')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Master RPK RPD</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
           </div>
            <!-- /.box-header -->
            <div class="box-body">
                @foreach($rpd as $key => $value)
                @if($value->level == 7)
                <table class="table">
                    <tr>
                        <td width="10%" class="text-right" ><label class="control-label">Nama Kegiatan</label></td>
                        <td>
                        <input class="col-xs-6" value="{{ $value->uraian }}" readonly name="uraian"></td>
                    </tr>
                    <tr>
                        <td width="10%" class="text-right" ><label class="control-label">No MAK Kegiatan</label></td>
                        <td>
                        <input class="col-xs-6" value="{{ $value->no_mak }}" readonly></td>
                    </tr>
                    <tr>
                        <td width="10%" class="text-right" ><label class="control-label">Alokasi</label></td>
                        <td>
                        <input class="col-xs-6 text-right" value="{{ number_format($value->pagu,0) }}" readonly>
                        <input type="hidden" name="rpdid" id="rpdid" value="{{$value->id}}">
                        </td>
                    </tr>
                </table>
                @endif
                @endforeach
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="pull-right">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Rencana Pelaksanaan Kegiatan
                </h3>
                <div class="box-tools pull-right">
                @role('user')
                <a href="javascript:void(0)" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#input-rpk-modal-{{ $rpd[0]['id'] }}"><i class="fa fa-plus"></i>@lang('backend/_globals.buttons.create')</a>
                @endrole
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
           </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Tanggal Awal</th>
                            <th class="text-center">Tanggal Akhir</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($rpd as $key => $value)
                        @forelse($value->rpk as $data_rpk)
                        
                        <tr>
                            <td class="text-center">
                               {{ $data_rpk->tglFrom_update }}
                            </td>
                            <td class="text-center">
                               {{ $data_rpk->tglTo_update }}
                            </td>
                            <td class="text-center">
                                @role('user')
                                <a href="javascript:void(0)" class="btn btn-success btn-xs" data-toggle="modal" data-target="#edit-rpk-modal-{{ $data_rpk->id }}"><i class="fa fa-pencil"></i> @lang('backend/_globals.buttons.edit')</a>
                                <a href="{{ route('monitoring.rpkrpd.hapus_rpk', $data_rpk->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> @lang('backend/_globals.buttons.delete')</a>
                                @endrole
                            </td>
                        </tr>
                        @empty
                        @endforelse
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
    <div class="col-xs-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Rencana Penarikan Dana
                </h3>
                <div class="box-tools pull-right">
<!--                 @role('user')
                <a href="javascript:void(0)" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#input-rpk-modal-{{ $rpd[0]['id'] }}"><i class="fa fa-plus"></i>@lang('backend/_globals.buttons.create')</a>
                @endrole -->
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
           </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                        <thead class="text-center danger" >
                            <tr>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.kode')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.uraian')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.pagu')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.jan')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.feb')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.mar')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.apr')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.mei')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.jun')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.jul')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.ags')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.sep')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.okt')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.nov')</td>
                                <td class="align-middle" rowspan="2">@lang('backend/monitoring/rpd.tables.des')</td>
                                <td class="align-middle" colspan="2">Jenis Transaksi</td>
                                <td class="align-middle" colspan="2">Action</td>
                            </tr>
                            <tr>

                                <td>Tupoksi</td>
                                <td>Pengadaan</td>
                            </tr>
                        </thead>
                    
                         <tbody>
                            @foreach($rpd as $key => $value)
                           <tr>
                               <td>{{ $value->kode }}</td>
                               <td>{{ $value->uraian }}</td>
                               @if($value->level == 0)
                               <td class="text-right">{{ number_format($value->pagu,0)}}</td>
                               <td class="text-right">{{ number_format($value->jan_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->feb_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->mar_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->apr_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->mei_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->jun_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->jul_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->ags_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->sep_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->okt_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->nov_update,0)}}</td>
                               <td class="text-right">{{ number_format($value->des_update,0)}}</td>
                               <td class="text-center"><input type="radio" name="Tupoksi[{{ $value->id }}]" value="0" disabled  {{ $value->flag_pengadaan == 0 ? 'checked' : '' }} ></td>
                               <td class="text-center"><input type="radio" name="Tupoksi[{{ $value->id }}]" value="1"
                                disabled {{ $value->flag_pengadaan == 1 ? 'checked' : '' }}></td>
                               <td>
                                @if($value->locked == 0)
                                <a href="" class="btn btn-success btn-xs" data-toggle="modal" data-target="#input-rpd-modal-{{ $value->id }}"><i class="fa fa-pencil"></i> @lang('backend/_globals.buttons.edit')</a>
                                @else
                                <a href="" class="btn btn-success btn-xs" data-toggle="modal" data-target="#edit-rpd-modal-{{ $value->id }}"><i class="fa fa-pencil"></i> @lang('backend/_globals.buttons.edit')</a>
                                @endif
                                </td>
                               @else
                               <td colspan="16"></td>
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
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
           </div>
            <!-- /.box-header -->
            <div class="box-body">
                


                
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="pull-left">
                    <a href="{{route('monitoring.rpkrpd.index')}}" class="btn btn-danger btn-md"><span class="fa fa-close"></span>  Batal</a>
                </div>
                <div class="pull-right">
                    <a href="" class="btn btn-success btn-md" data-toggle="modal" data-target="#form-simpan"><span class="fa fa-save"></span> Simpan</a>
                
                </div>
            </div>
        </div>
    </div>
</div>
    @include('backend.monitoring.rpd.input_rpk')
    @include('backend.monitoring.rpd.input_rpd')
    @include('backend.monitoring.rpd.edit_rpd')
    @include('backend.monitoring.rpd.edit_rpk')
            <div class="modal fade" id="form-simpan">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4>Menyimpan data</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box box-success">
                                <div class="box-body table-responsive no-padding text-center">
                                    <br>
                                    <h4>Anda Ingin Menyimpan Data ?</h4>
                                    <br>
                                      
                                </div>
                            </div>
                    </div>
                        <div class="modal-footer">
                             <a href="{{ route('monitoring.rpkrpd.kunci_rpd' , $rpd[0]['id'] ) }}" class="btn bg-light-blue btn-sm"><i class="fa fa-save"></i> Simpan</a>  
                                <a href="" class="btn btn-danger btn-sm pull-left"><i class="fa fa-close"></i> Batal</a> 
                            
                        </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
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

            function hitungEdit(obj)
            {               
                var id = obj.id;
                var x = id.replace("jan_edit" , "");
                var x = x.replace("feb_edit" , "");
                var x = x.replace("mar_edit" , "");
                var x = x.replace("apr_edit" , "");
                var x = x.replace("mei_edit" , "");
                var x = x.replace("jun_edit" , "");
                var x = x.replace("jul_edit" , "");
                var x = x.replace("ags_edit" , "");
                var x = x.replace("sep_edit" , "");
                var x = x.replace("okt_edit" , "");
                var x = x.replace("nov_edit" , "");
                var x = x.replace("des_edit" , "");
                var x= x.replace("[" , "");
                var x= x.replace("]" , "");
                
                var pagu = document.getElementById('alokasi[' + x + ']').value.replace(/\D/g, '');
                var jan = document.getElementById('jan_edit[' + x + ']').value.replace(/\D/g, '');
                var feb = document.getElementById('feb_edit[' + x + ']').value.replace(/\D/g, '');
                var mar = document.getElementById('mar_edit[' + x + ']').value.replace(/\D/g, '');
                var apr = document.getElementById('apr_edit[' + x + ']').value.replace(/\D/g, '');
                var mei = document.getElementById('mei_edit[' + x + ']').value.replace(/\D/g, '');
                var jun = document.getElementById('jun_edit[' + x + ']').value.replace(/\D/g, '');
                var jul = document.getElementById('jul_edit[' + x + ']').value.replace(/\D/g, '');
                var ags = document.getElementById('ags_edit[' + x + ']').value.replace(/\D/g, '');
                var sep = document.getElementById('sep_edit[' + x + ']').value.replace(/\D/g, '');
                var okt = document.getElementById('okt_edit[' + x + ']').value.replace(/\D/g, '');
                var nov = document.getElementById('nov_edit[' + x + ']').value.replace(/\D/g, '');
                var des = document.getElementById('des_edit[' + x + ']').value.replace(/\D/g, '');

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

                document.getElementById('saldo_edit[' + x + ']').value = saldo.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");

                document.getElementById(obj.id).value = obj.value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."); 
            };


            function cek_bulan(nilai)
            {
                var id = document.getElementById('rpdid');

               $.ajax({
                    method: 'GET',
                    url : '/monitoring/cek_bulan/' + id.value + '/' + nilai,
                    success : function(data){
                       if(data.lenght > 0)
                       {
                        return true;
                        }
                        else
                        {
                            alert('Tidak ada RPK untuk bulan ini');
                            $("#uraian").select();
                            location.reload(true);
                       }
                        
                    },
               });

            }






    </script>
@stop