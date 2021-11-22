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
                <h4 class="text-dark">Data Santri Alumni</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($alumni as $a) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $a['nis']; ?></td>
                                    <td><?= $a['nama_lengkap']; ?></td>
                                    <td><?= $a['alamat']; ?></td>
                                    <td><?= $a['jenis_kelamin']; ?></td>
                                    <td><?= $a['no_hp_santri']; ?></td>
                                    <td>
                                        <div class="badges badge badge-success"><?= $a['status']; ?></div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-danger">Hapus</a>
                                        <a href="" class="btn btn-warning">Edit</a>
                                        <a href="/santri/detail/<?= $a['id_santri']; ?>" class="btn btn-info">Detail</a>
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