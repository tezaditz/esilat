<table class="table table-hover">
    <tr>
        <th>@lang('backend/master/pegawai.tables.nama')</th>
        <th>@lang('backend/master/pegawai.tables.nip')</th>
        <th style="width: 120px;"></th>
    </tr>
    @if($jadwals->count() > 0)
        @foreach($jadwals as $key => $jadwal)
            <tr>
                <td>{{ $jadwal->pegawai->nama }}</td>
                <td>{{ $jadwal->pegawai->nip }}</td>
                <td class="text-right">
                    <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#remove-modal{{ $jadwal->id }}" ><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    @else
        <tr class="bg-gray disabled color-palette"><td colspan="9"></td></tr>
        <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="9"><i class="fa fa-exclamation-triangle fa-2x"></i></td></tr>
        <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="9">@lang('backend/master/pegawai.pegawai.index.is_empty')</td></tr>
        <tr class="bg-gray disabled color-palette"><td colspan="9"></td></tr>
    @endif
</table>

@foreach($jadwals as $jadwal)
    <div class="modal fade" id="remove-modal{{ $jadwal->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('pengajuan.kegiatan.draft-kegiatan.pegawai.destroy', [$jadwal->kegiatan_id, $jadwal->id]) }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/pegawai.module')</h4>
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