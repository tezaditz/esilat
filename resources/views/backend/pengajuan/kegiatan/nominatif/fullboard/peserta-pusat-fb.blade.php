<div class="box">
        <div class="box-header">

            <div class="w3-btn-group">

                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllfbpusat-modal"><i
                        class="fa fa-trash"></i> @lang('backend/_globals.buttons.delete')</a>

                {{--<a href="{{url('excel/nominatif.xlsx')}}" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target=""><i class="fa fa-download"></i> @lang('backend/_globals.buttons.download_template')</a>--}}
                <a href="{{ route('pengajuan.kegiatan.nominatif.nominatif-fullboard', $kegiatan_id) }}" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target=""><i class="fa fa-download"></i> @lang('backend/_globals.buttons.download_template')</a>

                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#import-peserta-pusat-fb"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a>

            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>@lang('backend/nominatif.nominatif.tables.nama_peserta')</th>
                    <th>@lang('backend/nominatif.nominatif.tables.nip')</th>
                    <th>@lang('backend/nominatif.nominatif.tables.instansi')</th>
                    <th>@lang('backend/nominatif.nominatif.tables.gol')</th>
                    <th>@lang('backend/nominatif.nominatif.tables.transport')</th>
                    <th>@lang('backend/nominatif.nominatif.tables.uang_harian')</th>
                    <th>@lang('backend/nominatif.nominatif.tables.penginapan')</th>
                    <th></th>
                </tr>
                @if($nominatifs->count() > 0)
                    @foreach($nominatifs as $nominatif)
                        <tr>
                            <td>{{ $nominatif->nama_peserta }}</td>
                            <td>{{ $nominatif->nip }}</td>
                            <td>{{ $nominatif->instansi }}</td>
                            <td>{{ $nominatif->gol }}</td>
                            <td class="text-right">{{ number_format($nominatif->transport ,0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($nominatif->uang_harian ,0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($nominatif->penginapan ,0, ',', '.') }}</td>
                            <td class="text-right" style="width: 90px">
                                <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#remove-modal{{ $nominatif->id }}" ><i class="fa fa-trash"></i> </a>
                                <a href="{{ route('pengajuan.kegiatan.nominatif.kuitansi-rill', $nominatif->id)}} " class="btn btn-success btn-flat btn-xs" title="@lang('backend/_globals.buttons.cetak_kwi_rill')" target="_blank"><i class="fa fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="bg-gray disabled color-palette"><td colspan="8"></td></tr>
                    <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="8"><i class="fa fa-exclamation-triangle fa-2x"></i></td></tr>
                    <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="8">@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.index.is_empty')</td></tr>
                    <tr class="bg-gray disabled color-palette"><td colspan="8"></td></tr>
                @endif
            </table>

        </div>
        <!-- /.box-body -->
</div>

@foreach($nominatifs as $nominatif)
    <div class="modal fade" id="remove-modal{{ $nominatif->id }}">
    <div class="modal-dialog">
    <div class="modal-content">
        <form class="form-horizontal" action="{{ route('pengajuan.kegiatan.nominatif.destroy', $nominatif->id) }}" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/bagian.module')</h4>
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

<div class="modal fade" id="removeAllfbpusat-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pengajuan.kegiatan.nominatif.nominatifPusat', $kegiatan_id) }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/bagian.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    Ingin menghapus semua data?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('backend/_globals.buttons.yes')</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>