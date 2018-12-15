<div class="row">
    @if($data_perjadins->count() > 0)
        @foreach($data_perjadins as $key => $data_perjadin)
            <div class="col-md-6">
                <table class="table table-responsive table-hover table-bordered">
                    <tr>
                        <th class="bg-green color-palette" colspan="4">
                            {{ $data_perjadin->nama_pelaksana }}
                            <a href="{{ route('pertanggungjawaban.perjadin-dalam-negeri.draft-perjadin.kuitansi-rill', $data_perjadin->id) }}" class="btn btn-default btn-flat btn-xs pull-right" target="_blank"><i class="fa fa-print"></i> </a>
                        </th>
                    </tr>
                    <tr>
                        <th>Uraian</th>
                        <th>Pengajuan</th>
                        <th>Pertanggungjawaban</th>
                        <th>Dikembalikan</th>
                    </tr>
                    @foreach($jenisbiayaperjadins as $jenisbiayaperjadin)
                        @if($jenisbiayaperjadin->name == 'Tiket Pesawat')
                            <?php
                            $nilai2 = $data_perjadin->pesawat;
                            $nilai3 = $data_perjadin->pj_pesawat;
                            ?>
                        @elseif($jenisbiayaperjadin->name == 'Transport / Taksi')
                            <?php
                            $nilai2 = $data_perjadin->taksi_provinsi;
                            $nilai3 = $data_perjadin->pj_taksi_provinsi;
                            ?>
                        @elseif($jenisbiayaperjadin->name == 'Transport / Taksi (Kab / Kota)')
                            <?php
                            $nilai2 = $data_perjadin->taksi_kab_kota;
                            $nilai3 = $data_perjadin->pj_taksi_kab_kota;
                            ?>
                        @elseif($jenisbiayaperjadin->name == 'Uang Harian')
                            <?php
                            $nilai2 = $data_perjadin->uang_harian;
                            $nilai3 = $data_perjadin->pj_uang_harian;
                            ?>
                        @elseif($jenisbiayaperjadin->name == 'Penginapan')
                            <?php
                            $nilai2 = $data_perjadin->penginapan;
                            $nilai3 = $data_perjadin->pj_penginapan;
                            ?>
                        @elseif($jenisbiayaperjadin->name == 'Registrasion Fee')
                            <?php
                            $nilai2 = $data_perjadin->registration;
                            $nilai3 = $data_perjadin->pj_registration;
                            ?>
                        @endif

                        <tr>
                            <td>{{ $jenisbiayaperjadin->name }}</td>
                            <td class="text-right">{{ number_format($nilai2, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($nilai3, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($nilai2 - $nilai3, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th class="text-right">Total:</th>
                        <th class="text-right">{{ number_format($data_perjadin->total, 0, ',', '.') }}</th>
                        <th class="text-right">{{ number_format($data_perjadin->total_pj, 0, ',', '.') }}</th>
                        <th class="text-right">{{ number_format($data_perjadin->total - $data_perjadin->total_pj, 0, ',', '.') }}</th>
                    </tr>
                </table>
            </div>
        @endforeach
    @else
        <div class="text-center">
            <br><br>
            <i class="fa fa-exclamation-triangle fa-2x"></i>
            <h4 class="no-margins">Tidak ada Pelaksana yg teregistrasi.</h4>
            <br><br>
        </div>
    @endif
</div>