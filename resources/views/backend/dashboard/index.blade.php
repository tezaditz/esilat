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

@section('dashboard')
<style type="text/css">
    .chart-legend li span{
    display: inline-block;
    width: 12px;
    height: 12px;
    margin-right: 5px;
}
</style>
    <div class="row">
        <div class="col-xs-12">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Eselon 1</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Setditjen</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Dit. Oblik</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Dit. Yanfar</a></li>
                    <li><a href="#tab_5" data-toggle="tab">Dit. ProdisFM</a></li>
                    <li><a href="#tab_6" data-toggle="tab">Dit. Penalkes</a></li>
                    <li><a href="#tab_7" data-toggle="tab">Dit. Wasalkes</a></li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @include('backend.dashboard.eselon_tab')
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        @include('backend.dashboard.sesditjen_tab')
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        @include('backend.dashboard.oblik_tab')
                    </div>
                    <div class="tab-pane" id="tab_4">
                        @include('backend.dashboard.yanfar_tab')
                    </div>
                    <div class="tab-pane" id="tab_5">
                        @include('backend.dashboard.fm_tab')
                    </div>
                    <div class="tab-pane" id="tab_6">
                        @include('backend.dashboard.penalkes_tab')
                    </div>
                    <div class="tab-pane" id="tab_7">
                        @include('backend.dashboard.wasalkes_tab')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent

    <script>

        $.getJSON('{{ url("/getPaguAnggaran") }}', function (result) {

            console.log(result.length);

            for (var i = 0; i < result.length; i++) {

                var nilai = parseFloat(result[i].realisasi);
                var pagu = parseFloat(result[i].alokasi);
                var percent = (nilai / pagu ) * 0.1;
                
                $('#tbl_pagu_anggaran').append('<tr><td>'+ result[i].kode+'</td><td>'+ result[i].nama +'</td><td class="text-right">'+ result[i].alokasi.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</td><td class="text-right">'+ result[i].realisasi.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</td><td class="text-right">'+ percent.toFixed(2) +'</td></tr>');
            }
        });

        // Untuk Menampilkan jumlah di Pagu Anggaran
        $.getJSON('{{ url("/getjum") }}', function (result){
            console.log(result.length);

            for (var o = 0; o < result.length; o++ ){

                var jumalo          = parseFloat(result[o].jumalokasi);
                var jumrealisasi    = parseFloat(result[o].jumreal);
                var jumpercent         = (jumalo / jumrealisasi ) * 0.1;

                $('#tbl_pagu_anggaran').append('<tr><td colspan="2" class="text-center"><b>Jumlah</b></td><td class="text-right"><b>'+ result[o].jumalokasi.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</b></td><td class="text-right"><b>'+ result[o].jumreal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</b></td><td class="text-right"></td></tr>');
            }
        // End

        });

        $.getJSON('{{ url("/getpie") }}', function (result) {

            // console.log(result['pagu']);
            var data1 = [] , data2 = [] , data3 =[];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            // var ctx = $("#mycanvas").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(nilaiAlokasi);
                data2.push(nilaiRealisasi);
                
            }

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
                            { name: 'Alokasi', y: nilaiAlokasi },
                            { name: 'Realisasi', y: nilaiRealisasi }
                        ]
                    }]
                });
        });

        $.getJSON('{{ url("/getjenisbelanja") }}', function (result) {

            console.log(result[0]);
            var data51 = [] , data52 = [] , data53 = [] , namasatker = [] , jnsblnj = [];

            for (var i = 0; i < result['rkakl'].length; i++) {
                    
                switch(result['rkakl'][i].jenis_belanja) {
                    case "51":
                        data51.push(result['rkakl'][i].realisasi);
                    break;
                    case "52":
                        data52.push(result['rkakl'][i].realisasi);
                    break;
                    default:
                        data53.push(result['rkakl'][i].realisasi);
                    }
            }
            for (var i = 0; i < result['nm'].length; i++)  {
                namasatker.push(result['nm'][i].nama_singkat);
            }
            for (var i = 0; i < result['Jnsblj'].length; i++) {
                jnsblnj.push(result['Jnsblj'][i].description);
            }

            console.log(result);

            Highcharts.chart('chartRealisasi', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Perjenis Belanja'
                },
                xAxis: {
                    categories: jnsblnj,
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
                    name: 'Belanja Pegawai',
                    data: data51

                }, {
                    name: 'Belanja Pegawai',
                    data: data52

                }, {
                    name: 'Belanja Modal',
                    data: data53

                }]
            });
        });

        // SPM

        $.getJSON('{{ url("/get_spm/0") }}', function (result) {

            console.log(result[0]);

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }


            console.log(result);

            Highcharts.chart('chartspmsp2d', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi SPM SP2D'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Pengajuan',
                    data: nilai_pengajuan

                }, {
                    name: 'SPM',
                    data: nilai_spm

                }, {
                    name: 'SP2D',
                    data: nilai_sp2d

                }]
            });
        });

        // TUPOKSI 

        $.getJSON('{{ url("/get_tupoksi") }}', function (result) {

            console.log(result[0]);

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }


            console.log(result);

            Highcharts.chart('charttupoksi', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi SPM SP2D'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Realisasi',
                    data: realisasi

                }]
            });
        });

        // pengadaan 

        $.getJSON('{{ url("/get_pengadaan") }}', function (result) {

            console.log(result[0]);

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }


            console.log(result);

            Highcharts.chart('chartpengadaan', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Pengadaan'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Nilai Kontrak',
                    data: nilai_kontrak

                }, {
                    name: 'Pencairan Kontrak',
                    data: pencairan

                }]
            });
        });

        // RM PNBP
        $.getJSON('{{ url("/get_pnbp") }}', function (result) {

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);

                $('#tbl_pnpb').append('<tr><td>'+ result[i].kode_satker+'</td><td>'+ result[i].nama_satker +'</td><td class="text-right">'+ result[i].alokasi_rm.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</td><td class="text-right">'+ result[i].alokasi_pnbp.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</td><td class="text-right">'+ result[i].rm.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</td><td class="text-right">'+ result[i].pnbp.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</td></tr>');
            }
        });
        // Get jum
        // $.getJSON('{{ url("/get_jumpnbp") }}', function (result) {

        //     console.log(result.length);

        //     for (var o = 0; o < result.length; o++) {
        //         // kode_satker.push(result[o].nama_satker);
        //         // alokasi_rm.push(parseFloat(result[o].alokasi_rm)/1000000);
        //         // alokasi_pnbp.push(parseFloat(result[o].alokasi_pnbp)/1000000);
        //         // rm.push(parseFloat(result[o].rm) / 1000000);
        //         // pnbp.push(result[o].pnbp);

        //         // var alokasi_rm          = parseFloat(result[o].jumalokasi_rm);
        //         var alokasi_pnbp    = parseFloat(result[o].jumalokasi_pnbp);
        //         var rm    = parseFloat(result[o].jum_rm);
        //         var pnbp    = parseFloat(result[o].jum_pnbp);

        //         var alokasirm = parseFloat(result[o].jumalokasi_rm);
                
        //         // if (!alokasi_rm) return 1;
        //         // if (!jumalokasi_pnbp) return 1;
        //         // if (!jum_rm) return 1;
        //         // if (!jum_pnbp) return 1;

        //         $('#tbl_pnpb').append('<tr><td colspan="2" class="text-center"><b>Jumlah</b></td><td class="text-right">'+ result[o].jumalokasi_rm.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</td></tr>');
        //     }
        // });



        $.getJSON('{{ url("/getrpdsummary") }}', function (result) {

            var label = [] ; rpd = [] , revisi = [] , realisasi = [];
            for (var i = 0; i < result.length; i++) {
                label.push(result[i].bulan);
                rpd.push(result[i].nilai);
                revisi.push(result[i].nilai_perubahan);
                realisasi.push(result[i].realisasi);
            }

            var ctx = $("#chartrpd"); 
            var data = {
                labels: label,
                datasets: [
                    {
                        label: "RPD",
                        data: rpd,
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: revisi,
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: realisasi,
                        backgroundColor: "red",
                        borderColor: "red",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                ]
            };
            var options = {
                    responsive: true,
                    legend: {
                        display: true,
                        position: "top",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    }
            };
            var chart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options
            });
        });

        // TAB SESDITJEN
            // Grafik Line RPD , RPD Revisi , Realisasi
        $.getJSON('{{ url("/getrpdsummaryeselondua/3") }}', function (result) {

            var label = [] ; rpd = [] , revisi = [] , realisasi = [];
            for (var i = 0; i < result.length; i++) {
                label.push(result[i].bulan);
                rpd.push(result[i].nilai);
                revisi.push(result[i].nilai_perubahan);
                realisasi.push(result[i].realisasi);
            }

            var ctx = $("#chartrpd_ses"); 
            var data = {
                labels: label,
                datasets: [
                    {
                        label: "RPD",
                        data: rpd,
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: revisi,
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: realisasi,
                        backgroundColor: "red",
                        borderColor: "red",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                ]
            };
            var options = {
                    responsive: true,
                    legend: {
                        display: true,
                        position: "top",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    }
            };
            var chart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options
            });
        });
            //Grafik PIE Realisasi , Saldo

        $.getJSON('{{ url("/get_pie_realisasi_eselon_dua/3") }}', function (result) {

            // console.log(result['pagu']);
            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            // var ctx = $("#chartRealisasi_ses").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }
            var myChart = Highcharts.chart('chartRealisasi_ses', {
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
                            { name: 'Realisasi', y: nilaiRealisasi },
                            { name: 'Anggaran', y: nilaiSisa }
                        ]
                    }]
                });
        });
            // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/3") }}', function (result) {

            // console.log(result[0]);

            var data51 = [] , data52 = [] , data53 = [] , namasatker = [] , jnsblnj = [];

            for (var i = 0; i < result['rkakl'].length; i++) {
                    
                switch(result['rkakl'][i].jenis_belanja) {
                    case "51":
                        data51.push(result['rkakl'][i].realisasi);
                    break;
                    case "52":
                        data52.push(result['rkakl'][i].realisasi);
                    break;
                    default:
                        data53.push(result['rkakl'][i].realisasi);
                    }
            }
            for (var i = 0; i < result['nm'].length; i++)  {
                namasatker.push(result['nm'][i].nama_singkat);
            }
            for (var i = 0; i < result['Jnsblj'].length; i++) {
                jnsblnj.push(result['Jnsblj'][i].description);
            }

            // console.log(pagu);

            Highcharts.chart('chartbelanja_ses', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Belanja'
                },
                xAxis: {
                    categories: namasatker,
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
                    name: 'Belanja Pegawai',
                    data: data51

                }, {
                    name: 'Belanja Barang',
                    data: data52

                }, {
                    name: 'Belanja Modal',
                    data: data53

                }]
            });
        });
        
        $.getJSON('{{ url("/get_spm/3") }}', function (result) {

            // console.log(result[0]);

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            // console.log(pagu);

            Highcharts.chart('chartSPM_ses', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi SPM SP2D'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Pengajuan',
                    data: nilai_pengajuan

                }, {
                    name: 'SPM',
                    data: nilai_spm

                }, {
                    name: 'SP2D',
                    data: nilai_sp2d

                }]
            });
        });

       
        // pengadaan
        $.getJSON('{{ url("/get_pengadaaneselondua/3") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }

            // console.log(pagu);

            Highcharts.chart('chartpengadaan_eseolon_dua', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Pengadaan'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Nilai Kontrak',
                    data: nilai_kontrak

                }, {
                    name: 'Pencairan Kontrak',
                    data: pencairan

                }]
            });
        }); 
        
            //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/3") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }

            // console.log(pagu);

            Highcharts.chart('chartTupoksi_ses', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Realisasi',
                    data: realisasi

                }]
            });
        });
        
            //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/3") }}', function (result) {

            // console.log(result[0]);

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }

            // console.log(pagu);

            Highcharts.chart('chartRm_ses', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: kode_satker,
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
                    name: 'Alokasi RM',
                    data: alokasi_rm

                }, {
                    name: 'Rupiah Murni',
                    data: rm

                }, {
                    name: 'Alokasi PNBP',
                    data: alokasi_pnbp

                }, {
                    name: 'PNBP',
                    data: pnbp

                }]
            });
        });
        

// TAB OBLIK
            // Grafik Line RPD , RPD Revisi , Realisasi
        $.getJSON('{{ url("/getrpdsummaryeselondua/6") }}', function (result) {

            var label = [] ; rpd = [] , revisi = [] , realisasi = [];
            for (var i = 0; i < result.length; i++) {
                label.push(result[i].bulan);
                rpd.push(result[i].nilai);
                revisi.push(result[i].nilai_perubahan);
                realisasi.push(result[i].realisasi);
            }

            var ctx = $("#chartrpd_oblik"); 
            var data = {
                labels: label,
                datasets: [
                    {
                        label: "RPD",
                        data: rpd,
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: revisi,
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: realisasi,
                        backgroundColor: "red",
                        borderColor: "red",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                ]
            };
            var options = {
                    responsive: true,
                    legend: {
                        display: true,
                        position: "top",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    }
            };
            var chart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options
            });
        });
            //Grafik PIE Realisasi , Saldo
        $.getJSON('{{ url("/get_pie_realisasi_eselon_dua/6") }}', function (result) {

            // console.log(result['pagu']);
            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            // var ctx = $("#chartRealisasi_oblik").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }

            var myChart = Highcharts.chart('chartRealisasi_oblik', {
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
                            { name: 'Alokasi', y: nilaiAlokasi },
                            { name: 'Realisasi', y: nilaiRealisasi }
                        ]
                    }]
                });
        });
        
            // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/6") }}', function (result) {

            console.log(result[0]);
            var data51 = [] , data52 = [] , data53 = [] , namasatker = [] , jnsblnj = [];

            for (var i = 0; i < result['rkakl'].length; i++) {
                    
                switch(result['rkakl'][i].jenis_belanja) {
                    case "51":
                        data51.push(result['rkakl'][i].realisasi);
                    break;
                    case "52":
                        data52.push(result['rkakl'][i].realisasi);
                    break;
                    default:
                        data53.push(result['rkakl'][i].realisasi);
                    }
            }
            for (var i = 0; i < result['nm'].length; i++)  {
                namasatker.push(result['nm'][i].nama_singkat);
            }
            for (var i = 0; i < result['Jnsblj'].length; i++) {
                jnsblnj.push(result['Jnsblj'][i].description);
            }

            // console.log(pagu);

            Highcharts.chart('chartbelanja_oblik', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Per Belanja'
                },
                xAxis: {
                    categories: namasatker,
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
                    name: 'Belanja Pegawai',
                    data: data51

                }, {
                    name: 'Belanja Barang',
                    data: data52

                }, {
                    name: 'Belanja Modal',
                    data: data53

                }]
            });
        });
        
        // SPM SP2D
        $.getJSON('{{ url("/get_spm/6") }}', function (result) {

            // console.log(result[0]);

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            // console.log(pagu);

            Highcharts.chart('chartSPM_oblik', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi SPM SP2D'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Pengajuan',
                    data: nilai_pengajuan

                }, {
                    name: 'SPM',
                    data: nilai_spm

                }, {
                    name: 'SP2D',
                    data: nilai_sp2d

                }]
            });
        });
        

        // pengadaan
        $.getJSON('{{ url("/get_pengadaaneselondua/6") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }

            // console.log(pagu);

            Highcharts.chart('chartpengadaan_oblik', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Pengadaan'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Nilai Kontrak',
                    data: nilai_kontrak

                }, {
                    name: 'Pencairan Kontrak',
                    data: pencairan

                }]
            });
        });  
        
            //Tupoksi 
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/6") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }

            // console.log(pagu);

            Highcharts.chart('chartTupoksi_oblik', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Realisasi',
                    data: realisasi

                }]
            });
        });
        
            //Rm & Pnbp 
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/6") }}', function (result) {

            // console.log(result[0]);

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }

            // console.log(pagu);

            Highcharts.chart('chartRm_oblik', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: kode_satker,
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
                    name: 'Alokasi RM',
                    data: alokasi_rm

                }, {
                    name: 'Rupiah Murni',
                    data: rm

                }, {
                    name: 'Alokasi PNBP',
                    data: alokasi_pnbp

                }, {
                    name: 'PNBP',
                    data: pnbp

                }]
            });
        });
        


        // TAB yanfar
            // Grafik Line RPD , RPD Revisi , Realisasi
        $.getJSON('{{ url("/getrpdsummaryeselondua/4") }}', function (result) {

            var label = [] ; rpd = [] , revisi = [] , realisasi = [];
            for (var i = 0; i < result.length; i++) {
                label.push(result[i].bulan);
                rpd.push(result[i].nilai);
                revisi.push(result[i].nilai_perubahan);
                realisasi.push(result[i].realisasi);
            }

            var ctx = $("#chartrpd_yanfar"); 
            var data = {
                labels: label,
                datasets: [
                    {
                        label: "RPD",
                        data: rpd,
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: revisi,
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: realisasi,
                        backgroundColor: "red",
                        borderColor: "red",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                ]
            };
            var options = {
                    responsive: true,
                    legend: {
                        display: true,
                        position: "top",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    }
            };
            var chart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options
            });
        });
            //Grafik PIE Realisasi , Saldo
        $.getJSON('{{ url("/get_pie_realisasi_eselon_dua/4") }}', function (result) {

            // console.log(result['pagu']);
            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            // var ctx = $("#chartRealisasi_oblik").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }

            var myChart = Highcharts.chart('chartRealisasi_yanfar', {
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
                            { name: 'Alokasi', y: nilaiAlokasi },
                            { name: 'Realisasi', y: nilaiRealisasi }
                        ]
                    }]
                });
        });
        
            // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/4") }}', function (result) {

            // console.log(result[0]);
            var data51 = [] , data52 = [] , data53 = [] , namasatker = [] , jnsblnj = [];

            for (var i = 0; i < result['rkakl'].length; i++) {
                    
                switch(result['rkakl'][i].jenis_belanja) {
                    case "51":
                        data51.push(result['rkakl'][i].realisasi);
                    break;
                    case "52":
                        data52.push(result['rkakl'][i].realisasi);
                    break;
                    default:
                        data53.push(result['rkakl'][i].realisasi);
                    }
            }
            for (var i = 0; i < result['nm'].length; i++)  {
                namasatker.push(result['nm'][i].nama_singkat);
            }
            for (var i = 0; i < result['Jnsblj'].length; i++) {
                jnsblnj.push(result['Jnsblj'][i].description);
            }

            // console.log(pagu);

            Highcharts.chart('chartbelanja_yanfar', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Per Belanja'
                },
                xAxis: {
                    categories: namasatker,
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
                    name: 'Belanja Pegawai',
                    data: data51

                }, {
                    name: 'Belanja Barang',
                    data: data52

                }, {
                    name: 'Belanja Modal',
                    data: data53

                }]
            });
        });

        // SPM SP2D
        $.getJSON('{{ url("/get_spm/4") }}', function (result) {

            // console.log(result[0]);

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            // console.log(pagu);

            Highcharts.chart('chartSPM_yanfar', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi SPM SP2D'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Pengajuan',
                    data: nilai_pengajuan

                }, {
                    name: 'SPM',
                    data: nilai_spm

                }, {
                    name: 'SP2D',
                    data: nilai_sp2d

                }]
            });
        });

        // pengadaan
        $.getJSON('{{ url("/get_pengadaaneselondua/4") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }

            // console.log(pagu);

            Highcharts.chart('chartpengadaan_yanfar', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Pengadaan'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Nilai Kontrak',
                    data: nilai_kontrak

                }, {
                    name: 'Pencairan Kontrak',
                    data: pencairan

                }]
            });
        });  

            //Tupoksi
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/4") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }

            // console.log(pagu);

            Highcharts.chart('chartTupoksi_oblik', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Realisasi',
                    data: realisasi

                }]
            });
        });
        
            //Rm & Pnbp
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/4") }}', function (result) {

            // console.log(result[0]);

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }

            // console.log(pagu);

            Highcharts.chart('chartRm_yanfar', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: kode_satker,
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
                    name: 'Alokasi RM',
                    data: alokasi_rm

                }, {
                    name: 'Rupiah Murni',
                    data: rm

                }, {
                    name: 'Alokasi PNBP',
                    data: alokasi_pnbp

                }, {
                    name: 'PNBP',
                    data: pnbp

                }]
            });
        });
        
        // TAB FM
            // Grafik Line RPD , RPD Revisi , Realisasi
        $.getJSON('{{ url("/getrpdsummaryeselondua/5") }}', function (result) {

            var label = [] ; rpd = [] , revisi = [] , realisasi = [];
            for (var i = 0; i < result.length; i++) {
                label.push(result[i].bulan);
                rpd.push(result[i].nilai);
                revisi.push(result[i].nilai_perubahan);
                realisasi.push(result[i].realisasi);
            }

            var ctx = $("#chartrpd_fm"); 
            var data = {
                labels: label,
                datasets: [
                    {
                        label: "RPD",
                        data: rpd,
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: revisi,
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: realisasi,
                        backgroundColor: "red",
                        borderColor: "red",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                ]
            };
            var options = {
                    responsive: true,
                    legend: {
                        display: true,
                        position: "top",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    },
                    scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                            // OR //
                            beginAtZero: true   // minimum value will be 0.
                        }
                    }]
                }
            };
            var chart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options
            });
        });
            //Grafik PIE Realisasi , Saldo
        $.getJSON('{{ url("/get_pie_realisasi_eselon_dua/5") }}', function (result) {

            // console.log(result['pagu']);
            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            // var ctx = $("#chartRealisasi_oblik").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }

            var myChart = Highcharts.chart('chartRealisasi_fm', {
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
                            { name: 'Alokasi', y: nilaiAlokasi },
                            { name: 'Realisasi', y: nilaiRealisasi }
                        ]
                    }]
                });
        });
        
        // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/5") }}', function (result) {

            // console.log(result[0]);
            var data51 = [] , data52 = [] , data53 = [] , namasatker = [] , jnsblnj = [];

            for (var i = 0; i < result['rkakl'].length; i++) {
                    
                switch(result['rkakl'][i].jenis_belanja) {
                    case "51":
                        data51.push(result['rkakl'][i].realisasi);
                    break;
                    case "52":
                        data52.push(result['rkakl'][i].realisasi);
                    break;
                    default:
                        data53.push(result['rkakl'][i].realisasi);
                    }
            }
            for (var i = 0; i < result['nm'].length; i++)  {
                namasatker.push(result['nm'][i].nama_singkat);
            }
            for (var i = 0; i < result['Jnsblj'].length; i++) {
                jnsblnj.push(result['Jnsblj'][i].description);
            }

            // console.log(pagu);

            Highcharts.chart('chartbelanja_fm', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Per Belanja'
                },
                xAxis: {
                    categories: namasatker,
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
                    name: 'Belanja Pegawai',
                    data: data51

                }, {
                    name: 'Belanja Barang',
                    data: data52

                }, {
                    name: 'Belanja Modal',
                    data: data53

                }]
            });
        });

        // SPM SP2D
        $.getJSON('{{ url("/get_spm/5") }}', function (result) {

            // console.log(result[0]);

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            // console.log(pagu);

            Highcharts.chart('chartSPM_fm', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi SPM SP2D'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Pengajuan',
                    data: nilai_pengajuan

                }, {
                    name: 'SPM',
                    data: nilai_spm

                }, {
                    name: 'SP2D',
                    data: nilai_sp2d

                }]
            });
        });

        // pengadaan
        $.getJSON('{{ url("/get_pengadaaneselondua/5") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }

            // console.log(pagu);

            Highcharts.chart('chartpengadaan_fm', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Pengadaan'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Nilai Kontrak',
                    data: nilai_kontrak

                }, {
                    name: 'Pencairan Kontrak',
                    data: pencairan

                }]
            });
        });

        //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/5") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }

            // console.log(pagu);

            Highcharts.chart('chartTupoksi_fm', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Realisasi',
                    data: realisasi

                }]
            });
        });
        
        //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/5") }}', function (result) {

            // console.log(result[0]);

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }

            // console.log(pagu);

            Highcharts.chart('chartRm_fm', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: kode_satker,
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
                    name: 'Alokasi RM',
                    data: alokasi_rm

                }, {
                    name: 'Rupiah Murni',
                    data: rm

                }, {
                    name: 'Alokasi PNBP',
                    data: alokasi_pnbp

                }, {
                    name: 'PNBP',
                    data: pnbp

                }]
            });
        });

        // TAB penalkes
            // Grafik Line RPD , RPD Revisi , Realisasi
        $.getJSON('{{ url("/getrpdsummaryeselondua/1") }}', function (result) {

            var label = [] ; rpd = [] , revisi = [] , realisasi = [];
            for (var i = 0; i < result.length; i++) {
                label.push(result[i].bulan);
                rpd.push(result[i].nilai);
                revisi.push(result[i].nilai_perubahan);
                realisasi.push(result[i].realisasi);
            }

            var ctx = $("#chartrpd_penalkes"); 
            var data = {
                labels: label,
                datasets: [
                    {
                        label: "RPD",
                        data: rpd,
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: revisi,
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: realisasi,
                        backgroundColor: "red",
                        borderColor: "red",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                ]
            };
            var options = {
                    responsive: true,
                    legend: {
                        display: true,
                        position: "top",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    }
            };
            var chart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options
            });
        });
            //Grafik PIE Realisasi , Saldo
        $.getJSON('{{ url("/get_pie_realisasi_eselon_dua/1") }}', function (result) {

            // console.log(result['pagu']);
            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            // var ctx = $("#chartRealisasi_oblik").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }

            var myChart = Highcharts.chart('chartRealisasi_penalkes', {
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
                            { name: 'Alokasi', y: nilaiAlokasi },
                            { name: 'Realisasi', y: nilaiRealisasi }
                        ]
                    }]
                });
        });
        
        // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/1") }}', function (result) {

            // console.log(result[0]);
            var data51 = [] , data52 = [] , data53 = [] , namasatker = [] , jnsblnj = [];

            for (var i = 0; i < result['rkakl'].length; i++) {
                    
                switch(result['rkakl'][i].jenis_belanja) {
                    case "51":
                        data51.push(result['rkakl'][i].realisasi);
                    break;
                    case "52":
                        data52.push(result['rkakl'][i].realisasi);
                    break;
                    default:
                        data53.push(result['rkakl'][i].realisasi);
                    }
            }
            for (var i = 0; i < result['nm'].length; i++)  {
                namasatker.push(result['nm'][i].nama_singkat);
            }
            for (var i = 0; i < result['Jnsblj'].length; i++) {
                jnsblnj.push(result['Jnsblj'][i].description);
            }

            // console.log(pagu);

            Highcharts.chart('chartbelanja_penalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Per Belanja'
                },
                xAxis: {
                    categories: namasatker,
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
                    name: 'Belanja Pegawai',
                    data: data51

                }, {
                    name: 'Belanja Barang',
                    data: data52

                }, {
                    name: 'Belanja Modal',
                    data: data53

                }]
            });
        });

        // pengadaan
        $.getJSON('{{ url("/get_pengadaaneselondua/2") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }

            // console.log(pagu);

            Highcharts.chart('chartpengadaan_penalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Pengadaan'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Nilai Kontrak',
                    data: nilai_kontrak

                }, {
                    name: 'Pencairan Kontrak',
                    data: pencairan

                }]
            });
        }); 

        // SPM SP2D
        $.getJSON('{{ url("/get_spm/1") }}', function (result) {

            // console.log(result[0]);

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            // console.log(pagu);

            Highcharts.chart('chartSPM_penalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi SPM SP2D'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Pengajuan',
                    data: nilai_pengajuan

                }, {
                    name: 'SPM',
                    data: nilai_spm

                }, {
                    name: 'SP2D',
                    data: nilai_sp2d

                }]
            });
        });
                
        //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/1") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }

            // console.log(pagu);

            Highcharts.chart('chartTupoksi_penalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Realisasi',
                    data: realisasi

                }]
            });
        });
        
        //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/1") }}', function (result) {

            // console.log(result[0]);

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }

            // console.log(pagu);

            Highcharts.chart('chartTupoksi_penalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: kode_satker,
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
                    name: 'Alokasi RM',
                    data: alokasi_rm

                }, {
                    name: 'Rupiah Murni',
                    data: rm

                }, {
                    name: 'Alokasi PNBP',
                    data: alokasi_pnbp

                }, {
                    name: 'PNBP',
                    data: pnbp

                }]
            });
        });
        
        // TAB wsalkes
                    // Grafik Line RPD , RPD Revisi , Realisasi
        $.getJSON('{{ url("/getrpdsummaryeselondua/2") }}', function (result) {

            var label = [] ; rpd = [] , revisi = [] , realisasi = [];
            for (var i = 0; i < result.length; i++) {
                label.push(result[i].bulan);
                rpd.push(result[i].nilai);
                revisi.push(result[i].nilai_perubahan);
                realisasi.push(result[i].realisasi);
            }

            var ctx = $("#chartrpd_wasalkes"); 
            var data = {
                labels: label,
                datasets: [
                    {
                        label: "RPD",
                        data: rpd,
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: revisi,
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: realisasi,
                        backgroundColor: "red",
                        borderColor: "red",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                ]
            };
            var options = {
                    responsive: true,
                    legend: {
                        display: true,
                        position: "top",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                                // OR //
                                beginAtZero: true   // minimum value will be 0.
                            }
                        }]
                    }
            };
            var chart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options
            });
        });
            //Grafik PIE Realisasi , Saldo
        $.getJSON('{{ url("/get_pie_realisasi_eselon_dua/2") }}', function (result) {

            // console.log(result['pagu']);
            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            // var ctx = $("#chartRealisasi_oblik").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }

            var myChart = Highcharts.chart('chartRealisasi_wasalkes', {
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
                            { name: 'Alokasi', y: nilaiAlokasi },
                            { name: 'Realisasi', y: nilaiRealisasi }
                        ]
                    }]
                });
        });
        
        // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/2") }}', function (result) {

            // console.log(result[0]);
            var data51 = [] , data52 = [] , data53 = [] , namasatker = [] , jnsblnj = [];

            for (var i = 0; i < result['rkakl'].length; i++) {
                    
                switch(result['rkakl'][i].jenis_belanja) {
                    case "51":
                        data51.push(result['rkakl'][i].realisasi);
                    break;
                    case "52":
                        data52.push(result['rkakl'][i].realisasi);
                    break;
                    default:
                        data53.push(result['rkakl'][i].realisasi);
                    }
            }
            for (var i = 0; i < result['nm'].length; i++)  {
                namasatker.push(result['nm'][i].nama_singkat);
            }
            for (var i = 0; i < result['Jnsblj'].length; i++) {
                jnsblnj.push(result['Jnsblj'][i].description);
            }

            // console.log(pagu);

            Highcharts.chart('chartbelanja_wasalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Per Belanja'
                },
                xAxis: {
                    categories: namasatker,
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
                    name: 'Belanja Pegawai',
                    data: data51

                }, {
                    name: 'Belanja Barang',
                    data: data52

                }, {
                    name: 'Belanja Modal',
                    data: data53

                }]
            });
        });

        // pengadaan 
        $.getJSON('{{ url("/get_pengadaaneselondua/1") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }

            // console.log(pagu);

            Highcharts.chart('chartpengadaan_wasalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Pengadaan'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Nilai Kontrak',
                    data: nilai_kontrak

                }, {
                    name: 'Pencairan Kontrak',
                    data: pencairan

                }]
            });
        });

        // SPM SP2D
        $.getJSON('{{ url("/get_spm/2") }}', function (result) {

            // console.log(result[0]);

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            // console.log(pagu);

            Highcharts.chart('chartSPM_wasalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi SPM SP2D'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Pengajuan',
                    data: nilai_pengajuan

                }, {
                    name: 'SPM',
                    data: nilai_spm

                }, {
                    name: 'SP2D',
                    data: nilai_sp2d

                }]
            });
        });
        //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/2") }}', function (result) {

            // console.log(result[0]);

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }

            // console.log(pagu);

            Highcharts.chart('chartTupoksi_wasalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Tupoksi'
                },
                xAxis: {
                    categories: nama_satker,
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
                    name: 'Alokasi',
                    data: alokasi

                }, {
                    name: 'Realisasi',
                    data: realisasi

                }]
            });
        });
        //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/2") }}', function (result) {

            // console.log(result[0]);

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }

            // console.log(pagu);

            Highcharts.chart('chartRm_wasalkes', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Realisasi Rupiah Murni  & PNBP'
                },
                xAxis: {
                    categories: kode_satker,
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
                    name: 'Alokasi RM',
                    data: alokasi_rm

                }, {
                    name: 'Rupiah Murni',
                    data: rm

                }, {
                    name: 'Alokasi PNBP',
                    data: alokasi_pnbp

                }, {
                    name: 'PNBP',
                    data: pnbp

                }]
            });
        });

    </script>
@stop