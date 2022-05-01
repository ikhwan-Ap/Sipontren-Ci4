<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
        </div>
    </div>

    <?php if (session()->getFlashdata() != null) : ?>
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
                                <th>Nama Santri</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
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
                                    <td><?= $s['jenis_kelamin']; ?></td>
                                    <td><?= $s['no_hp_santri']; ?></td>
                                    <td><?= $s['nama_ayah']; ?></td>
                                    <td><?= $s['pekerjaan_ortu']; ?></td>
                                    <td>
                                        <a type="button" title="Restore" class="badge badge-light" data-toggle="modal" data-target="#restore<?= $s['id_santri']; ?>">
                                            <span><i class="ion ion-android-sync"></i></span>
                                        </a>
                                        <button type="button" class="btn btn-danger" title="DELETE(Permanen)" id="btnDEL" data-toggle="modal" data-target="#Delet_perm<?= $s['id_santri']; ?>">
                                            <span class="ion ion-ios-trash" data-pack="default" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                            </span>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Restore -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="restore<?= $s['id_santri']; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Peringatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah data ini akan di restore?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/trash_aktif/<?= $s['id_santri']; ?>" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id_santri" id="id_santri" value="<?= $s['id_santri']; ?>">
                                                    <?php foreach ($pendaftaran as $data) : ?>
                                                        <input type="hidden" name="jumlah_pembayaran" id="jumlah_pembayaran" value="<?= $data['jumlah_pembayaran']; ?>">
                                                    <?php endforeach; ?>
                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Delete Permanen -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="Delet_perm<?= $s['id_santri']; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Peringatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah data ini akan di hapus?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/trash_aktif/<?= $s['id_santri']; ?>" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="id_santri" id="id_santri" value="<?= $s['id_santri']; ?>">
                                                    <input type="hidden" name="id_orangtua" id="id_orangtua" value="<?= $s['id_orangtua']; ?>">
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