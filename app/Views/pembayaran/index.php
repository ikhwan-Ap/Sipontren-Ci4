<?php

use App\Controllers\Pembayaran;
?>
<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/pembayaran/add" class="btn btn-primary">Tambah Data </a>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembayaran</h4>
                    </div>
                    <form action="<?= base_url(); ?>/pembayaran/filter" method="POST" class="inline">
                        <?= csrf_field(); ?>
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
                                    <label for="tgl_akhir">Pilih Status</label>
                                    <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                                        <option value="" hidden></option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
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
                    </form>
                    <div class=" card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>nis</th>
                                        <th>nama santri</th>
                                        <th>Pembayaran</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Waktu Input</th>
                                        <th>Bulan Pembayaran</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $hariIni = new DateTime();
                                    foreach ($Lunas as $k) :
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $k['nis']; ?></td>
                                            <td><?= $k['nama_lengkap']; ?></td>
                                            <td><?= $k['nama_pembayaran']; ?></td>
                                            <td><?= $k['jumlah_pembayaran']; ?></td>
                                            <td> <?= date('d-M-Y', strtotime($k['waktu'])) ?></td>
                                            <td> <?= $k['bulan']; ?></td>
                                            <td><?= $k['status_pembayaran']; ?></td>


                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $k['id_keuangan']; ?>">
                                                    Hapus
                                                </button>
                                                <?php if ($k['status_pembayaran'] == 'Lunas') {
                                                    echo '';
                                                } else { ?>
                                                    <a href="/pembayaran/bayar/<?= $k['id_keuangan']; ?>" class="btn btn-success">Bayar</a>
                                                <?php } ?>
                                            </td>
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
                                                        <form action="/pembayaran/<?= $k['id_keuangan']; ?>" method="POST">
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