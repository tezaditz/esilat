<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 09:04 PM
 */
?>
@foreach($hotels as $hotel)
    <div class="modal fade" id="edit-modal{{ $hotel->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('master.hotel.update', $hotel->id) }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.edit') @lang('backend/master/hotel.module')</h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="nama_hotel" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.nama_hotel')</label>
                            <div class="col-sm-9 {{ $errors->has('nama_hotel') ? 'has-error' : '' }}">
                                <input type="text" name="nama_hotel" class="form-control" id="nama_hotel" placeholder="Hotel Rancamaya" value="{{ $hotel->nama_hotel }}" required>
                                @if($errors->has('nama_hotel'))
                                    <span class="help-block">
                                    {{ $errors->first('nama_hotel') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_perusahaan" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.nama_perusahaan')</label>
                            <div class="col-sm-9 {{ $errors->has('nama_perusahaan') ? 'has-error' : '' }}">
                                <input type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan" placeholder="PT Natural Adev Indonesia" value="{{ $hotel->nama_perusahaan }}" required>
                                @if($errors->has('nama_perusahaan'))
                                    <span class="help-block">
                                    {{ $errors->first('nama_perusahaan') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ktp" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.ktp')</label>
                            <div class="col-sm-9 {{ $errors->has('ktp') ? 'has-error' : '' }}">
                                <input type="text" name="ktp" class="form-control" id="ktp" placeholder="3671081708920004" value="{{ $hotel->ktp }}" required>
                                @if($errors->has('ktp'))
                                    <span class="help-block">
                                    {{ $errors->first('ktp') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="npwp" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.npwp')</label>
                            <div class="col-sm-9 {{ $errors->has('npwp') ? 'has-error' : '' }}">
                                <input type="text" name="npwp" class="form-control" id="npwp" placeholder="01.855.081.4-412.000" value="{{ $hotel->npwp }}" required>
                                @if($errors->has('npwp'))
                                    <span class="help-block">
                                    {{ $errors->first('npwp') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_bank" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.nama_bank')</label>
                            <div class="col-sm-9 {{ $errors->has('nama_bank') ? 'has-error' : '' }}">
                                <input type="text" name="nama_bank" class="form-control" id="nama_bank" placeholder="Bank BRI" value="{{ $hotel->nama_bank }}" required>
                                @if($errors->has('nama_bank'))
                                    <span class="help-block">
                                    {{ $errors->first('nama_bank') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_rekening" class="col-sm-3 control-label">@lang('backend/master/hotel.tables.no_rekening')</label>
                            <div class="col-sm-9 {{ $errors->has('no_rekening') ? 'has-error' : '' }}">
                                <input type="text" name="no_rekening" class="form-control" id="no_rekening" placeholder="71910100191****" value="{{ $hotel->no_rekening }}" required>
                                @if($errors->has('no_rekening'))
                                    <span class="help-block">
                                    {{ $errors->first('no_rekening') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">@lang('backend/_globals.buttons.cancel')</button>
                        <button type="submit" class="btn bg-light-blue btn-sm">@lang('backend/_globals.buttons.save')</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endforeach


