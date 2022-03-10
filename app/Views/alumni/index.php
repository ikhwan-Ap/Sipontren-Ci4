<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/alumni/add" class="btn btn-primary">
                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                    Tambah
                </span>
            </a>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Santri Alumni</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
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
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $a['id_santri']; ?>">
                                            <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                        </button>
                                        <a href="/alumni/edit/<?= $a['id_santri']; ?>" class="btn btn-light">
                                            <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                                        </a>
                                        <a href="/alumni/detail/<?= $a['id_santri']; ?>" class="btn btn-light" target="_blank">
                                            <span class="ion ion-android-open" data-pack="android" data-tags="">
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $a['id_santri']; ?>">
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
                                                <form action="/alumni/<?= $a['id_santri']; ?>" method="POST">
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
</section>
<?= $this->endSection(); ?>