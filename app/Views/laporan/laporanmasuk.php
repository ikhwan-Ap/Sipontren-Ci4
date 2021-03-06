<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="ion ion-cash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pemasukan</h4>
                        </div>
                        <div class="card-body">
                            <?php foreach ($Lunas as $l) :  ?>
                                <?= "Rp " . number_format($l['jumlah_bayar'], 2, ',', '.'); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Print Data Pemasukan</h4>
                    </div>

                    <form action="<?php base_url(); ?>/laporanmasuk/filter" id="formlaporan" method="POST" class="inline">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col">
                                        <label for="tgl_mulai">Tanggal Awal</label>
                                        <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="tgl_akhir">Tanggal Akhir</label>
                                        <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="tgl_akhir">Pilih Jenis Pembayaran</label>
                                        <select name="nama_pembayaran" id="nama_pembayaran" class="form-control">
                                            <?php foreach ($tagihan as $t) : ?>
                                                <option value="" hidden></option>
                                                <option value="<?= $t['nama_pembayaran']; ?>"><?= $t['nama_pembayaran']; ?></option>
                                            <?php endforeach;  ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="">Pilih</label>
                                        <button type="submit" name="filter" value="Filter" class="form-control btn btn-info">Filter Data</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="">Pilih</label>
                                        <?php
                                        if ($tanggal != null) {
                                            echo '<a href="/laporan/print/' . $tanggal['tgl_mulai'] . '/' . $tanggal['tgl_selesai'] . '/' . $tanggal['nama_pembayaran'] . '"target="_blank" class="form-control btn btn-primary">
                                        <span class="ion ion-android-print" data-pack="android" data-tags="">Print</span>
                                        </a>';
                                        } else {
                                            echo '<a href="/laporan/print" target ="_blank" class="form-control btn btn-primary"><span class="ion ion-android-print" data-pack="android" data-tags="">Print</span></a>';
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIS</th>
                                    <th>Nama Santri</th>
                                    <th>Nama Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Jumlah Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($pendapatan as $k) :

                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $k['nis']; ?></td>
                                        <td><?= $k['nama_lengkap']; ?></td>
                                        <td><?= $k['nama_pembayaran']; ?></td>
                                        <td><?= date('d-m-Y', strtotime($k["waktu"]));; ?></td>
                                        <td> <?= "Rp " . number_format($k['jumlah_bayar'], 2, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script>
    $('input[type=date]').change(function() {
        var tgl_mulai = $('#tgl_mulai').val();
        var tgl_selesai = $('#tgl_selesai').val();
        var nama_pembayaran = $('#nama_pembayaran').val();
        if (tgl_mulai !== null && tgl_selesai !== null && nama_pembayaran !== null) {
            $('#link-print').attr('href', '/laporan/print/' + tgl_mulai + '/' + tgl_selesai + '/' + nama_pembayaran);
            $('#link-print').show();
        }
    });
    $('#nama_pembayaran').change(function() {
        var tgl_mulai = $('#tgl_mulai').val();
        var tgl_selesai = $('#tgl_selesai').val();
        var nama_pembayaran = $('#nama_pembayaran').val();
        if (tgl_mulai !== null && tgl_selesai !== null && nama_pembayaran !== null) {
            $('#link-print').attr('href', '/laporan/print/' + tgl_mulai + '/' + tgl_selesai + '/' + nama_pembayaran);
            $('#link-print').show();
        }
    });
</script>

<?= $this->endSection(); ?>