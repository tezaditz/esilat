<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 10/23/2017
 * Time: 05:13 PM
 */
?>
<form class="form-horizontal">
    <div class="row">
        <div class="col-md-6">
            <?php $noaju = $perjadin->no_pengajuan; ?>
            @if(strlen($noaju) == 1)
                <?php $noaju = '00' . $noaju; ?>
            @elseif(strlen($noaju) == 2)
                <?php $noaju = '0' . $noaju; ?>
            @endif
            <div class="form-group">
                <label for="no_pengajuan" class="col-sm-3 control-label">No. AJU</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_pengajuan" value="AJU-{{ $noaju }}/{{ $perjadin->bagian->kode }}/{{ $perjadin->thn_anggaran }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="posisi_dokumen" class="col-sm-3 control-label">Posisi
                    Dokumen</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="posisi_dokumen" value="{{ $perjadin->status->posisi_dokumen }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="keterangan" class="col-sm-3 control-label">Status</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="keterangan" value="{{ $perjadin->status->keterangan }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_bagian" class="col-sm-3 control-label">Bagian</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_bagian" value="{{ $perjadin->bagian->nama_bagian }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="no_mak" class="col-sm-3 control-label">No. MAK</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_mak" value="{{ $perjadin->no_mak }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama_kegiatan" class="col-sm-3 control-label">Kegiatan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="nama_kegiatan" rows="2" readonly>{{ $perjadin->nama_kegiatan }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="pelaksanaan" class="col-sm-3 control-label">Pelaksanaan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="pelaksanaan" value="{{ date('d', strtotime($perjadin->tgl_awal)) }} s.d {{ date('d M Y', strtotime($perjadin->tgl_akhir)) }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Provinsi Tujuan:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" value="{{ $perjadin->provinsi->title }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Daerah Tujuan:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" value="{{ $perjadin->kabkota->nama }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="total_pengajuan" class="col-sm-3 control-label">Total
                    Pengajuan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="total_pengajuan" value="Rp. {{ number_format($perjadin->total_pengajuan, 0, ',', '.') }}" readonly>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-xs-12">
        <hr>
        <a href="{{ route('pertanggungjawaban.perjadin-dalam-negeri.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
    </div>
</div>