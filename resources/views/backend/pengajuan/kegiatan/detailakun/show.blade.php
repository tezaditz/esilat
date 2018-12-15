<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/27/2017
 * Time: 03:35 PM
 */
?>
@foreach($d_akuns as $d_akun)
    <div class="modal fade" id="show-modal{{ $d_akun->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.show') @lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.akun')</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <tr>
                            <th>@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.uraian')</th>
                            <th>@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.vol')</th>
                            <th>@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.hrgsat')</th>
                            <th>@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.jumlah')</th>
                        </tr>
                        @foreach($detailkegiatans->where('akun', $d_akun->akun) as $key => $detailkegiatan)
                            <tr>
                                <td>{{ $detailkegiatan->uraian }}</td>
                                <td style="width: 50px">{{ $detailkegiatan->vol1 * $detailkegiatan->vol2 }} {{ $detailkegiatan->satuan }}</td>
                                <td class="text-right" style="width: 90px">{{ number_format($detailkegiatan->hrgsat, 0, ',', '.') }}</td>
                                <td class="text-right" style="width: 90px">{{ number_format($detailkegiatan->jml_rph, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th class="text-right" colspan="3">@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
                            <th class="text-right">{{ number_format($d_akun->jumlah, 0, ',', '.') }}</th>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endforeach