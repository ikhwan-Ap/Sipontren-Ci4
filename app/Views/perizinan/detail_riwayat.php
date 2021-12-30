<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/perizinan/riwayat" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Detail Riwayat Perizinan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">NIS</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg">
                        <h6><?= $izin['nis']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Nama Santri</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg">
                        <h6><?= $izin['nama_lengkap']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Tanggal Izin</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg">
                        <h6><?= date_format(date_create($izin['tanggal_izin']), "Y-m-d h:m"); ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Tanggal Estimasi Kepulangan</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg">
                        <h6><?= date_format(date_create($izin['tanggal_estimasi']), "Y-m-d h:m"); ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Tanggal Izin Diterima</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg">
                        <h6><?= ($izin['tanggal_diterima'] == null) ? '-' : date_format(date_create($izin['tanggal_diterima']), "Y-m-d h:m");; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Tanggal Izin Ditolak</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg">
                        <h6><?= ($izin['tanggal_ditolak'] == null) ? '-' : date_format(date_create($izin['tanggal_ditolak']), "Y-m-d h:m"); ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Tanggal Pulang</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg">
                        <h6><?= ($izin['tanggal_pulang'] == null) ? '-' : date_format(date_create($izin['tanggal_pulang']), "Y-m-d h:m"); ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Status</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg">
                        <?php if ($izin['tanggal_diterima'] == null && $izin['tanggal_ditolak'] == null) : ?>
                            <h6 class="badge badge-warning">Menunggu</h6>
                        <?php elseif ($izin['tanggal_diterima'] && $izin['tanggal_pulang'] == null) : ?>
                            <h6 class="badge badge-primary">Diterima</h6>
                        <?php elseif ($izin['tanggal_ditolak'] && $izin['tanggal_pulang'] == null) : ?>
                            <h6 class="badge badge-danger">Ditolak</h6>
                        <?php elseif ($izin['tanggal_pulang']) : ?>
                            <h6 class="badge badge-success">Pulang</h6>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Catatan</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg">
                        <?php if ($izin['tanggal_pulang'] < $izin['tanggal_estimasi'] && $izin['tanggal_ditolak'] == null) : ?>
                            <?php if ($izin['tanggal_pulang'] != $izin['tanggal_estimasi'] && $izin['tanggal_ditolak'] == null && $izin['tanggal_diterima'] == null) : ?>
                                <h6 class="badge badge-warning">Menunggu</h6>
                            <?php else : ?>
                                <h6 class="badge badge-success">Tepat Waktu</h6>
                            <?php endif; ?>
                        <?php elseif ($izin['tanggal_pulang'] > $izin['tanggal_estimasi'] && $izin['tanggal_ditolak'] == null) : ?>
                            <h6 class="badge badge-warning">Terlambat</h6>
                        <?php elseif ($izin['tanggal_ditolak'] && $izin['tanggal_diterima'] == null && $izin['tanggal_pulang'] == null) : ?>
                            <h6 class="badge badge-danger">Izin ditolak</h6>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <label for="keterangan" class="text-dark">
                            <h6>Keterangan</h6>
                        </label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3" readonly><?= $izin['keterangan'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer text-left">
                <a href="/perizinan/riwayat" class="btn btn-primary ml-2">Kembali</a>
            </div>
        </div>
</section>
<?= $this->endSection(); ?>