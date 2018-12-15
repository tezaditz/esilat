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
            <form class="form-horizontal"
                  action="{{ route('pengajuan.perjadin-luar-negeri.detail-pelaksana.store', $perjadin_id) }}"
                  method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/pertanggungjawaban.submodule.pelaksana')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama_satker" class="col-sm-2 control-label">
                            <th>@lang('backend/_globals.tables.nama_satker')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('nama_satker') ? 'has-error' : '' }}">
                        @if($pegawai->count() > 0)
                            <div class="input-group input-group-sm">
                                <select name="nama_satker" class="form-control select2" id="nama_satker" style="width: 100%;" required>
                                            <option value=""></option>
                                            @foreach($eselon as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->nama_satker }}</option>
                                            @endforeach
                                        </select>
                                <span class="input-group-btn">
                                    <a href="{{ route('master.eselon.index') }}" class="btn  btn-flat"><i class="fa fa-upload"></i></a>
                                </span>
                            </div>
                        @else
                            <a href="{{ route('master.pegawai.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.index.is_empty')
                        @endif

                        @if($errors->has('nama_satker'))
                            <span class="help-block">
                                {{ $errors->first('nama_satker') }}
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_pelaksana" class="col-sm-2 control-label">
                            <th>@lang('backend/_globals.tables.nama_pelaksana')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('nama_pelaksana') ? 'has-error' : '' }}">
                        @if($pegawai->count() > 0)
                            <div class="input-group input-group-sm">
                                <select name="nama_pelaksana" class="form-control select2" id="nama_pelaksana" style="width: 100%;" required>
                                            
                                        </select>
                                <span class="input-group-btn">
                                    <a href="{{ route('master.pegawai.index') }}" class="btn  btn-flat"><i class="fa fa-upload"></i></a>
                                </span>
                            </div>
                        @else
                            <a href="{{ route('master.pegawai.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.index.is_empty')
                        @endif

                        @if($errors->has('nama_pelaksana'))
                            <span class="help-block">
                                {{ $errors->first('nama_pelaksana') }}
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nip" class="col-sm-2 control-label">
                            <th>@lang('backend/_globals.tables.nip')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('nip') ? 'has-error' : '' }}">
                            <input type="text" name="nip" class="form-control" id="nip" placeholder="Ex: 195911211987031002"
                                   value="{{ old('nip') }}" readonly="">
                        @if($errors->has('nip'))
                                <span class="help-block">
                                    {{ $errors->first('nip') }}
                                </span>
                            @endif
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="nilai_kurs" class="col-sm-2 control-label">
                            <th>@lang('backend/_globals.tables.nilai_kurs')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('nilai_kurs') ? 'has-error' : '' }}">
                            <input type="text" name="nilai_kurs" class="form-control text-right" id="nilai_kurs" 
                                   value="{{ number_format($nilai_kurs ,0 , ',' , '.') }}" readonly="" align="right" placeholder="123">
                        @if($errors->has('nilai_kurs'))
                                <span class="help-block">
                                    {{ $errors->first('nilai_kurs') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="negara" class="col-sm-2 control-label">
                            <th>@lang('backend/_globals.tables.negara_id')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('negara') ? 'has-error' : '' }}">
                            <input type="hidden" name="negara_id" class="form-control" id="negara_id" 
                                   value="{{ $negaraid }}" readonly="" align="right" >
                            <input type="text" name="negara" class="form-control" id="negara" 
                                   value="{{ $negara }}" readonly="" align="right" >
                        @if($errors->has('negara'))
                                <span class="help-block">
                                    {{ $errors->first('negara') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas_biaya" class="col-sm-2 control-label">
                            <th>@lang('backend/_globals.tables.kelas_biaya')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('kelas_biaya') ? 'has-error' : '' }}">
                        @if($pegawai->count() > 0)
                            <div class="input-group input-group-sm">
                                <select name="kelas_biaya" class="form-control select2" id="kelas_biaya" style="width: 100%;" required>
                                            <option value=""></option>
                                            @foreach($kelas as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->uraian }}</option>
                                            @endforeach
                                        </select>
                                <span class="input-group-btn">
                                    <a href="{{ route('master.pegawai.index') }}" class="btn  btn-flat"><i class="fa fa-upload"></i></a>
                                </span>
                            </div>
                        @else
                            <a href="{{ route('master.pegawai.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.index.is_empty')
                        @endif

                        @if($errors->has('kelas_biaya'))
                            <span class="help-block">
                                {{ $errors->first('kelas_biaya') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uh" class="col-sm-2 control-label">
                            <th>Pagu @lang('backend/_globals.tables.uh')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('uh') ? 'has-error' : '' }}">
                            <input type="text" name="uh" class="form-control text-right" id="uh" 
                                   value="0"  align="right" onkeypress="return isNumberKey(event);" >
                        @if($errors->has('uh'))
                                <span class="help-block">
                                    {{ $errors->first('uh') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pesawat" class="col-sm-2 control-label">
                            <th>@lang('backend/_globals.tables.pesawat')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('pesawat') ? 'has-error' : '' }}">
                            <input type="text" name="pesawat" class="form-control text-right" id="pesawat" 
                                   value="0"  align="right" onkeypress="return isNumberKey(event);" onfocus="this.select();" >
                        @if($errors->has('pesawat'))
                                <span class="help-block">
                                    {{ $errors->first('pesawat') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taxi" class="col-sm-2 control-label">
                            <th>@lang('backend/_globals.tables.taxi')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('taxi') ? 'has-error' : '' }}">
                            <input type="text" name="taxi" class="form-control text-right" id="taxi" 
                                   value="0"  align="right" onkeypress="return isNumberKey(event);" >
                        @if($errors->has('taxi'))
                                <span class="help-block">
                                    {{ $errors->first('taxi') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uh_1" class="col-sm-2 control-label">
                            <th>UH Berangkat</th>
                        </label>
                        <div class="col-sm-5 {{ $errors->has('percen_1') ? 'has-error' : '' }}">

                            <input type="text" name="percen_1" class="form-control text-right" id="percen_1" 
                                   value="{{ $parameter[0] }}"  align="right" onkeypress="return isNumberKey(event);" maxlength="3">
                        @if($errors->has('percen_1'))
                                <span class="help-block">
                                    {{ $errors->first('percen_1') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-5 {{ $errors->has('uh_1') ? 'has-error' : '' }}">

                            <input type="text" name="uh_1" class="form-control text-right" id="uh_1" 
                                   value="0"  align="right" onkeypress="return isNumberKey(event);" readonly="" >
                        @if($errors->has('uh_1'))
                                <span class="help-block">
                                    {{ $errors->first('uh_1') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uh_2" class="col-sm-2 control-label">
                            <th>UH Pelaksanaan</th>
                        </label>
                        <div class="col-sm-5 {{ $errors->has('percen_2') ? 'has-error' : '' }}">

                            <input type="text" name="percen_2" class="form-control text-right" id="percen_2" 
                                   value="{{ $parameter[1] }}"  align="right" onkeypress="return isNumberKey(event);" maxlength="3">
                        @if($errors->has('percen_2'))
                                <span class="help-block">
                                    {{ $errors->first('percen_2') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-5 {{ $errors->has('uh_2') ? 'has-error' : '' }}">
                            <input type="text" name="uh_2" class="form-control text-right" id="uh_2" 
                                   value="0"  align="right" onkeypress="return isNumberKey(event);" readonly="" >
                        @if($errors->has('uh_2'))
                                <span class="help-block">
                                    {{ $errors->first('uh_2') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uh_3" class="col-sm-2 control-label">
                            <th>UH Pulang</th>
                        </label>
                        <div class="col-sm-5 {{ $errors->has('percen_3') ? 'has-error' : '' }}">

                            <input type="text" name="percen_3" class="form-control text-right" id="percen_3" 
                                   value="{{ $parameter[2] }}"  align="right" onkeypress="return isNumberKey(event);" maxlength="3">
                        @if($errors->has('percen_3'))
                                <span class="help-block">
                                    {{ $errors->first('percen_3') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-5 {{ $errors->has('uh_3') ? 'has-error' : '' }}">
                            <input type="text" name="uh_3" class="form-control text-right" id="uh_3" 
                                   value="0"  align="right" onkeypress="return isNumberKey(event);" readonly="" >
                        @if($errors->has('uh_3'))
                                <span class="help-block">
                                    {{ $errors->first('uh_3') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total_biaya" class="col-sm-2 control-label">
                            <th>Total Biaya</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('total_biaya') ? 'has-error' : '' }}">
                            <input type="text" name="total_biaya" class="form-control text-right" id="total_biaya" 
                                   value="0"  align="right" onkeypress="return isNumberKey(event);" readonly="" >
                        @if($errors->has('total_biaya'))
                                <span class="help-block">
                                    {{ $errors->first('total_biaya') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="lama" id="lama" value="{{ $lama - 2 }}">
                    
               


                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-left"
                            data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit"
                            class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('javascript')
    @parent

    <script type="text/javascript">
        function isNumberKey(evt){
                    var charCode = (evt.which) ? evt.which : event.keyCode
                    if (charCode > 31 && (charCode < 48 || charCode > 57))
                        return false;
                    return true;
                }

        $(document).ready(function(){
            
                $('#pesawat').keyup(function(){
                    var total = $('#total_biaya');
                    var uh1 = $('#uh_1');
                    var uh2 = $('#uh_2');
                    var uh3 = $('#uh_3');
                    var taxi = $('#taxi');
                    if (/\D/g.test(this.value))
                    {
                        this.value = this.value.replace(/\D/g, '');
                        
                    }

                    if(this.value.replace(/\D/g, '') > 0)
                        {
                            var hitung;
                            $('#total_biaya').empty();
                            $('#total_biaya').val(0);
                            hitung = parseFloat(this.value.replace(/\D/g, '')) + parseFloat(taxi.val().replace(/\D/g, '')) + parseFloat(total.val().replace(/\D/g, '')) + parseFloat(uh1.val().replace(/\D/g, '')) + parseFloat(uh2.val().replace(/\D/g, '')) + parseFloat(uh3.val().replace(/\D/g, ''));
                            
                            $('#total_biaya').val(hitung.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                        
                        }
                    $('#pesawat').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                    
                    
                });

                $('#taxi').keyup(function(){
                    var total = $('#total_biaya');
                    var uh1 = $('#uh_1');
                    var uh2 = $('#uh_2');
                    var uh3 = $('#uh_3');
                    var pesawat = $('#pesawat');
                    if (/\D/g.test(this.value))
                    {
                        this.value = this.value.replace(/\D/g, '');
                    }

                    if(this.value.replace(/\D/g, '') > 0)
                        {
                            var hitung;
                            $('#total_biaya').empty();
                            $('#total_biaya').val(0);
                            hitung = parseFloat(this.value.replace(/\D/g, '')) + parseFloat(pesawat.val().replace(/\D/g, '')) + parseFloat(total.val().replace(/\D/g, '')) + parseFloat(uh1.val().replace(/\D/g, '')) + parseFloat(uh2.val().replace(/\D/g, '')) + parseFloat(uh3.val().replace(/\D/g, ''));
                            
                            $('#total_biaya').val(hitung.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                        
                        }
                    $('#taxi').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                });

                $('#uh').keyup(function(){

                    var kurs = $("#nilai_kurs");
                    
                    var a = this.value;
                    
                    if (/\D/g.test(this.value))
                    {
                        this.value = this.value.replace(/\D/g, '');

                    }
                    $('#uh').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                });       
        });

            $(document).ready(function() {
                $('#nama_pelaksana').on('change', function() {
                    var id = this.value;
                    var url = "{{ route('pengajuan.perjadin-luar-negeri.memuat-nip') }}"+'/'+id;
                    $.ajax({
                        type: "Get",
                        url: url,
                        data: {id: id},
                        dataType: 'json',
                        success: function(result) {
                            var uraian_data = result.uraian_data;
                            var $nip = $("#nip");
                            $nip.empty();
                            uraian_data.forEach(function(entry) {
                                $nip.val(entry.nip);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $('#nama_satker').on('change', function() {
                    var id = this.value;
                    var url = "{{ route('pengajuan.perjadin-luar-negeri.memuat-pegawai') }}"+'/'+id;
                    $.ajax({
                        type: "Get",
                        url: url,
                        data: {id: id},
                        dataType: 'json',
                        success: function(result) {
                           var maks_data = result;
                            var $pegawai = $("#nama_pelaksana");
                            $pegawai.empty();
                            $pegawai.append('<option value=""></option>');
                            maks_data.forEach(function(entry) {
                                $pegawai.append('<option value="'+entry.id+'">'+entry.nama+'</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            }); 

            $(document).ready(function() {
                $('#kelas_biaya').on('change', function() {
                    var kelas = this.value;
                    var negara = $('#negara_id');
                    var negaraid = negara.val();
                    console.log(negaraid);
                    var url = "{{ route('pengajuan.perjadin-luar-negeri.memuat-kelas-biaya') }}"+'/'+kelas+'/'+negaraid;
                   
                    $.ajax({
                        type: "Get",
                        url: url,
                        data: {kelas: kelas , negara: negaraid},
                        dataType: 'json',
                        success: function(result) {
                            // var data = result.uraian_data;
                            var nilai = $('#uh');
                            nilai.empty();
                            nilai.val(result);
                            if(result != 0)
                            {
                                nilai.prop("disabled", true);
                            }
                            else{
                                nilai.prop("disabled", false);
                            } 
                            nilai.select();
                            var kurs    = $('#nilai_kurs');
                            var percen1 = $('#percen_1');
                            var percen2 = $('#percen_2');
                            var percen3 = $('#percen_3');
                            var lm = $('#lama');
                            var uh = $('#uh');
                            var uh1 = $('#uh_1');
                            var uh2 = $('#uh_2');
                            var uh3 = $('#uh_3');
                            var nilai1 = kurs.val().replace(/\D/g, '') * uh.val() * ( percen1.val() / 100) ;
                            var nilai2 = kurs.val().replace(/\D/g, '') * uh.val() * ( percen2.val() / 100) * lm.val() ;
                            var nilai3 = parseFloat(kurs.val().replace(/\D/g, '') * uh.val() * ( percen3.val() / 100)) ;
                            uh1.empty();
                            uh2.empty();
                            uh3.empty();
                            uh1.val(nilai1.toFixed(0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                            uh2.val(nilai2.toFixed(0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                            uh3.val(nilai3.toFixed(0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                            
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            });  


    </script>
@stop