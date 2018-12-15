<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:14 AM
 */
?>
@extends('backend.pengajuan.perjadinluarnegri.base')

@section('title', trans('backend/pertanggungjawaban.perjadin.index.perjadin_luar_title', ['total' => $perjadins->total()]), @parent)

@section('actions')
    @role('user')
        <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
    @endrole
@endsection

@section('pengajuan-perjadin-luarnegri')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <form action="{{ route('pengajuan.perjadin-luar-negeri.search') }}" method="post" class="pull-right">
                            {{ csrf_field() }}
                            <div class="input-group input-group-sm pull-right" style="width: 150px;">
                                <input type="text" name="search" class="form-control" id="no_rekening" placeholder="cari..." value="{{ Request::input('search') }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <select class="form-control input-sm" name="options">
                                    <option value="bagian.nama_bagian">@lang('backend/_globals.tables.bagian_id')</option>
                                    <option value="perjadin_luar_negri.no_pengajuan">@lang('backend/_globals.tables.no_pengajuan')</option>
                                    <option value="perjadin_luar_negri.tgl_pengajuan">@lang('backend/_globals.tables.tgl_pengajuan')</option>
                                    <option value="perjadin_luar_negri.no_mak">@lang('backend/_globals.tables.no_mak')</option>
                                    <option value="perjadin_luar_negri.nama_kegiatan">@lang('backend/_globals.tables.nama_kegiatan')</option>
                                    <option value="perjadin_luar_negri.no_surat_tugas">@lang('backend/pertanggungjawaban.perjadin.tables.no_surat_tugas')</option>
                                    <option value="perjadin_luar_negri.tgl_surat_tugas">@lang('backend/pertanggungjawaban.perjadin.tables.tgl_surat_tugas')</option>
                                    <option value="perjadin_luar_negri.tgl_awal">@lang('backend/_globals.tables.tgl_awal')</option>
                                    <option value="perjadin_luar_negri.tgl_akhir">@lang('backend/_globals.tables.tgl_akhir')</option>
                                    <option value="perjadin_luar_negri.lama">Lama</option>
                                    <option value="negara.nama_negara">@lang('backend/_globals.tables.negara_id')</option>
                                    <option value="status.keterangan">@lang('backend/_globals.tables.keterangan')</option>
                                    <option value="status.posisi_dokumen">@lang('backend/_globals.tables.posisi_dok')</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($perjadins->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/_globals.tables.bagian_id')</th>
                                <th>@lang('backend/_globals.tables.no_pengajuan')</th>
                                <th>@lang('backend/_globals.tables.tgl_pengajuan')</th>
                                <th>@lang('backend/_globals.tables.no_mak')</th>
                                <th>@lang('backend/_globals.tables.nama_kegiatan')</th>
                                <th>@lang('backend/_globals.tables.tgl_kegiatan')</th>
                                <th>@lang('backend/_globals.tables.total_pengajuan')</th>
                                <th>@lang('backend/_globals.tables.status')</th>
                                <th>@lang('backend/_globals.tables.posisi_dok')</th>
                                <th></th>
                            </tr>
                            @foreach($perjadins as $key => $perjadin)
                                @if($perjadin->status->kode_status == 'PR91')
                                    <tr class="bg-yellow color-palette">
                                @else
                                    <tr>
                                @endif
                                    <td>{{ $perjadin->bagian->nama_bagian }}</td>
                                    <td>
                                        <?php $noaju = $perjadin->no_pengajuan; ?>
                                        @if(strlen($noaju) == 1)
                                            <?php $noaju = '00' . $noaju; ?>
                                        @elseif(strlen($noaju) == 2)
                                            <?php $noaju = '0' . $noaju; ?>
                                        @else
                                            <?php $noaju = $noaju; ?>
                                        @endif
                                        AJU-{{ $noaju }}/{{ $perjadin->bagian->kode }}/{{ $perjadin->thn_anggaran }}
                                    </td>
                                    <td>{{ date('d M Y', strtotime($perjadin->tgl_pengajuan)) }}</td>
                                    <td>{{ $perjadin->no_mak }}</td>
                                    <td>{{ $perjadin->nama_kegiatan }}</td>
                                    <td>{{ date('d', strtotime($perjadin->tgl_awal)) }} s.d {{ date('d M Y', strtotime($perjadin->tgl_akhir)) }}</td>
                                    <td class="text-right">{{ number_format($perjadin->total_pengajuan  ,0, ',', '.') }}</td>
                                    <td>{{ $perjadin->status->keterangan }}</td>
                                    <td>{{ $perjadin->status->posisi_dokumen }}</td>
                                    <td class="text-right" width="120px">
                                        @role('bendahara')
                                             @if($perjadin->status->kode_status == 'PR01' || $perjadin->status->kode_status == 'PR02' || $perjadin->status->kode_status == 'PR03' )
                                                <a href="{{ route('pengajuan.perjadin-luar-negeri.draft-perjadin', $perjadin->id) }}" class="btn btn-flat btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                             @endif
                                        @endrole

                                        @role('user')
                                            @if($perjadin->status->kode_status == 'PR00' || $perjadin->status->kode_status == 'PR91' )
                                                <a href="{{ route('pengajuan.perjadin-luar-negeri.draft-perjadin', $perjadin->id) }}" class="btn btn-flat btn-default btn-xs"><span class="fa fa-eye" aria-hidden="true"/></a>
                                                <a href="" class="btn btn-default btn-flat btn-xs" data-toggle="modal" data-target="#edit-modal{{ $perjadin->id }}" title="@lang('backend/_globals.buttons.edit')"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#remove-modal{{ $perjadin->id }}" ><i class="fa fa-trash"></i></a>
                                                <a href="{{ route('pengajuan.perjadin-luar-negeri.nota-dinas', $perjadin->id) }}" class="btn btn-success btn-flat btn-xs" title="@lang('backend/_globals.buttons.cetak_kwi_bayar')" target="_blank"><i class="fa fa-print"></i></a>
                                            @elseif($perjadin->status->kode_status == 'PR01')
                                                <a href="{{ route('pengajuan.perjadin-luar-negeri.draft-perjadin', $perjadin->id) }}" class="btn btn-flat btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                                <a href="{{ route('pengajuan.perjadin-luar-negeri.nota-dinas', $perjadin->id) }}" class="btn btn-success btn-flat btn-xs" title="@lang('backend/_globals.buttons.cetak_kwi_bayar')" target="_blank"><i class="fa fa-print"></i></a>
                                            @endif
                                        @endrole
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/pertanggungjawaban.perjadin.index.kegiatan_is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $perjadins])
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

    @foreach($perjadins as $perjadin)
        <div class="modal fade" id="remove-modal{{ $perjadin->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('pengajuan.perjadin-luar-negeri.destroy', $perjadin->id) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/pertanggungjawaban.submodule.perjadin')</h4>
                        </div>
                        <div class="modal-body">

                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            Ingin menghapus data?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('backend/_globals.buttons.yes')</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
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

            $('#no_mak').on('change', function() {
                var id = this.value;
                var url = "{{ route('pengajuan.kegiatan.memuat-uraian') }}"+'/'+id;
                $.ajax({
                    type: "Get",
                    url: url,
                    data: {id: id},
                    dataType: 'json',
                    success: function(result) {
                        var uraian_data = result.uraian_data;
                        var $nama_kegiatan = $("#nama_kegiatan");
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