<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>


    <?php if (session()->getFlashdata('message') != null) :  ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <?= session()->getFlashdata('message'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-10">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-money-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Anggaran Tersedia</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $sisa = $Total - $pengeluaran;

                            ?>
                            <?= "Rp " . number_format($sisa, 2, ',', '.'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="ion ion-cash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pemasukan</h4>
                        </div>
                        <div class="card-body">
                            <?php foreach ($Lunas as $l) : ?>
                                <?= "Rp " . number_format($l['jumlah_bayar'], 2, ',', '.');  ?>
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
                        <h4>Data Pemasukan</h4>
                    </div>

                    <form action="<?= base_url(); ?>/pembayaran/filter_pemasukan" method="POST" class="inline">
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
                            </div>
                        </div>
                    </form>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pembayaran</th>
                                        <th>Jumlah Pemasukan</th>
                                        <th>Bulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($pendapatan as $k) :

                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $k['nama_pembayaran']; ?></td>
                                            <td><?= "Rp " . number_format($k['jumlah_bayar'], 2, ',', '.'); ?></td>
                                            <td><?= date('d-M-Y', strtotime($k["waktu"]));; ?></td>
                                        </tr>

                                        <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $k['id_keuangan']; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Peringatan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah data ini akan dihapus?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="/pembayaran/pendaftaran<?= $k['id_keuangan']; ?>" method="POST">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger">Ya</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
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
<?= $this->endSection(); ?>