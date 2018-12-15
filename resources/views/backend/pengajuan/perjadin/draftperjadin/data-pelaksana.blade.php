{{-- <a href="#" class="btn bg-light-blue btn-flat btn-sm"><i class="fa fa-download"></i> @lang('backend/_globals.buttons.download_template')</a> --}}
<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>@lang('backend/pengajuan.kegiatan.tables.akun')</th>
        <th>@lang('backend/pengajuan.kegiatan.tables.uraian')</th>
        <th>@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
    </tr>
    </thead>
    <tbody>
        @if($totalperjadinakun > 0)
            @foreach($perjadinakuns as $key => $perjadinakun)
                <tr>
                    <td style="width: 90px">{{ $perjadinakun->kode_11 }}</td>
                    <td>{{ $perjadinakun->uraian }}</td>
                    <td class="text-right" style="width: 110px">{{ number_format($perjadinakun->jumlah_pengajuan ,0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-right"><b>@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</b></td>
                <td class="text-right">Rp. {{ number_format($perjadinakuns->sum('jumlah_pengajuan') ,0, ',', '.') }}</td>
            </tr>
        @else
            <tr class="bg-gray disabled color-palette"><td colspan="3"></td></tr>
            <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="3"><i class="fa fa-exclamation-triangle fa-2x"></i></td></tr>
            <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="3">@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.index.is_empty')</td></tr>
            <tr class="bg-gray disabled color-palette"><td colspan="3"></td></tr>
        @endif
</table>