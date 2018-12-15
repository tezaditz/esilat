<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 01:25 PM
 */
?>
<div class="modal fade" id="create-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pengajuan.kegiatan.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/pengajuan.submodule.kegiatan')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="bagian_id" class="col-sm-2 control-label">@lang('backend/_globals.tables.bagian_id')</label>
                        <div class="col-sm-10 {{ $errors->has('bagian_id') ? 'has-error' : '' }}">
                            <div class="input-group input-group-sm">
                                <input type="hidden" value={{ $bagian->id }} name="bagian_id">
                                <input type="text" name="display_name" class="form-control" id="display_name" placeholder="Subdirektorat Obat dan Pangan" value="{{ $bagian->nama_bagian }}" readonly>
                                <span class="input-group-btn">
                                    <a href="{{ route('master.bagian.index') }}" class="btn  btn-flat"><i class="fa fa-plus"></i></a>
                                </span>
                            </div>
                            @if($errors->has('bagian_id'))
                                <span class="help-block">
                                    {{ $errors->first('bagian_id') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="judul" class="col-sm-2 control-label">@lang('backend/_globals.tables.nama_kegiatan')</label>
                        <div class="col-sm-10 {{ $errors->has('judul') ? 'has-error' : '' }}">
                            @if(Count($rkakls) > 0)
                                <div class="input-group input-group-sm">
                                    <select name="judul" class="form-control select2" id="judul" style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach($rkakls as $key => $rkakl)
                                            <option value="{{ $rkakl->no_mak }}">{{ $rkakl->no_mak }} - {{ $rkakl->uraian }} - {{ number_format($rkakl->jumlah - $rkakl->realisasi, 0, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.rkakl.index') }}" class="btn  btn-flat"><i class="fa fa-upload"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('judul'))
                                    <span class="help-block">
                                    {{ $errors->first('judul') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.rkakl.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.rpd.is_empty')
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_mak" class="col-sm-2 control-label">@lang('backend/_globals.tables.no_mak')</label>
                        <div class="col-sm-10 {{ $errors->has('no_mak') ? 'has-error' : '' }}">
                            <select name="no_mak" class="form-control select2" id="no_mak" style="width: 100%;" required>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_kegiatan" class="col-sm-2 control-label">@lang('backend/_globals.tables.subkomponen')</label>
                        <div class="col-sm-10 {{ $errors->has('nama_kegiatan') ? 'has-error' : '' }}">
                            <input type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan" placeholder="Memfasilitasi Pengembangan Obat dan Bahan Baku Sediaan Farmasi Dalam Negeri" required readonly>
                            @if($errors->has('nama_kegiatan'))
                                <span class="help-block">
                                    {{ $errors->first('nama_kegiatan') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="hotel_id" class="col-sm-2 control-label">@lang('backend/_globals.tables.hotel_id')</label>
                        <div class="col-sm-10 {{ $errors->has('hotel_id') ? 'has-error' : '' }}">
                            @if($hotels->count() > 0)
                                <div class="input-group input-group-sm">
                                    <select name="hotel_id" class="form-control select2" id="hotel_id" style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach($hotels as $key => $hotel)
                                            <option value="{{ $hotel->id }}">{{ $hotel->nama_hotel }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.hotel.index') }}" class="btn btn-flat"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('hotel_id'))
                                    <span class="help-block">
                                    {{ $errors->first('hotel_id') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.hotel.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a> @lang('backend/master/hotel.hotel.index.is_empty')
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgl_awal" class="col-sm-2 control-label">@lang('backend/_globals.tables.tgl_awal')</label>
                        <div class="col-sm-5 {{ $errors->has('tgl_awal') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tgl_awal" class="form-control pull-right" id="tgl_awal" required>
                            </div>
                            @if($errors->has('tgl_awal'))
                                <span class="help-block">
                                    {{ $errors->first('tgl_awal') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgl_akhir" class="col-sm-2 control-label">@lang('backend/_globals.tables.tgl_akhir')</label>
                        <div class="col-sm-5 {{ $errors->has('tgl_akhir') ? 'has-error' : '' }}">
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="tgl_akhir" class="form-control pull-right" id="tgl_akhir" required>
                            </div>
                            @if($errors->has('tgl_akhir'))
                                <span class="help-block">
                                    {{ $errors->first('tgl_akhir') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="provinsi_id" class="col-sm-2 control-label">@lang('backend/_globals.tables.provinsi_id')</label>
                        <div class="col-sm-10 {{ $errors->has('provinsi_id') ? 'has-error' : '' }}">
                            @if($provinsis->count() > 0)
                                <div class="input-group input-group-sm">
                                    <select name="provinsi_id" class="form-control select2" id="provinsi_id" style="width: 100%;">
                                        @foreach($provinsis as $key => $provinsi)
                                            <option value="{{ $provinsi->id }}">{{ $provinsi->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="{{ route('master.provinsi.index') }}" class="btn btn-flat"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                                @if($errors->has('provinsi_id'))
                                    <span class="help-block">
                                    {{ $errors->first('provinsi_id') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.provinsi.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</a> @lang('backend/master/provinsi.provinsi.index.is_empty')
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit" class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>