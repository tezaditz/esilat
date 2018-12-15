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

            var data1 = [] , data2 = [] , data3 =[];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            var ctx = $("#mycanvas").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(nilaiAlokasi);
                data2.push(nilaiRealisasi);
                
            }


            var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               data1,data2
                            ],
                            backgroundColor: [
                                "green",
                                "blue",
                            ]
                        }],
                        labels: [
                            "Alokasi",
                            "Realisasi"
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                          callbacks: {
                            // this callback is used to create the tooltip label
                            label: function(tooltipItem, data) {
                              // get the data label and data value to display
                              // convert the data value to local string so it uses a comma seperated number
                              var dataLabel = data.labels[tooltipItem.index];
                              var value = ': ' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();

                              // make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
                              if (Chart.helpers.isArray(dataLabel)) {
                                // show value on first line of multiline label
                                // need to clone because we are changing the value
                                dataLabel = dataLabel.slice();
                                dataLabel[0] += value;
                              } else {
                                dataLabel += value;
                              }

                              // return the text to display on the tooltip
                              return dataLabel;
                            }
                          }
                        }
                    }
                };

            var myPieChart = new Chart(ctx, config);
        });

        $.getJSON('{{ url("/getjenisbelanja") }}', function (result) {

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

            var data = {
              labels: namasatker,
              datasets: [{
                label: jnsblnj[0],
                backgroundColor: "blue",
                data: data51
              }, {
                label: jnsblnj[1],
                backgroundColor: "red",
                data: data52
              }, {
                label: jnsblnj[2],
                backgroundColor: "green",
                data: data53
              }]
            };


            var ctx = document.getElementById("chartRealisasi").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              datasets: data,   
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        // SPM
        $.getJSON('{{ url("/get_spm/0") }}', function (result) {

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Pengajuan",
                backgroundColor: "blue",
                data: nilai_pengajuan
              }, {
                label: "SPM",
                backgroundColor: "red",
                data: nilai_spm
              }, {
                label: "SP2D",
                backgroundColor: "green",
                data: nilai_sp2d
              }]
            };


            var ctx = document.getElementById("chartspmsp2d").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });


        // TUPOKSI 
        $.getJSON('{{ url("/get_tupoksi") }}', function (result) {

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }


            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Alokasi",
                backgroundColor: "green",
                data: alokasi,
              },{
                label: "Realisasi",
                backgroundColor: "blue",
                data: realisasi,
              }]
            };


            var ctx = document.getElementById("charttupoksi").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        // pengadaan 
        $.getJSON('{{ url("/get_pengadaan") }}', function (result) {

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }


            var data = {
              labels: nama_satker,
              datasets: [
              {
                label: "Alokasi",
                backgroundColor: "blue",
                data: alokasi,
              },
              {
                label: "Nilai Kontrak",
                backgroundColor: "yellow",
                data: nilai_kontrak,
              },
              {
                label: "Pencarian Kontrak",
                backgroundColor: "green",
                data: pencairan,
              },]
            };


            var ctx = document.getElementById("chartpengadaan").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
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

            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            var ctx = $("#chartRealisasi_ses").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }


            var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               data1,data2
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Sisa Anggaran"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };

            var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/3") }}', function (result) {

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

            var data = {
              labels: namasatker,
              datasets: [{
                label: jnsblnj[0],
                backgroundColor: "blue",
                data: data51
              }, {
                label: jnsblnj[1],
                backgroundColor: "red",
                data: data52
              }, {
                label: jnsblnj[2],
                backgroundColor: "green",
                data: data53
              }]
            };


            var ctx = document.getElementById("chartbelanja_ses").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        $.getJSON('{{ url("/get_spm/3") }}', function (result) {

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Pengajuan",
                backgroundColor: "blue",
                data: nilai_pengajuan
              }, {
                label: "SPM",
                backgroundColor: "red",
                data: nilai_spm
              }, {
                label: "SP2D",
                backgroundColor: "green",
                data: nilai_sp2d
              }]
            };


            var ctx = document.getElementById("chartSPM_ses").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
        // pengadaan 
        $.getJSON('{{ url("/get_pengadaaneselondua/3") }}', function (result) {

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }


            var data = {
              labels: nama_satker,
              datasets: [
              {
                label: "Alokasi",
                backgroundColor: "blue",
                data: alokasi,
              },
              {
                label: "Nilai Kontrak",
                backgroundColor: "yellow",
                data: nilai_kontrak,
              },
              {
                label: "Pencarian Kontrak",
                backgroundColor: "green",
                data: pencairan,
              },]
            };


            var ctx = document.getElementById("chartpengadaan_eseolon_dua").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/3") }}', function (result) {

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }


            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Alokasi",
                backgroundColor: "green",
                data: alokasi,
              },{
                label: "Realisasi",
                backgroundColor: "blue",
                data: realisasi,
              }]
            };


            var ctx = document.getElementById("chartTupoksi_ses").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/3") }}', function (result) {

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }


            var data = {
              labels: kode_satker,
              datasets: [{
                label: "Alokasi RM",
                backgroundColor: "green",
                data: alokasi_rm,
              },{
                label: "Rupiah Murni",
                backgroundColor: "blue",
                data: rm,
              },{
                label: "Alokasi PNBP",
                backgroundColor: "yellow",
                data: alokasi_pnbp,
              },{
                label: "PNBP",
                backgroundColor: "red",
                data: pnbp,
              }]
            };


            var ctx = document.getElementById("chartRm_ses").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
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

            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            var ctx = $("#chartRealisasi_oblik").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }


            var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               data1,data2
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Sisa Anggaran"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };

            var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/6") }}', function (result) {

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

            var data = {
              labels: namasatker,
              datasets: [{
                label: jnsblnj[0],
                backgroundColor: "blue",
                data: data51
              }, {
                label: jnsblnj[1],
                backgroundColor: "red",
                data: data52
              }, {
                label: jnsblnj[2],
                backgroundColor: "green",
                data: data53
              }]
            };


            var ctx = document.getElementById("chartbelanja_oblik").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        $.getJSON('{{ url("/get_spm/6") }}', function (result) {

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Pengajuan",
                backgroundColor: "blue",
                data: nilai_pengajuan
              }, {
                label: "SPM",
                backgroundColor: "red",
                data: nilai_spm
              }, {
                label: "SP2D",
                backgroundColor: "green",
                data: nilai_sp2d
              }]
            };


            var ctx = document.getElementById("chartSPM_oblik").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        // pengadaan 
        $.getJSON('{{ url("/get_pengadaaneselondua/6") }}', function (result) {

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }


            var data = {
              labels: nama_satker,
              datasets: [
              {
                label: "Alokasi",
                backgroundColor: "blue",
                data: alokasi,
              },
              {
                label: "Nilai Kontrak",
                backgroundColor: "yellow",
                data: nilai_kontrak,
              },
              {
                label: "Pencarian Kontrak",
                backgroundColor: "green",
                data: pencairan,
              },]
            };


            var ctx = document.getElementById("chartpengadaan_oblik").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/6") }}', function (result) {

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }


            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Alokasi",
                backgroundColor: "green",
                data: alokasi,
              },{
                label: "Realisasi",
                backgroundColor: "blue",
                data: realisasi,
              }]
            };


            var ctx = document.getElementById("chartTupoksi_oblik").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/6") }}', function (result) {

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }


            var data = {
              labels: kode_satker,
              datasets: [{
                label: "Alokasi RM",
                backgroundColor: "green",
                data: alokasi_rm,
              },{
                label: "Rupiah Murni",
                backgroundColor: "blue",
                data: rm,
              },{
                label: "Alokasi PNBP",
                backgroundColor: "yellow",
                data: alokasi_pnbp,
              },{
                label: "PNBP",
                backgroundColor: "red",
                data: pnbp,
              }]
            };


            var ctx = document.getElementById("chartRm_oblik").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
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

            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            var ctx = $("#chartRealisasi_yanfar").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }


            var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               data1,data2
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Sisa Anggaran"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };

            var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/4") }}', function (result) {

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

            var data = {
              labels: namasatker,
              datasets: [{
                label: jnsblnj[0],
                backgroundColor: "blue",
                data: data51
              }, {
                label: jnsblnj[1],
                backgroundColor: "red",
                data: data52
              }, {
                label: jnsblnj[2],
                backgroundColor: "green",
                data: data53
              }]
            };


            var ctx = document.getElementById("chartbelanja_yanfar").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        $.getJSON('{{ url("/get_spm/4") }}', function (result) {

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Pengajuan",
                backgroundColor: "blue",
                data: nilai_pengajuan
              }, {
                label: "SPM",
                backgroundColor: "red",
                data: nilai_spm
              }, {
                label: "SP2D",
                backgroundColor: "green",
                data: nilai_sp2d
              }]
            };


            var ctx = document.getElementById("chartSPM_yanfar").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        // pengadaan 
        $.getJSON('{{ url("/get_pengadaaneselondua/4") }}', function (result) {

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }


            var data = {
              labels: nama_satker,
              datasets: [
              {
                label: "Alokasi",
                backgroundColor: "blue",
                data: alokasi,
              },
              {
                label: "Nilai Kontrak",
                backgroundColor: "yellow",
                data: nilai_kontrak,
              },
              {
                label: "Pencarian Kontrak",
                backgroundColor: "green",
                data: pencairan,
              },]
            };


            var ctx = document.getElementById("chartpengadaan_yanfar").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/4") }}', function (result) {

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }


            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Alokasi",
                backgroundColor: "green",
                data: alokasi,
              },{
                label: "Realisasi",
                backgroundColor: "blue",
                data: realisasi,
              }]
            };


            var ctx = document.getElementById("chartTupoksi_yanfar").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/4") }}', function (result) {

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }


            var data = {
              labels: kode_satker,
              datasets: [{
                label: "Alokasi RM",
                backgroundColor: "green",
                data: alokasi_rm,
              },{
                label: "Rupiah Murni",
                backgroundColor: "blue",
                data: rm,
              },{
                label: "Alokasi PNBP",
                backgroundColor: "yellow",
                data: alokasi_pnbp,
              },{
                label: "PNBP",
                backgroundColor: "red",
                data: pnbp,
              }]
            };


            var ctx = document.getElementById("chartRm_yanfar").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
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

            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            var ctx = $("#chartRealisasi_fm").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }


            var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               data1,data2
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Sisa Anggaran"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };

            var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/5") }}', function (result) {

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

            var data = {
              labels: namasatker,
              datasets: [{
                label: jnsblnj[0],
                backgroundColor: "blue",
                data: data51
              }, {
                label: jnsblnj[1],
                backgroundColor: "red",
                data: data52
              }, {
                label: jnsblnj[2],
                backgroundColor: "green",
                data: data53
              }]
            };


            var ctx = document.getElementById("chartbelanja_fm").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        $.getJSON('{{ url("/get_spm/5") }}', function (result) {

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Pengajuan",
                backgroundColor: "blue",
                data: nilai_pengajuan
              }, {
                label: "SPM",
                backgroundColor: "red",
                data: nilai_spm
              }, {
                label: "SP2D",
                backgroundColor: "green",
                data: nilai_sp2d
              }]
            };


            var ctx = document.getElementById("chartSPM_fm").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        // pengadaan 
        $.getJSON('{{ url("/get_pengadaaneselondua/5") }}', function (result) {

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }


            var data = {
              labels: nama_satker,
              datasets: [
              {
                label: "Alokasi",
                backgroundColor: "blue",
                data: alokasi,
              },
              {
                label: "Nilai Kontrak",
                backgroundColor: "yellow",
                data: nilai_kontrak,
              },
              {
                label: "Pencarian Kontrak",
                backgroundColor: "green",
                data: pencairan,
              },]
            };


            var ctx = document.getElementById("chartpengadaan_fm").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

            //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/5") }}', function (result) {

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }


            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Alokasi",
                backgroundColor: "green",
                data: alokasi,
              },{
                label: "Realisasi",
                backgroundColor: "blue",
                data: realisasi,
              }]
            };


            var ctx = document.getElementById("chartTupoksi_fm").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

            //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/5") }}', function (result) {

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }


            var data = {
              labels: kode_satker,
              datasets: [{
                label: "Alokasi RM",
                backgroundColor: "green",
                data: alokasi_rm,
              },{
                label: "Rupiah Murni",
                backgroundColor: "blue",
                data: rm,
              },{
                label: "Alokasi PNBP",
                backgroundColor: "yellow",
                data: alokasi_pnbp,
              },{
                label: "PNBP",
                backgroundColor: "red",
                data: pnbp,
              }]
            };


            var ctx = document.getElementById("chartRm_fm").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
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

            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            var ctx = $("#chartRealisasi_penalkes").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }


            var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               data1,data2
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Sisa Anggaran"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };

            var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/1") }}', function (result) {

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

            var data = {
              labels: namasatker,
              datasets: [{
                label: jnsblnj[0],
                backgroundColor: "blue",
                data: data51
              }, {
                label: jnsblnj[1],
                backgroundColor: "red",
                data: data52
              }, {
                label: jnsblnj[2],
                backgroundColor: "green",
                data: data53
              }]
            };


            var ctx = document.getElementById("chartbelanja_penalkes").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        // pengadaan 
        $.getJSON('{{ url("/get_pengadaaneselondua/2") }}', function (result) {

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }


            var data = {
              labels: nama_satker,
              datasets: [
              {
                label: "Alokasi",
                backgroundColor: "blue",
                data: alokasi,
              },
              {
                label: "Nilai Kontrak",
                backgroundColor: "yellow",
                data: nilai_kontrak,
              },
              {
                label: "Pencarian Kontrak",
                backgroundColor: "green",
                data: pencairan,
              },]
            };


            var ctx = document.getElementById("chartpengadaan_penalkes").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });


        $.getJSON('{{ url("/get_spm/1") }}', function (result) {

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Pengajuan",
                backgroundColor: "blue",
                data: nilai_pengajuan
              }, {
                label: "SPM",
                backgroundColor: "red",
                data: nilai_spm
              }, {
                label: "SP2D",
                backgroundColor: "green",
                data: nilai_sp2d
              }]
            };


            var ctx = document.getElementById("chartSPM_penalkes").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/1") }}', function (result) {

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }


            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Alokasi",
                backgroundColor: "green",
                data: alokasi,
              },{
                label: "Realisasi",
                backgroundColor: "blue",
                data: realisasi,
              }]
            };


            var ctx = document.getElementById("chartTupoksi_penalkes").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/1") }}', function (result) {

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }


            var data = {
              labels: kode_satker,
              datasets: [{
                label: "Alokasi RM",
                backgroundColor: "green",
                data: alokasi_rm,
              },{
                label: "Rupiah Murni",
                backgroundColor: "blue",
                data: rm,
              },{
                label: "Alokasi PNBP",
                backgroundColor: "yellow",
                data: alokasi_pnbp,
              },{
                label: "PNBP",
                backgroundColor: "red",
                data: pnbp,
              }]
            };


            var ctx = document.getElementById("chartRm_penalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
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

            var data1 = [] , data2 = [];
            var nilaiAlokasi = 0 , nilaiRealisasi = 0 , nilaiSisa = 0;
            var percentRealisasi = 0 , percentSisa = 0;
            var len = result.length;
            var ctx = $("#chartRealisasi_wasalkes").get(0).getContext("2d");

            for (var i = 0; i < len; i++) {

                nilaiAlokasi = result[i].alokasi;
                nilaiRealisasi = result[i].realisasi;
                nilaiSisa = result[i].sisa;

                percentRealisasi = ((nilaiRealisasi / nilaiAlokasi) * 100).toFixed(2);
                percentSisa = ((nilaiSisa / nilaiAlokasi) * 100).toFixed(2);

                data1.push(percentRealisasi);
                data2.push(percentSisa);
            }


            var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               data1,data2
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Sisa Anggaran"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };

            var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $.getJSON('{{ url("/getjenisbelanjaeselondua/2") }}', function (result) {

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

            var data = {
              labels: namasatker,
              datasets: [{
                label: jnsblnj[0],
                backgroundColor: "blue",
                data: data51
              }, {
                label: jnsblnj[1],
                backgroundColor: "red",
                data: data52
              }, {
                label: jnsblnj[2],
                backgroundColor: "green",
                data: data53
              }]
            };


            var ctx = document.getElementById("chartbelanja_wasalkes").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        // pengadaan 
        $.getJSON('{{ url("/get_pengadaaneselondua/1") }}', function (result) {

            var nama_satker = [] , alokasi = [] , nilai_kontrak = [] , pencairan = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_satker);
                alokasi.push(result[i].alokasi);
                nilai_kontrak.push(result[i].nilai_kontrak);
                pencairan.push(result[i].pencairan_kontrak);
            }


            var data = {
              labels: nama_satker,
              datasets: [
              {
                label: "Alokasi",
                backgroundColor: "blue",
                data: alokasi,
              },
              {
                label: "Nilai Kontrak",
                backgroundColor: "yellow",
                data: nilai_kontrak,
              },
              {
                label: "Pencarian Kontrak",
                backgroundColor: "green",
                data: pencairan,
              },]
            };


            var ctx = document.getElementById("chartpengadaan_wasalkes").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

        $.getJSON('{{ url("/get_spm/2") }}', function (result) {

            var nama_satker =[] , nilai_alokasi = [] , nilai_pengajuan = [] , nilai_spm = [] , nilai_sp2d = [];

            for (var i = 0; i < result.length; i++) {
                 
                nama_satker.push(result[i].nama_singkat);
                nilai_alokasi.push(result[i].alokasi);
                nilai_pengajuan.push(result[i].Pengajuan);
                nilai_spm.push(result[i].spm);
                nilai_sp2d.push(result[i].sp2d);


                }

            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Pengajuan",
                backgroundColor: "blue",
                data: nilai_pengajuan
              }, {
                label: "SPM",
                backgroundColor: "red",
                data: nilai_spm
              }, {
                label: "SP2D",
                backgroundColor: "green",
                data: nilai_sp2d
              }]
            };


            var ctx = document.getElementById("chartSPM_wasalkes").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Tupoksi Ses
        $.getJSON('{{ url("/get_tupoksi_eselon_dua/2") }}', function (result) {

            var nama_satker = [] , alokasi = [] , realisasi = [] ;

            for (var i = 0; i < result.length; i++) {
                nama_satker.push(result[i].nama_singkat);
                alokasi.push(result[i].alokasi);
                realisasi.push(result[i].realisasi);
            }


            var data = {
              labels: nama_satker,
              datasets: [{
                label: "Alokasi",
                backgroundColor: "green",
                data: alokasi,
              },{
                label: "Realisasi",
                backgroundColor: "blue",
                data: realisasi,
              }]
            };


            var ctx = document.getElementById("chartTupoksi_wasalkes").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });
            //Rm & Pnbp Ses
        $.getJSON('{{ url("/realisasi_pnbp_eselon_dua/2") }}', function (result) {

            var kode_satker = [] , alokasi_rm = [] , rm = [] ,alokasi_pnbp =[], pnbp = [];

            for (var i = 0; i < result.length; i++) {
                kode_satker.push(result[i].nama_satker);
                alokasi_rm.push(parseFloat(result[i].alokasi_rm)/1000000);
                alokasi_pnbp.push(parseFloat(result[i].alokasi_pnbp)/1000000);
                rm.push(parseFloat(result[i].rm) / 1000000);
                pnbp.push(result[i].pnbp);
            }


            var data = {
              labels: kode_satker,
              datasets: [{
                label: "Alokasi RM",
                backgroundColor: "green",
                data: alokasi_rm,
              },{
                label: "Rupiah Murni",
                backgroundColor: "blue",
                data: rm,
              },{
                label: "Alokasi PNBP",
                backgroundColor: "yellow",
                data: alokasi_pnbp,
              },{
                label: "PNBP",
                backgroundColor: "red",
                data: pnbp,
              }]
            };


            var ctx = document.getElementById("chartRm_wasalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        },
                    } 
                    },
                    barValueSpacing: 20, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            }
                        }]
                    }
                }
            });
        });

    </script>
@stop