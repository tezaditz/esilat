<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 11:20 AM
 */
?>
@extends('backend.dashboard.base')

@section('title', trans('backend/dashboard.module'), @parent)

@section('stylesheet')
    @parent

@show
@section('style')

@endsection
@section('dashboard')

    <div class="row">
        <div class="col-xs-12">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Eselon 1</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @include('backend.dashboard.sas.eselon_tab')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
<script type="text/javascript">

        $.getJSON('{{ url("/keuangan/sas/dashboard/sas/realisasi") }}', function (result) {

            console.log(result['pagu']);

            var myChart = Highcharts.chart('container', {
                   chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'REALISASI'
                    },
                    tooltip: {
                        pointFormat: ''
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                connectorColor: 'silver'
                            }
                        }
                    },
                    series: [{
                        name: 'Share',
                        data: [
                            { name: 'Pagu', y: result['pagu'] },
                            { name: 'Realisasi', y: result['realisasi'] }
                        ]
                    }]
                });
        });

        $.getJSON('{{ url("/keuangan/sas/dashboard/sas/jnsbel") }}', function (result) {

            console.log(result[0]);
            var dataPagu = [] , dataRealisasi = [] , dataCategori = [];
            for (var i = 0; i < result.length; i++) {

                var nilai = parseFloat(result[i].realisasi);
                var pagu = parseFloat(result[i].pagu);

                dataPagu.push(result[i].pagu);
                dataRealisasi.push(result[i].realisasi);
                dataCategori.push(result[i].desc_jenis_belanja);
                
            }

            console.log(pagu);

            Highcharts.chart('realisasi_belanja', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Belanja'
                },
                xAxis: {
                    categories: dataCategori,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Pagu',
                    data: dataPagu

                }, {
                    name: 'Realisasi',
                    data: dataRealisasi

                }]
            });
        });

    
</script>
@stop