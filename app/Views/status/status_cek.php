<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/pembayaran/add" class="btn btn-primary">Tambah Data </a>
        </div>
        <div class="section-header-button">
            <a href="/status_cek" class="btn btn-primary">Cek Santri</a>
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
                    <div class=" card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Bulan Pembayaran</th>
                                        <th>Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($hasil as $p) :
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $p['tagihan']; ?></td>
                                            <td><?= $p['bulan']; ?></td>
                                            <td><?= $p['pembayaran']; ?></td>
                                            <td>
                                                <?php if ($p['status'] == 'Lunas') : ?>
                                                    <a href="" class="badge badge-success"><?= $p['status']; ?></a>
                                                <?php elseif ($p['status'] == 'Belum Lunas') : ?>
                                                    <a href="" class="badge badge-danger"><?= $p['status']; ?></a>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <?php if ($p['status'] == 'Lunas') {
                                                echo '';
                                            } else { ?>
                                                <a href="/pembayaran/bayar/<?= $p['tagihan']; ?>" class="btn btn-primary">Bayar</a>
                                            <?php } ?>
                                        </td>
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
<?= $this->endSection(); ?>