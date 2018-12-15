<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 10:08 PM
 */
?>
@foreach($hotels as $hotel)
    <div class="modal fade" id="show-modal{{ $hotel->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.view') @lang('backend/master/hotel.module')</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nama_hotel" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.nama_hotel')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="nama_hotel" class="form-control" id="nama_hotel" placeholder="Hotel Rancamaya" value="{{ $hotel->nama_hotel }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_perusahaan" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.nama_perusahaan')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan" placeholder="PT Natural Adev Indonesia" value="{{ $hotel->nama_perusahaan }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ktp" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.ktp')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="ktp" class="form-control" id="ktp" placeholder="3671081708920004" value="{{ $hotel->ktp }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="npwp" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.npwp')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="npwp" class="form-control" id="npwp" placeholder="01.855.081.4-412.000" value="{{ $hotel->npwp }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_bank" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.nama_bank')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="nama_bank" class="form-control" id="nama_bank" placeholder="Bank BRI" value="{{ $hotel->nama_bank }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_rekening" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.no_rekening')</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="no_rekening" class="form-control" id="no_rekening" placeholder="71910100191****" value="{{ $hotel->no_rekening }}">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endforeach
