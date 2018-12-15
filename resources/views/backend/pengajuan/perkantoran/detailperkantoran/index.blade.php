<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:14 AM
 */
?>
@extends('backend.pengajuan.perkantoran.detailperkantoran.base')

@section('title', trans('backend/perkantoran.submodule.draft_perkantoran'),  @parent)

@section('detail-perkantoran')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="pull-right box-tools">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>|


                        <button type="button" class="btn btn-default btn-flat btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-default btn-flat btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>

                </div>
                <form action="{{ route('pengajuan.layanan-perkantoran.detail-perkantoran.store', $id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered" style="white-space: nowrap" id="table">
                            <tr>
                                <th>@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.no_mak')</th>
                                <th>@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.uraian')</th>
                                <th>@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.jumlah_pagu')</th>
                                <th>@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.sisa_pagu')</th>
                                <th>@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.total_pengajuan')</th>
                                <th>@lang('backend/perkantoran.perkantoran.submodule.draft_perkantoran.tables.sisa_anggaran')</th>
                            </tr>
                            @foreach($rkakls as $key => $rkakl)
                            <tr>
                                <td>{{ $rkakl->kode }}</td>
                                <td>{{ $rkakl->uraian }}</td>
                                <td class="text-right" style="width: 140px;">{{ number_format($rkakl->jumlah, 0, ',', '.') }}</td>
                                <td class="text-right" style="width: 140px;">{{ number_format($rkakl->jumlah - ($rkakl->realisasi_2 + $rkakl->realisasi_3), 0, ',', '.') }}</td>
                                @if($rkakl->level == 0)
                                    @if($rkakl->header == 0)
                                        <td style="width: 120px;">
                                            <input class="form-control input-sm total" style="text-align: right; width: 120px;" id="total{{ $rkakl->id }}" name="total[{{ $rkakl->id }}]" placeholder="0" type="text">
                                            <input type="hidden" name="rkakl_id[{{ $rkakl->id }}]" value="{{ $rkakl->id }}">
                                        </td>
                                        <td style="width: 120px;">
                                            <input class="form-control input-sm" style="text-align: right; width: 120px;" id="sisa{{ $rkakl->id }}" name="sisa[{{ $rkakl->id }}]" value="{{ number_format($rkakl->jumlah - ($rkakl->realisasi_2 + $rkakl->realisasi_3), 0, ',', '.') }}" type="text" readonly>
                                        </td>
                                    @endif
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <th class="text-right" colspan="4">@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
                                <th colspan="2">
                                    <input class="form-control input-sm" style="text-align: right;" id="total_pengajuan" name="total_pengajuan" placeholder="0" type="text" readonly>
                                </th>
                            </tr>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <input type="hidden" name="perkantoran_id" value="{{ $id }}">

                        <button type="submit" class='btn btn-success btn-flat btn-sm pull-right'>@lang('backend/_globals.buttons.next') <i class="fa fa-arrow-right"></i></button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function () {
            @foreach($rkakls as $key => $rkakl)
            $('#total{{ $rkakl->id }}').keyup(function () {
                if (/\D/g.test(this.value)) {
                    this.value = this.value.replace(/\D/g, '');
                }

                var total_pengajuan = 0;
                $('.total').each(function () {
                    total_pengajuan += parseFloat($(this).val().replace(/\./g, '')) || 0;
                });

                $('#total{{ $rkakl->id }}').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                $('#total_pengajuan').val(total_pengajuan.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                if ($('#total{{ $rkakl->id }}').val().replace(/\./g, '') < 0 || $('#total{{ $rkakl->id }}').val().replace(/\./g, '') > {{ $rkakl->jumlah - ($rkakl->realisasi_2 + $rkakl->realisasi_3) }}) {
                    alert('Pengajuan tidak sesuai.');
                    $('#total{{ $rkakl->id }}').val('0');
                }

                var total = parseFloat($(this).val().replace(/\./g, ''));
                var sisa = parseFloat($(this).val());
                sisa = (sisa ? ({{ $rkakl->jumlah - ($rkakl->realisasi_2 + $rkakl->realisasi_3) }}) - total : "{{ number_format($rkakl->jumlah, 0) }}");

                $('#sisa{{ $rkakl->id }}').val(sisa.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            });
            @endforeach
        });
    </script>
@stop