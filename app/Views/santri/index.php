<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/santri/add" class="btn btn-primary">Tambah</a>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Santri Aktif</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>Nama Santri</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP Santri</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($santri as $s) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $s['nis']; ?></td>
                                    <td><?= $s['nama_lengkap']; ?></td>
                                    <td><?= $s['alamat']; ?></td>
                                    <td><?= $s['jenis_kelamin']; ?></td>
                                    <td><?= $s['no_hp_santri']; ?></td>
                                    <td>
                                        <div class="badges badge badge-success"><?= $s['status']; ?></div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-danger">Hapus</a>
                                        <a href="/santri/edit/<?= $s['id_santri']; ?>" class="btn btn-warning">Edit</a>
                                        <a href="/santri/detail/<?= $s['id_santri']; ?>" class="btn btn-info" target="_blank">Detail</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Santri Non Aktif</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Santri</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP Santri</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($santriNon as $s) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $s['nama_lengkap']; ?></td>
                                    <td><?= $s['alamat']; ?></td>
                                    <td><?= $s['jenis_kelamin']; ?></td>
                                    <td><?= $s['no_hp_santri']; ?></td>
                                    <td>
                                        <div class="badges badge badge-dark"><?= $s['status']; ?></div>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-danger">Hapus</a>
                                        <a href="" class="btn btn-warning">Edit</a>
                                        <a href="/santri/detail/<?= $s['id_santri']; ?>" class="btn btn-info" target="_blank">Detail</a>
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