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
                    <li><a href="#tab_2" data-toggle="tab">SesDitJen</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Dit. Oblik</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Dit. Yanfar</a></li>
                    <li><a href="#tab_5" data-toggle="tab">Dit. Prodisfar</a></li>
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
                
                $('#tbl_pagu_anggaran').append('<tr><td>'+ result[i].kode+'</td><td>'+ result[i].nama +'</td><td>'+ result[i].alokasi.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</td><td class="text-right">'+ result[i].realisasi.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +'</td><td class="text-right">'+ percent.toFixed(2) +'</td></tr>');
            }
        });

        $.getJSON('{{ url("/getpie") }}', function (result) {

            var data1 = [] , data2 = [];
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
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                }
              }
            });
        });

        // JENIS BELANJA
        $(document).ready(function(){
            var data = {
              labels: ["Penalkes" , "Wasalkes" , "SesDitJen" , "Yanfar" , "Prodisfar", "Oblik"],
              datasets: [{
                label: "Pengajuan",
                backgroundColor: "blue",
                data: [60,60,60,60,60,60]
              }, {
                label: "SPM",
                backgroundColor: "red",
                data: [50,50,50,50,50,50]
              }, {
                label: "SP2D",
                backgroundColor: "green",
                data: [40,40,40,40,40,40]
              }]
            };


            var ctx = document.getElementById("chartspmsp2d").getContext("2d");


            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
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
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
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


            var ctx = document.getElementById("chartrmpnbp").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                }
              }
            });
        });

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

        $(document).ready(function(){
            
        });

        // TAB SESDITJEN
            // Grafik Line RPD , RPD Revisi , Realisasi
        $(document).ready(function(){
            var ctx = $("#chartrpd_ses"); 
            var data = {
                labels: ["Jan", "Feb" , "Mar" , "Apr" , "Mei" , "Jun" , "Jul" , "Ags" , "Sep" , "Okt" , "Nov" , "Des" ],
                datasets: [
                    {
                        label: "RPD",
                        data: [0 , 10 , 15 , 20 , 25 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: [0 , 15 , 20 , 25 , 30 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: [0 , 20 , 25 , 30 , 35 , 40 , 45 , 65 , 70 , 80 , 90 , 100],
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
        $(document).ready(function(){
             var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               55,45
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Saldo"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };
                var ctx = $("#chartRealisasi_ses").get(0).getContext("2d");
                var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $(document).ready(function(){
            var data = {
              labels: ["Belanja Pegawai" , "Belanja Barang" , "Belanja Modal"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartbelanja_ses").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

        $(document).ready(function(){
            var data = {
              labels: ["Usulan" , "SPM" , "SP2D"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartSPM_ses").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Tupoksi Ses
        $(document).ready(function(){
            var data = {
              labels: ["Tupoksi" , "Pencairan Kontrak" , "Nilai Kontrak"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartTupoksi_ses").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Rm & Pnbp Ses
        $(document).ready(function(){
            var data = {
              labels: ["Rupiah Murni" , "PNBP" ],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [80,10]
              }]
            };


            var ctx = document.getElementById("chartRm_ses").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

// TAB OBLIK
            // Grafik Line RPD , RPD Revisi , Realisasi
        $(document).ready(function(){
            var ctx = $("#chartrpd_oblik"); 
            var data = {
                labels: ["Jan", "Feb" , "Mar" , "Apr" , "Mei" , "Jun" , "Jul" , "Ags" , "Sep" , "Okt" , "Nov" , "Des" ],
                datasets: [
                    {
                        label: "RPD",
                        data: [0 , 10 , 15 , 20 , 25 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: [0 , 15 , 20 , 25 , 30 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: [0 , 20 , 25 , 30 , 35 , 40 , 45 , 65 , 70 , 80 , 90 , 100],
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
        $(document).ready(function(){
             var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               55,45
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Saldo"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };
                var ctx = $("#chartRealisasi_oblik").get(0).getContext("2d");
                var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $(document).ready(function(){
            var data = {
              labels: ["Belanja Pegawai" , "Belanja Barang" , "Belanja Modal"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartbelanja_oblik").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

        $(document).ready(function(){
            var data = {
              labels: ["Usulan" , "SPM" , "SP2D"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartSPM_oblik").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Tupoksi Ses
        $(document).ready(function(){
            var data = {
              labels: ["Tupoksi" , "Pencairan Kontrak" , "Nilai Kontrak"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartTupoksi_oblik").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Rm & Pnbp Ses
        $(document).ready(function(){
            var data = {
              labels: ["Rupiah Murni" , "PNBP" ],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [80,10]
              }]
            };


            var ctx = document.getElementById("chartRm_oblik").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

        // TAB yanfar
            // Grafik Line RPD , RPD Revisi , Realisasi
        $(document).ready(function(){
            var ctx = $("#chartrpd_yanfar"); 
            var data = {
                labels: ["Jan", "Feb" , "Mar" , "Apr" , "Mei" , "Jun" , "Jul" , "Ags" , "Sep" , "Okt" , "Nov" , "Des" ],
                datasets: [
                    {
                        label: "RPD",
                        data: [0 , 10 , 15 , 20 , 25 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: [0 , 15 , 20 , 25 , 30 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: [0 , 20 , 25 , 30 , 35 , 40 , 45 , 65 , 70 , 80 , 90 , 100],
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
        $(document).ready(function(){
             var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               55,45
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Saldo"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };
                var ctx = $("#chartRealisasi_yanfar").get(0).getContext("2d");
                var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $(document).ready(function(){
            var data = {
              labels: ["Belanja Pegawai" , "Belanja Barang" , "Belanja Modal"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartbelanja_yanfar").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

        $(document).ready(function(){
            var data = {
              labels: ["Usulan" , "SPM" , "SP2D"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartSPM_yanfar").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Tupoksi Ses
        $(document).ready(function(){
            var data = {
              labels: ["Tupoksi" , "Pencairan Kontrak" , "Nilai Kontrak"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartTupoksi_yanfar").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Rm & Pnbp Ses
        $(document).ready(function(){
            var data = {
              labels: ["Rupiah Murni" , "PNBP" ],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [80,10]
              }]
            };


            var ctx = document.getElementById("chartRm_yanfar").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

    // TAB FM
            // Grafik Line RPD , RPD Revisi , Realisasi
        $(document).ready(function(){
            var ctx = $("#chartrpd_fm"); 
            var data = {
                labels: ["Jan", "Feb" , "Mar" , "Apr" , "Mei" , "Jun" , "Jul" , "Ags" , "Sep" , "Okt" , "Nov" , "Des" ],
                datasets: [
                    {
                        label: "RPD",
                        data: [0 , 10 , 15 , 20 , 25 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: [0 , 15 , 20 , 25 , 30 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: [0 , 20 , 25 , 30 , 35 , 40 , 45 , 65 , 70 , 80 , 90 , 100],
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
        $(document).ready(function(){
             var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               55,45
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Saldo"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };
                var ctx = $("#chartRealisasi_fm").get(0).getContext("2d");
                var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $(document).ready(function(){
            var data = {
              labels: ["Belanja Pegawai" , "Belanja Barang" , "Belanja Modal"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartbelanja_fm").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

        $(document).ready(function(){
            var data = {
              labels: ["Usulan" , "SPM" , "SP2D"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartSPM_fm").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Tupoksi Ses
        $(document).ready(function(){
            var data = {
              labels: ["Tupoksi" , "Pencairan Kontrak" , "Nilai Kontrak"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartTupoksi_fm").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Rm & Pnbp Ses
        $(document).ready(function(){
            var data = {
              labels: ["Rupiah Murni" , "PNBP" ],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [80,10]
              }]
            };


            var ctx = document.getElementById("chartRm_fm").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

        // TAB penalkes
            // Grafik Line RPD , RPD Revisi , Realisasi
        $(document).ready(function(){
            var ctx = $("#chartrpd_penalkes"); 
            var data = {
                labels: ["Jan", "Feb" , "Mar" , "Apr" , "Mei" , "Jun" , "Jul" , "Ags" , "Sep" , "Okt" , "Nov" , "Des" ],
                datasets: [
                    {
                        label: "RPD",
                        data: [0 , 10 , 15 , 20 , 25 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: [0 , 15 , 20 , 25 , 30 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: [0 , 20 , 25 , 30 , 35 , 40 , 45 , 65 , 70 , 80 , 90 , 100],
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
        $(document).ready(function(){
             var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               55,45
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Saldo"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };
                var ctx = $("#chartRealisasi_penalkes").get(0).getContext("2d");
                var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $(document).ready(function(){
            var data = {
              labels: ["Belanja Pegawai" , "Belanja Barang" , "Belanja Modal"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartbelanja_penalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

        $(document).ready(function(){
            var data = {
              labels: ["Usulan" , "SPM" , "SP2D"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartSPM_penalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Tupoksi Ses
        $(document).ready(function(){
            var data = {
              labels: ["Tupoksi" , "Pencairan Kontrak" , "Nilai Kontrak"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartTupoksi_penalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Rm & Pnbp Ses
        $(document).ready(function(){
            var data = {
              labels: ["Rupiah Murni" , "PNBP" ],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [80,10]
              }]
            };


            var ctx = document.getElementById("chartRm_penalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

        // TAB wsalkes
            // Grafik Line RPD , RPD Revisi , Realisasi
        $(document).ready(function(){
            var ctx = $("#chartrpd_wasalkes"); 
            var data = {
                labels: ["Jan", "Feb" , "Mar" , "Apr" , "Mei" , "Jun" , "Jul" , "Ags" , "Sep" , "Okt" , "Nov" , "Des" ],
                datasets: [
                    {
                        label: "RPD",
                        data: [0 , 10 , 15 , 20 , 25 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "blue",
                        borderColor: "blue",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "RPD Revisi",
                        data: [0 , 15 , 20 , 25 , 30 , 40 , 50 , 60 , 70 , 80 , 90 , 100],
                        backgroundColor: "Orange",
                        borderColor: "Orange",
                        fill: false,
                        lineTension: 0,
                        radius: 5
                    },
                    {
                        label: "Realisasi",
                        data: [0 , 20 , 25 , 30 , 35 , 40 , 45 , 65 , 70 , 80 , 90 , 100],
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
        $(document).ready(function(){
             var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "DATA",
                            data: [
                               55,45
                            ],
                            backgroundColor: [
                                "blue",
                                "red",
                            ]
                        }],
                        labels: [
                            "Realisasi",
                            "Saldo"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };
                var ctx = $("#chartRealisasi_wasalkes").get(0).getContext("2d");
                var myPieChart = new Chart(ctx, config);
        });
            // Realisasi Per Belanja
        $(document).ready(function(){
            var data = {
              labels: ["Belanja Pegawai" , "Belanja Barang" , "Belanja Modal"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartbelanja_wasalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

        $(document).ready(function(){
            var data = {
              labels: ["Usulan" , "SPM" , "SP2D"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartSPM_wasalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Tupoksi Ses
        $(document).ready(function(){
            var data = {
              labels: ["Tupoksi" , "Pencairan Kontrak" , "Nilai Kontrak"],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [40,50,10]
              }]
            };


            var ctx = document.getElementById("chartTupoksi_wasalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });
            //Rm & Pnbp Ses
        $(document).ready(function(){
            var data = {
              labels: ["Rupiah Murni" , "PNBP" ],
              datasets: [{
                label: "Realisasi",
                backgroundColor: "blue",
                data: [80,10]
              }]
            };


            var ctx = document.getElementById("chartRm_wasalkes").getContext("2d");
            var myBarChart = new Chart(ctx, {
              type: 'bar',
              data: data,
              options: {
                barValueSpacing: 20,
                scales: {
                  yAxes: [{
                    ticks: {
                      min: 0,
                    }
                  }]
                },
                legend : false
              }
            });
        });

    </script>
@stop