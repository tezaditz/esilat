<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/05/2017
 * Time: 01:33 PM
 */
?>

<div class="modal fade" id="hapus-peserta-pusat">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pertanggungjawaban.kegiatan.destroy_nominatif') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/bagian.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                        <input type="hidden" name="flag" value="2">
                        <input type="hidden" name="peserta" value="1">
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id}}">
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

<div class="modal fade" id="hapus-peserta-local">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pertanggungjawaban.kegiatan.destroy_nominatif') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/bagian.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                        <input type="hidden" name="flag" value="2">
                        <input type="hidden" name="peserta" value="2">
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id}}">
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

<div class="modal fade" id="hapus-peserta-pusat-fb">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pertanggungjawaban.kegiatan.destroy_nominatif') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/bagian.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                        <input type="hidden" name="flag" value="1">
                        <input type="hidden" name="peserta" value="1">
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id}}">
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

<div class="modal fade" id="hapus-peserta-local-fb">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('pertanggungjawaban.kegiatan.destroy_nominatif') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.delete') @lang('backend/master/bagian.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                        <input type="hidden" name="flag" value="1">
                        <input type="hidden" name="peserta" value="2">
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id}}">
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