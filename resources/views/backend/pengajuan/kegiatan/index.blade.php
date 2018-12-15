<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:14 AM
 */
?>
@extends('backend.pengajuan.kegiatan.base')

@section('title', trans('backend/pengajuan.kegiatan.index.title', ['total' => $kegiatans->total()]), @parent)

@section('actions')
    @role('user')
    <a href="#" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a>
    @endrole
@endsection

@section('kegiatan')
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
                                <select class="form-control input-sm" name="options">
                                    <option value="bagian.nama_bagian">@lang('backend/_globals.tables.bagian_id')</option>
                                    <option value="kegiatan.no_pengajuan2">@lang('backend/_globals.tables.no_pengajuan')</option>
                                    <option value="kegiatan.tgl_pengajuan">@lang('backend/_globals.tables.tgl_pengajuan')</option>
                                    <option value="kegiatan.no_mak">@lang('backend/_globals.tables.no_mak')</option>
                                    <option value="kegiatan.nama_kegiatan">@lang('backend/_globals.tables.nama_kegiatan')</option>
                                    <option value="kegiatan.tgl_awal">@lang('backend/_globals.tables.tgl_awal')</option>
                                    <option value="kegiatan.tgl_akhir">@lang('backend/_globals.tables.tgl_akhir')</option>
                                    <option value="kegiatan.total_realisasi">@lang('backend/pengajuan.kegiatan.tables.total_realisasi')</option>
                                    <option value="status.keterangan">@lang('backend/_globals.tables.status')</option>
                                    <option value="status.posisi_dokumen">@lang('backend/_globals.tables.posisi_dok')</option>
                                </select>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($kegiatans->total() > 0)
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('backend/_globals.tables.bagian_id')</th>
                                <th>@lang('backend/_globals.tables.no_pengajuan')</th>
                                <th>@lang('backend/_globals.tables.tgl_pengajuan')</th>
                                <th>@lang('backend/_globals.tables.no_mak')</th>
                                <th>@lang('backend/_globals.tables.nama_kegiatan')</th>
                                <th>@lang('backend/_globals.tables.tgl_kegiatan')</th>
                                <th>@lang('backend/pengajuan.kegiatan.tables.total_realisasi')</th>
                                <th>@lang('backend/_globals.tables.status')</th>
                                <th>@lang('backend/_globals.tables.posisi_dok')</th>
                                <th></th>
                            </tr>
                            @foreach($kegiatans as $key => $kegiatan)
                                @role('user')
                                @if($kegiatan->status->kode_status == 'KG02' || $kegiatan->status->kode_status == 'KG03' )
                                    <tr class="bg-yellow color-palette">
                                @elseif($kegiatan->status->kode_status == 'KG04' || $kegiatan->status->kode_status == 'KG05' )
                                    <tr class="bg-aqua-active color-palette">
                                @elseif($kegiatan->status->kode_status == 'KG06')
                                    <tr class="bg-green color-palette">
                                @endif
                                @endrole
                                    <td>{{ $kegiatan->bagian->nama_bagian }}</td>
                                    <td>{{ $kegiatan->no_pengajuan2 }}</td>
                                    <td>{{ date('d M Y', strtotime($kegiatan->tgl_pengajuan)) }}</td>
                                    <td>{{ $kegiatan->no_mak }}</td>
                                    <td>{{ $kegiatan->nama_kegiatan }}</td>
                                    <td>{{ date('d', strtotime($kegiatan->tgl_awal)) }} s.d {{ date('d M Y', strtotime($kegiatan->tgl_akhir)) }}</td>
                                    <td class="text-right">{{ number_format($kegiatan->total_realisasi ,0, ',', '.') }}</td>
                                        <td>{{ $kegiatan->status->keterangan }}</td>
                                    <td>{{ $kegiatan->status->posisi_dokumen }}</td>
                                    <td class="text-right" width="120px">
                                        <a href="{{ route('pengajuan.kegiatan.draft-kegiatan', $kegiatan->id) }}" class="btn btn-default btn-flat btn-xs" title="@lang('backend/_globals.buttons.show')"><i class="fa fa-eye"></i></a>
                                    @role('user')
                                         @if($kegiatan->status->kode_status == 'KG00' || $kegiatan->status->kode_status == 'KG99' )
                                            <a href="" class="btn btn-default btn-flat btn-xs" data-toggle="modal" data-target="#edit-modal{{ $kegiatan->id }}" title="@lang('backend/_globals.buttons.edit')"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#remove-modal{{ $kegiatan->id }}" ><i class="fa fa-trash"></i> </a>
                                        @endif
                                        <a href="{{ route('pengajuan.kegiatan.nota-dinas', $kegiatan->id) }}" class="btn btn-success btn-flat btn-xs" title="Nota Dinas" target="_blank"><i class="fa fa-print"></i></a>
                                        <a href="{{ route('pengajuan.kegiatan.surat-tugas', $kegiatan->id) }}" class="btn btn-success btn-flat btn-xs" title="Surat Tugas" target="_blank"><i class="fa fa-print"></i></a>
                                    @endrole
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="text-center">
                            <br><br>
                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                            <h4 class="no-margins">@lang('backend/pengajuan.kegiatan.index.is_empty')</h4>
                            <br><br>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        @include('backend._inc.pagination', ['paginator' => $kegiatans])
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

    @foreach($kegiatans as $kegiatan)
        <div class="modal fade" id="remove-modal{{ $kegiatan->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('pengajuan.kegiatan.destroy', $kegiatan->id) }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/pengajuan.submodule.kegiatan')</h4>
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