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
                                    <?php if (session()->get('role') == 3) : ?>
                                        <td>
                                            <?php if ($z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null && $z['tanggal_ditolak'] == null) : ?>

                                            <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null) : ?>
                                                <p class="text-center">-</p>
                                            <?php elseif (date("Y-m-d") <= $z['tanggal_estimasi'] && $z['tanggal_pulang'] == null) : ?>
                                                <a href="/perizinan/pulang_keamanan/<?= $z['id_izin']; ?>" class="btn btn-info">Pulang</a>
                                            <?php elseif (date("Y-m-d") > $z['tanggal_estimasi'] && $z['tanggal_pulang'] == null) : ?>
                                                <a href="/perizinan/pulang_terlambat/<?= $z['id_izin']; ?>" class="btn btn-dark">Terlambat</a>
                                            <?php else : ?>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal<?= $z['nis']; ?>">
                                                Detail
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                </tr>

                                <!-- Modal delete -->
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