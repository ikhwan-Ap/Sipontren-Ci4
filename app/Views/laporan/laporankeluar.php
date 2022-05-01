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
                    <div class="card-icon bg-danger">
                        <i class="ion ion-cash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pengeluaran</h4>
                        </div>
                        <div class="card-body">

                            <?php foreach ($pengeluaran as $p) :  ?>
                                <?= "Rp " . number_format($p['jumlah_pengeluaran'], 2, ',', '.'); ?>
                                </h3>
                            <?php endforeach;  ?>
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
                        <h4>Print Data Pengeluaran</h4>
                    </div>
                    <form action="<?= base_url(); ?>/pembayaran/filter_laporankeluar" method="POST" class="inline">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col">
                                        <label for="tgl_mulai">Tanggal Awal</label>
                                        <input type="date" name="tgl_mulai" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="tgl_akhir">Tanggal Akhir</label>
                                        <input type="date" name="tgl_selesai" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="tgl_akhir">Pilih Jenis Pengeluaran</label>
                                        <select name="nama_pengeluaran" id="nama_pengeluaran" class="form-control">
                                            <?php foreach ($keluar as $p) : ?>
                                                <option value="" hidden></option>
                                                <option value="<?= $p['nama_pengeluaran']; ?>"><?= $p['nama_pengeluaran']; ?></option>
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
                                            echo '<a href="/laporan/print_pengeluaran/' . $tanggal['tgl_mulai'] . '/' . $tanggal['tgl_selesai'] . '/' . $tanggal['nama_pengeluaran'] . '"target="_blank" class="form-control btn btn-primary">
                                        <span class="ion ion-android-print" data-pack="android" data-tags="">Print</span>
                                        </a>';
                                        } else {
                                            echo '<a href="/laporan/print_pengeluaran" target ="_blank" class="form-control btn btn-primary">
                                        <span class="ion ion-android-print" data-pack="android" data-tags="">Print</span>
                                        </a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pengeluaran</th>
                                        <th>Jumlah Pengeluaran</th>
                                        <th>Bulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($data as $k) :

                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $k['nama_pengeluaran']; ?></td>
                                            <td> <?= "Rp " . number_format($k['jumlah_pengeluaran'], 2, ',', '.'); ?></td>
                                            <td><?= date('d-M-Y', strtotime($k["waktu_pengeluaran"]));; ?></td>
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
        var nama_pengeluaran = $('#nama_pengeluaran').val();
        if (tgl_mulai !== null && tgl_selesai !== null && nama_pengeluaran !== null) {
            $('#link-print').attr('href', '/laporan/print/' + tgl_mulai + '/' + tgl_selesai + '/' + nama_pengeluaran);
            $('#link-print').show();
        }
    });
    $('#nama_pengeluaran').change(function() {
        var tgl_mulai = $('#tgl_mulai').val();
        var tgl_selesai = $('#tgl_selesai').val();
        var nama_pengeluaran = $('#nama_pengeluaran').val();
        if (tgl_mulai !== null && tgl_selesai !== null && nama_pengeluaran !== null) {
            $('#link-print').attr('href', '/laporan/print/' + tgl_mulai + '/' + tgl_selesai + '/' + nama_pengeluaran);
            $('#link-print').show();
        }
    });
</script>
<?= $this->endSection(); ?>