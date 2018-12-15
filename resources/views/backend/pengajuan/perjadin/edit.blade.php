<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/05/2017
 * Time: 10:32 AM
 */
?>
@foreach($perjadins as $perjadin)
    <div class="modal fade  " id="edit-modal{{ $perjadin->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('pengajuan.perjadin-dalam-negeri.update', $perjadin->id) }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('backend/_globals.buttons.edit') @lang('backend/pertanggungjawaban.submodule.perjadin')</h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="bagian_id" class="col-sm-2 control-label">@lang('backend/_globals.tables.bagian_id')</label>
                            <div class="col-sm-10 {{ $errors->has('bagian_id') ? 'has-error' : '' }}">
                                <div class="input-group input-group-sm">
                                    <input type="hidden" value={{ $bagians->id }} name="bagian_id">
                                    <input type="text" class="form-control" id="bagian_id" placeholder="Subdirektorat Obat dan Pangan" value="{{ $bagians->nama_bagian }}" readonly>
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
                            <label for="no_mak" class="col-sm-2 control-label">@lang('backend/_globals.tables.no_mak')</label>
                            <div class="col-sm-10 {{ $errors->has('no_mak') ? 'has-error' : '' }}">
                                <select name="no_mak" class="form-control select2" id="no_mak" style="width: 100%;" required>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_mak" class="col-sm-2 control-label">@lang('backend/_globals.tables.subkomponen')</label>
                            <div class="col-sm-10 {{ $errors->has('no_mak') ? 'has-error' : '' }}">
                                <select name="no_mak" class="form-control select2" id="no_mak" style="width: 100%;" required disabled>
                                    <option value="{{ $perjadin->no_mak }}" selected>{{ $perjadin->nama_kegiatan }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_surat_tugas" class="col-sm-2 control-label"><th>@lang('backend/pertanggungjawaban.perjadin.tables.no_surat_tugas')</th></label>
                            <div class="col-sm-10 {{ $errors->has('no_surat_tugas') ? 'has-error' : '' }}">
                                <input type="text" name="no_surat_tugas" class="form-control" id="no_surat_tugas" placeholder="FP.03.04/03/0338/2017" value="{{ $perjadin->no_surat_tugas }}" required>
                                @if($errors->has('no_surat_tugas'))
                                    <span class="help-block">
                                        {{ $errors->first('no_surat_tugas') }}
                                    </span>
                                @endif
                            </div>
                         </div>

                        <div class="form-group">
                            <label for="tgl_surat_tugas" class="col-sm-2 control-label">@lang('backend/pertanggungjawaban.perjadin.tables.tgl_surat_tugas')</label>
                            <div class="col-sm-5 {{ $errors->has('tgl_surat_tugas') ? 'has-error' : '' }}">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="tgl_surat_tugas" class="form-control pull-right" id="tgl_surat_tugas" value="{{ $perjadin->tgl_surat_tugas }}" required>
                                </div>
                                @if($errors->has('tgl_surat_tugas'))
                                    <span class="help-block">
                                        {{ $errors->first('tgl_surat_tugas') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tgl_awal" class="col-sm-2 control-label">@lang('backend/_globals.tables.tgl_awal')</label>
                            <div class="col-sm-5 {{ $errors->has('tgl_awal') ? 'has-error' : '' }}">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="tgl_awal" class="form-control pull-right" id="tgl_awal" value="{{ $perjadin->tgl_awal }}" required>
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
                                    <input type="text" name="tgl_akhir" class="form-control pull-right" id="tgl_akhir" value="{{ $perjadin->tgl_akhir }}" required>
                                </div>
                                @if($errors->has('tgl_akhir'))
                                    <span class="help-block">
                                    {{ $errors->first('tgl_akhir') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="provinsi_id" class="col-sm-2 control-label">@lang('backend/pengajuan.kegiatan.tables.provinsi')</label>
                            <div class="col-sm-10 {{ $errors->has('provinsi_id') ? 'has-error' : '' }}">
                                @if($provinsis->count() > 0)
                                    <div class="input-group input-group-sm">
                                        <select name="provinsi_id" class="form-control select2 provinsi_id" id="provinsi_id" style="width: 100%;">
                                            @foreach($provinsis as $key => $provinsi)
                                                <option value="{{ $provinsi->id }}" {{ $provinsi->id == $perjadin->provinsi_id ? 'selected' : '' }}>{{ $provinsi->title }}</option>
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

                        <div class="form-group">
                            <label for="kabkota" class="col-sm-2 control-label">@lang('backend/_globals.tables.kabkota_id')</label>
                            <div class="col-sm-10 {{ $errors->has('kabkota') ? 'has-error' : '' }}">
                                @if($kotas->count() > 0)
                                    <div class="input-group input-group-sm">
                                        <select name="kabkota" class="form-control select2 kabkota" id="kabkota" style="width: 100%;">
                                            @foreach($kotas as $key => $kota)
                                                <option value="{{ $kota->id }}" {{ $kota->id == $perjadin->kabkota_id ? 'selected' : '' }}>{{ $kota->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <a href="{{ route('master.provinsi.index') }}" class="btn btn-flat"><i class="fa fa-plus"></i></a>
                                        </span>
                                    </div>
                                    @if($errors->has('kabkota'))
                                        <span class="help-block">
                                        {{ $errors->first('kabkota') }}
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
                        <button type="submit" class="btn bg-light-blue btn-sm"><i class="fa fa-save"></i> @lang('backend/_globals.buttons.save')</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endforeach
