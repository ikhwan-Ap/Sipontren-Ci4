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
                                    <td>
                                        <?php if ($z['tanggal_pulang'] < $z['tanggal_estimasi'] && $z['tanggal_ditolak'] == null) : ?>
                                            <?php if ($z['tanggal_pulang'] != $z['tanggal_estimasi'] && $z['tanggal_ditolak'] == null && $z['tanggal_diterima'] == null) : ?>
                                                <h6 class="badge badge-warning">Menunggu</h6>
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
                                        <a href="/perizinan/detailriwayatizin/<?= $z['id_izin']; ?>" class="btn btn-light" target="_blank">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>`
<?= $this->endSection(); ?>