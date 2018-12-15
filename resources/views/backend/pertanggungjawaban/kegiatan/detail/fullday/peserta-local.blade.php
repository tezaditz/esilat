<div class="box box">
        <div class="box-header">

            <div class="w3-btn-group">

            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-peserta-local"><i class="fa fa-trash"></i> @lang('backend/_globals.buttons.delete')</a>

                 <a href="{{url('excel/nominatif_fullday.xlsx')}}" class="btn bg-light-blue btn-sm" data-toggle="modal" data-target=""><i
                        class="fa fa-download"></i> @lang('backend/_globals.buttons.download_template')</a>

                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#import-peserta-local"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a>

            </div>

             <div class="box-tools pull-right">

                <a href="{{ route('pertanggungjawaban.kegiatan.detail',[@$kegiatan->id]) }} " class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> </a>
                
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
                @if($nominatif_fullday_lokals->count() > 0)
                    @foreach($nominatif_fullday_lokals as $nominatif_fullday_lokal)
                        <tr>
                            <td>{{ $nominatif_fullday_lokal->nama_peserta }}</td>
                            <td>{{ $nominatif_fullday_lokal->nip }}</td>
                            <td>{{ $nominatif_fullday_lokal->instansi }}</td>
                            <td>{{ $nominatif_fullday_lokal->gol }}</td>
                            <td class="text-right">{{ number_format($nominatif_fullday_lokal->transport ,0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($nominatif_fullday_lokal->uang_harian ,0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($nominatif_fullday_lokal->penginapan ,0, ',', '.') }}</td>
                            <td class="text-right" style="width: 90px">
                                <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#remove-modal{{ $nominatif_fullday_lokal->id }}" ><i class="fa fa-trash"></i> </a>
                                <a href="{{ route('pengajuan.kegiatan.nominatif.kuitansi-rill', $nominatif_fullday_lokal->id)}} " class="btn btn-success btn-flat btn-xs" title="@lang('backend/_globals.buttons.cetak_kwi_rill')" target="_blank"><i class="fa fa-print"></i></a>
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

@foreach($nominatif_fullday_lokals as $nominatif_fullday_lokal)
    <div class="modal fade" id="remove-modal{{ $nominatif_fullday_lokal->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('pertanggungjawaban.kegiatan.hapus_nominatif', $nominatif_fullday_lokal->id) }}" method="post">
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