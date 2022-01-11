<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/perizinan/add" class="btn btn-primary">Tambah</a>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Perizinan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>Nama Santri</th>
                                <th>Tanggal Izin</th>
                                <th>Tanggal Estimasi</th>
                                <th>Status</th>
                                <?php if (session()->get('role') == 1) : ?>
                                    <th>Keputusan</th>
                                <?php endif; ?>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($izin as $z) : ?>
                                <?php $j = $i++;  ?>
                                <tr>
                                    <td><?= strrev($j); ?></td>
                                    <td><?= $z['nis']; ?></td>
                                    <td><?= $z['nama_lengkap']; ?></td>
                                    <td><?= date_format(date_create($z['tanggal_izin']), "Y-m-d h:m"); ?></td>
                                    <td><?= date_format(date_create($z['tanggal_estimasi']), "Y-m-d h:m"); ?></td>
                                    <td>
                                        <?php if ($z['tanggal_diterima'] == null && $z['tanggal_ditolak'] == null) : ?>
                                            <p class="badge badge-warning">Menunggu</p>
                                        <?php elseif ($z['tanggal_diterima'] && $z['tanggal_pulang'] == null) : ?>
                                            <p class="badge badge-primary">Diterima</p>
                                        <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_pulang'] == null) : ?>
                                            <p class="badge badge-danger">Ditolak</p>
                                        <?php elseif ($z['tanggal_pulang']) : ?>
                                            <p class="badge badge-success">Pulang</p>
                                        <?php endif; ?>
                                    </td>
                                    <?php if (session()->get('role') == 1) : ?>
                                        <td>
                                            <?php if ($z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null && $z['tanggal_ditolak'] == null) : ?>
                                                <a href="/perizinan/terima/<?= $z['id_izin']; ?>" class="btn btn-info">Terima</a>
                                                <a href="/perizinan/ditolak/<?= $z['id_izin']; ?>" class="btn btn-dark">Tolak</a>
                                            <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null) : ?>
                                                <p class="text-center">-</p>
                                            <?php elseif ($z['tanggal_pulang'] == null) : ?>
                                                <a href="/perizinan/pulang/<?= $z['id_izin']; ?>" class="btn btn-info">Pulang</a>
                                            <?php else : ?>
                                                <p class="text-center">-</p>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal<?= $z['nis']; ?>">
                                                Detail
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $z['id_izin']; ?>">
                                                Hapus
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                    <?php if (session()->get('role') == 2) : ?>
                                        <td>
                                            <?php if ($z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null && $z['tanggal_ditolak'] == null) : ?>
                                            <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null) : ?>
                                                <p class="text-center">-</p>
                                            <?php else : ?>
                                                <p class="text-center">-</p>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal<?= $z['nis']; ?>">
                                                Detail
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                </tr>

                                <!-- Modal delete -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $z['id_izin']; ?>">
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
                                                <form action="/perizinan/<?= $z['id_izin']; ?>" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal detail -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $z['nis']; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Keterangan Perizinan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?= $z['keterangan']; ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Kembali</button>
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
</section>`
<?= $this->endSection(); ?>