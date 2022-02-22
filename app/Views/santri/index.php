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
                    <table class="table table-striped" id="table-2">
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
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $s['id_santri']; ?>">
                                            Hapus
                                        </button>
                                        <a href="/santri/edit/<?= $s['id_santri']; ?>" class="btn btn-warning">Edit</a>
                                        <a href="/santri/detail/<?= $s['id_santri']; ?>" class="btn btn-info" target="_blank">Detail</a>
                                    </td>
                                </tr>
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $s['id_santri']; ?>">
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
                                                <form action="/santri/<?= $s['id_santri']; ?>" method="POST">
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

    <div class="card">
        <div class="card-header">
            <h4 class="text-dark">Data Santri Non Aktif</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="table-1">
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
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $s['id_santri']; ?>">
                                        Hapus
                                    </button>
                                    <a href="/santri/detail/<?= $s['id_santri']; ?>" class="btn btn-info" target="_blank">Detail</a>
                                    <form action="/santri/editnonaktif/<?= $s['id_santri']; ?>" method="GET">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id_santri" value="<?= $s['id_santri']; ?>">
                                        <button type="submit" class="btn btn-warning">Edit</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $s['id_santri']; ?>">
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
                                            <form action="/santri/<?= $s['id_santri']; ?>" method="POST">
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
</section>
<?= $this->endSection(); ?>