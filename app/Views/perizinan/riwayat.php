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
                <h4 class="text-dark">Riwayat Perizinan</h4>
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
                                <th>Keterangan</th>
                                <th>Catatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($izin as $z) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $z['nis']; ?></td>
                                    <td><?= $z['nama_lengkap']; ?></td>
                                    <td><?= $z['tanggal_izin']; ?></td>
                                    <td><?= $z['tanggal_estimasi']; ?></td>
                                    <td><?= $z['keterangan']; ?></td>
                                    <td>
                                        <?php if ($z['tanggal_pulang'] < $z['tanggal_estimasi'] && $z['tanggal_ditolak'] == null) : ?>
                                            <?php if ($z['tanggal_pulang'] != $z['tanggal_estimasi'] && $z['tanggal_ditolak'] == null && $z['tanggal_diterima'] == null) : ?>
                                                <h6 class="badge badge-warning">Menunggu</h6>
                                            <?php elseif ($z['tanggal_diterima'] && $z['tanggal_pulang'] == null) : ?>
                                                <h6 class="badge badge-primary">Diterima</h6>
                                            <?php else : ?>
                                                <h6 class="badge badge-success">Tepat Waktu</h6>
                                            <?php endif; ?>
                                        <?php elseif ($z['tanggal_pulang'] > $z['tanggal_estimasi'] && $z['tanggal_ditolak'] == null) : ?>
                                            <h6 class="badge badge-dark">Terlambat</h6>
                                        <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null) : ?>
                                            <h6 class="badge badge-danger">Izin ditolak</h6>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-light" onclick="topFunction()" title="DETAIL" data-toggle="modal" data-target="#exampleModal<?= $z['id_izin']; ?>">
                                            <span class="ion ion-android-open" data-pack="android" data-tags="">
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $z['id_izin']; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Keterangan Perizinan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col">
                                                    <h6 class="text-dark">Nama Santri :<?= $z['nama_lengkap']; ?></h6>
                                                </div>
                                                <div class="col">
                                                    <h6 class="text-dark">Keterangan:<?= $z['keterangan']; ?></h6>
                                                </div>
                                                <div class="col">
                                                    <h6 class="text-dark">Tanggal Perizinan :<?= date_format(date_create($z['tanggal_izin']), "Y-m-d h:i:s"); ?></h6>
                                                </div>
                                                <div class="col">
                                                    <h6 class="text-dark">Tanggal Izin Diterima : <?= ($z['tanggal_diterima'] == null) ? '-' : date_format(date_create($z['tanggal_diterima']), "Y-m-d h:i:s");; ?></h6>
                                                </div>
                                                <div class="col">
                                                    <h6 class="text-dark">Tanggal Estimasi : <?= date_format(date_create($z['tanggal_estimasi']), "Y-m-d h:i:s"); ?></h6>
                                                </div>
                                                <div class="col">
                                                    <h6 class="text-dark">Tanggal Pulang : <?= ($z['tanggal_pulang'] == null) ? '-' : date_format(date_create($z['tanggal_diterima']), "Y-m-d h:i:s");; ?></h6>
                                                </div>
                                                <div class="col">
                                                    <?php if ($z['tanggal_pulang'] > $z['tanggal_estimasi'] && $z['tanggal_ditolak'] == null) : ?>
                                                        <h6 class="text-dark">Status:<h7 class="badge badge-dark">Terlambat</h7>
                                                        </h6>
                                                        <h6 class="text-dark">Keterangan Terlambat: <?= $z['ket_terlambat']; ?></h6>
                                                    <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null) : ?>
                                                        <h6 class="text-dark">Status:<h7 class="badge badge-danger">Izin Ditolak</h7>
                                                        </h6>
                                                    <?php elseif ($z['tanggal_diterima'] && $z['tanggal_pulang'] == null) : ?>
                                                        <h6 class="text-dark">Status:<h7 class="badge badge-primary">Diterima</h7>
                                                        <?php else :  ?>
                                                            <h6 class="text-dark">Status:<h7 class="badge badge-success">Tepat Waktu</h7>
                                                            </h6>
                                                        <?php endif;  ?>
                                                </div>
                                                <div class="col">
                                                    <h6 class="text-dark">Perizinan Melalui : <?= $z['user_penginput']; ?></h6>
                                                </div>
                                                <div class="col">
                                                    <h6 class="text-dark">Konfirmasi Melalui : <?= $z['user_update'] == null ? '-' : $z['user_update']; ?></h6>
                                                </div>
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