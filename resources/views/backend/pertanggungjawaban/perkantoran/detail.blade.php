<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/12/2017
 * Time: 03:24 PM
 */
?>
@extends('backend.pertanggungjawaban.perkantoran.base')

@section('title', 'Draft Layanan Perkantoran', @parent)

@section('perkantoran')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#tab_1-2" data-toggle="tab">Detail Pengajuan</a></li>
                    <li class="active"><a href="#tab_1-3" data-toggle="tab">Data Layanan Perkantoran</a></li>
                    <li class="pull-left header"><i class="fa fa-file-text-o"></i> @yield('title')</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-3">
                        @include('backend.pertanggungjawaban.perkantoran.detail.data-perkantoran')
                    </div>
                    <div class="tab-pane" id="tab_1-2">
                        @include('backend.pertanggungjawaban.perkantoran.detail.data-pengajuan')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="keterangan"]').change(function () {
                if ($('[name="keterangan"]').val() == 'PK11') {
                    $('[name="alasan"]').prop('disabled', false);
                } else {
                    $('[name="alasan"]').prop('disabled', true);
                }
            });
        });
    </script>
@stop