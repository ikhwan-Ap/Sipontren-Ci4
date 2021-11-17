<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Santri Baru</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Santri</th>
                                <th>Alamat</th>
                                <th>No. HP Santri</th>
                                <th>Nama Ayah</th>
                                <th>Pekerjaan Orang Tua</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($santri as $s) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $s['nama_lengkap']; ?></td>
                                    <td><?= $s['alamat']; ?></td>
                                    <td><?= $s['no_hp_santri']; ?></td>
                                    <td><?= $s['nama_ayah']; ?></td>
                                    <td><?= $s['pekerjaan_ortu']; ?></td>
                                    <td>
                                        <a href="" class="badge badge-danger">Tolak <span>&times;</span></a>
                                        <a href="" class="badge badge-success">Terima <span>&times;</span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>