<table class="table table-hover">
    <tr>
        <th>@lang('backend/nominatif.nominatif.tables.nama_peserta')</th>
        <th>@lang('backend/nominatif.nominatif.tables.nip')</th>
        <th>@lang('backend/nominatif.nominatif.tables.gol')</th>
        <th>@lang('backend/nominatif.nominatif.tables.instansi')</th>
        <th>@lang('backend/nominatif.nominatif.tables.tiket_pesawat')</th>
        <th>@lang('backend/nominatif.nominatif.tables.transport')</th>
        <th>@lang('backend/nominatif.nominatif.tables.uang_harian')</th>
        <th>@lang('backend/nominatif.nominatif.tables.penginapan')</th>
        <th>@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
    </tr>
    @if($nominatifs->count() > 0)
        @foreach($nominatifs as $nominatif)
            <tr>
                <td>{{ $nominatif->nama_peserta }}</td>
                <td>{{ $nominatif->nip }}</td>
                <td>{{ $nominatif->gol }}</td>
                <td>{{ $nominatif->instansi }}</td>
                <td class="text-right">{{ number_format($nominatif->tiket_pesawat ,0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($nominatif->transport ,0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($nominatif->uang_harian ,0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($nominatif->penginapan ,0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($nominatif->tiket_pesawat + $nominatif->transport + $nominatif->uang_harian + $nominatif->penginapan ,0, ',', '.') }}</td>
            </tr>
        @endforeach
    @else
        <tr class="bg-gray disabled color-palette"><td colspan="9"></td></tr>
        <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="9"><i class="fa fa-exclamation-triangle fa-2x"></i></td></tr>
        <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="9">@lang('backend/nominatif.nominatif.index.is_empty')</td></tr>
        <tr class="bg-gray disabled color-palette"><td colspan="9"></td></tr>
    @endif
    <tr>
        <th colspan="4" class="text-right">@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
        <th class="text-right">
            Rp. {{ number_format($nominatifs->sum('tiket_pesawat') ,0, ',', '.') }}
        </th>
        <th class="text-right">
            Rp. {{ number_format($nominatifs->sum('transport') ,0, ',', '.') }}
        </th>
        <th class="text-right">
            Rp. {{ number_format($nominatifs->sum('uang_harian') ,0, ',', '.') }}
        </th>
        <th class="text-right">
            Rp. {{ number_format($nominatifs->sum('penginapan') ,0, ',', '.') }}
        </th>
        <th class="text-right">
            Rp. {{ number_format($nominatifs->sum('tiket_pesawat') + $nominatifs->sum('transport') + $nominatifs->sum('uang_harian') + $nominatifs->sum('penginapan') ,0, ',', '.' ) }}
        </th>
    </tr>
</table>