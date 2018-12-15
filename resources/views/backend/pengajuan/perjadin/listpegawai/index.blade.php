<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 03:35 PM
 */
?>
@extends('backend.pengajuan.perjadin.listpegawai.base')

@section('title', trans('backend/master/pegawai.pegawai.index.title', ['total' => $total]), @parent)


@section('listpegawai-perjadin')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <form action="{{ route('pengajuan.perjadin-dalam-negeri.pilih-pegawai', $perjadin_id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="perjadin_id" value="{{ $perjadin_id }}">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">@yield('title')</h3>

                        <div class="box-tools pull-right">
                            <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>|

                            <button type="button" class="btn btn-default btn-flat btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-default btn-flat btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @if($total > 0)
                            <table class="table table-hover">
                                <tr>
                                    <th>@lang('backend/master/pegawai.tables.nama')</th>
                                    <th>@lang('backend/master/pegawai.tables.nip')</th>
                                    <th>@lang('backend/master/pegawai.tables.jabatan_id')</th>
                                    <th>@lang('backend/master/pegawai.tables.pangkat_id')</th>
                                    <th>@lang('backend/master/pegawai.tables.bagian_id')</th>
                                    <th><input type="checkbox" name="checkAll" id="checkAll" class="checkbox"></th>
                                    <th>Pilih</th>
                                </tr>
                                @foreach($pegawais as $key => $pegawai)
                                    <tr>
                                        <td>{{ $pegawai->nama }}</td>
                                        <td>{{ $pegawai->nip }}</td>
                                        <td>{{ $pegawai->jabatan->name }}</td>
                                        <td>{{ $pegawai->pangkat->nama }}/{{ $pegawai->pangkat->golongan }}</td>
                                        <td>{{ $pegawai->bagian->nama_bagian }}</td>
                                        <td>
                                            <input type="checkbox" name="chk[{{ $pegawai->id }}]" value="{{ $pegawai->id }}" id="chk[{{ $pegawai->id }}]">
                                        </td>
                                        <td>
                                            <select class="form-control input-sm" id="sel[{{ $pegawai->id }}]" name="sel[{{ $pegawai->id }}]" style="display: none">
                                                @for($i = 1; $i <= $dt; $i++)
                                                    <option value="{{ $i }}"> {{ $i }} </option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th class="text-right" colspan="5">Jumlah yang di pilih:</th>
                                    <th colspan="2">
                                        <input type="text" class="form-control input-sm" style="width: 80px" name="jumlah" id="jumlah" placeholder="0" readonly>
                                    </th>
                                </tr>
                            </table>
                        @else
                            <div class="text-center">
                                <br><br>
                                <i class="fa fa-exclamation-triangle fa-2x"></i>
                                <h4 class="no-margins">@lang('backend/master/pegawai.pegawai.index.is_empty')</h4>
                                <br><br>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="{{ route('pengajuan.perjadin-dalam-negeri.detail-pelaksana', $perjadin_id) }}" type="button" class="btn btn-flat btn-danger btn-sm pull-left"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.back')</a>
                        <button type="submit" class="btn bg-light-blue btn-flat btn-sm pull-right"><i class="fa fa-check"></i> @lang('backend/_globals.buttons.choose')</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection

@section('javascript')
    @parent

    <script>
        $(document).ready(function () {
            @foreach($pegawais as $key => $pegawai)
                $('[name="checkAll"]').click(function(){
                    $('[name="chk[{{ $pegawai->id }}]"]').prop("checked", $(this).prop("checked"));

                    if ($(this).is(":checked")) {
                        $('[name="sel[{{ $pegawai->id }}]"]').show();
                    } else {
                        $('[name="sel[{{ $pegawai->id }}]"]').hide();
                    }

                    $('[name="jumlah"]').val($('tr td input[type="checkbox"]').filter(':checked').length);
                });

                $('[name="chk[{{ $pegawai->id }}]"]').change(function () {
                    if ($(this).is(":checked")) {
                        $('[name="sel[{{ $pegawai->id }}]"]').show();
                    } else {
                        $('[name="sel[{{ $pegawai->id }}]"]').hide();
                    }

                    $('[name="jumlah"]').val($('tr td input[type="checkbox"]').filter(':checked').length);
                });
            @endforeach
        });
    </script>
@stop