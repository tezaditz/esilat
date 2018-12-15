@if($totaldataperjadin > 0)
    <table class="table table-hover table-bordered">
        <tr>
            <th>@lang('backend/_globals.tables.nama_pelaksana')</th>
            <th>@lang('backend/_globals.tables.nip')</th>
            <th>@lang('backend/_globals.tables.uang_harian')</th>
            <th>@lang('backend/_globals.tables.transport')</th>
            <th>@lang('backend/_globals.tables.pesawat')</th>
            <th>@lang('backend/_globals.tables.penginapan')</th>
            <th>@lang('backend/_globals.tables.total')</th>
        </tr>
        @foreach($dataperjadins as $key => $dataperjadin)
            <tr>
                <td>{{ $dataperjadin->nama_pelaksana }}</td>
                <td>{{ $dataperjadin->nip }}</td>
                <td class="text-right">{{ number_format($dataperjadin->uang_harian ,0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($dataperjadin->taksi_provinsi + $dataperjadin->taksi_kab_kota ,0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($dataperjadin->pesawat ,0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($dataperjadin->penginapan ,0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(($dataperjadin->uang_harian + $dataperjadin->taksi_provinsi + $dataperjadin->taksi_kab_kota + $dataperjadin->pesawat + $dataperjadin->penginapan) ,0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <th class="text-right" colspan="2">@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
            <th class="text-right">{{ number_format($dataperjadins->sum('uang_harian') ,0, ',', '.') }}</th>
            <th class="text-right">{{ number_format($dataperjadins->sum('taksi_provinsi') + $dataperjadins->sum('taksi_kab_kota') ,0, ',', '.') }}</th>
            <th class="text-right">{{ number_format($dataperjadins->sum('pesawat') ,0, ',', '.') }}</th>
            <th class="text-right">{{ number_format($dataperjadins->sum('penginapan') ,0, ',', '.') }}</th>
            <th class="text-right">{{ number_format($dataperjadins->sum('uang_harian') + $dataperjadins->sum('taksi_provinsi') + $dataperjadins->sum('taksi_kab_kota') + $dataperjadins->sum('pesawat') + $dataperjadins->sum('penginapan') ,0, ',', '.') }}</th>
        </tr>
    </table>
@else
    <div class="text-center">
        <br><br>
        <i class="fa fa-exclamation-triangle fa-2x"></i>
        <h4 class="no-margins">@lang('backend/pertanggungjawaban.perjadin.submodule.detail_akun.index.is_empty')</h4>
        <br><br>
    </div>
@endif