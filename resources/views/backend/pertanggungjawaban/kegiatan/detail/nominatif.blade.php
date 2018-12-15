<div class="row">
        <div class="col-xs-12">
            {{-- @include('backend._inc.alerts') --}}

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#fullday" data-toggle="tab">Fullday / RDK</a></li>
                  <li><a href="#fullboard" data-toggle="tab">Full Board</a></li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active" id="fullday">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#pesertapusat" data-toggle="tab">Peserta Pusat</a></li>
                                <li><a href="#pesertalocal" data-toggle="tab">Peserta Lokal</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="pesertapusat">    
                                    @include('backend.pertanggungjawaban.kegiatan.detail.fullday.peserta-pusat')
                                </div>
                                <div class="tab-pane" id="pesertalocal">    
                                    @include('backend.pertanggungjawaban.kegiatan.detail.fullday.peserta-local')
                                </div>
                            </div>
                            <div></div>
                        </div>
                    </div>

                    <div class="tab-pane" id="fullboard">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#pesertapusatfb" data-toggle="tab">Peserta Pusat</a></li>
                                <li><a href="#pesertadaerah" data-toggle="tab">Peserta Daerah</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="pesertapusatfb">    
                                    @include('backend.pertanggungjawaban.kegiatan.detail.fullboard.peserta-pusat-fb')
                                </div>

                                <div class="tab-pane" id="pesertadaerah">    
                                    @include('backend.pertanggungjawaban.kegiatan.detail.fullboard.peserta-daerah-fb')
                                </div>
                            </div>
                            <div></div>
                        </div>
                    </div>

                    {{-- @foreach($nominatifs as $nominatif)
                            <div class="modal fade" id="remove-modal{{ $nominatif->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form class="form-horizontal" action="{{ route('nominatif.destroy', $nominatif->id) }}" method="post">
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
                                                <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">@lang('backend/_globals.buttons.cancel')</button>
                                                <button type="submit" class="btn btn-danger btn-sm">@lang('backend/_globals.buttons.yes')</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                         @endforeach --}}

                </div>
            </div>    
            <!-- /.box -->
        </div>
    </div>