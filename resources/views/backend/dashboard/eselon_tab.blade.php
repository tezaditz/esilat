<div class="row">
  

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">RENCANA PENARIKAN DANA (RPD)</h3>

                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                <div id="canvas-holder1" class="text-center" style="width: 100%">
                <canvas id="chartrpd"></canvas>
                
                </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">PAGU ANGGARAN</h3>

                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <table class="table table-bordered" id="tabelPaguAnggaran_sesditjen">
                        <thead>
                            <tr class="success">
                                <th class="text-center">Kode Satker</th>
                                <th class="text-center">Nama Satker</th>
                                <th class="text-center">Alokasi</th>
                                <th class="text-center">Realisasi (Rp.)</th>
                                <th class="text-center">Realisasi (%)</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_pagu_anggaran">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">REALISASI</h3>

                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div id="canvas-holder" class="text-center" style="width: 100%">
                <!-- <canvas id="mycanvas"></canvas> -->
                <!-- <div id="js-legend" class="chart-legend"></div> -->
                <!-- <div id="container" style="width:100%; "></div> -->
                <div class="chart">
                <div id="container" style="width:100%; height:400px;"></div>
                
                </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">REALISASI PERJENIS BELANJA</h3>

                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                <div id="canvas-holder1" class="text-center" style="width: 100%">
                <!-- <canvas id="chartRealisasi"></canvas> -->
                    <div id="chartRealisasi" style="width:100%;"></div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">REALISASI SPM SP2D *</h3>

                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <div id="canvas-holder1" class="text-center" style="width: 100%">
                    <!-- <canvas id="chartspmsp2d"></canvas> -->
                        <div id="chartspmsp2d" style="width:100%;"></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">REALISASI RUPIAH MURNI & PNBP *</h3>

                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <table class="table table-bordered" id="tabelpnpb">
                        <thead>
                            <tr class="success">
                                <th class="text-center">Kode Satker</th>
                                <th class="text-center">Nama Satker</th>
                                <th class="text-center">Alokasi RM</th>
                                <th class="text-center">Rupiah Murni</th>
                                <th class="text-center">Alokasi PNPB</th>
                                <th class="text-center">PNPB</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_pnpb">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">REALISASI TUPOKSI</h3>

                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <div id="canvas-holder1" class="text-center" style="width: 100%">
                    <!-- <canvas id="charttupoksi"></canvas> -->
                    <div id="charttupoksi" style="width:100%;"></div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">REALISASI PENGADAAN</h3>

                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                <div id="canvas-holder1" class="text-center" style="width: 100%">
                <!-- <canvas id="chartpengadaan"></canvas> -->
                    <div id="chartpengadaan" style="width:100%;"></div>
                
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
