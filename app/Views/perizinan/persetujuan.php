<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/perizinan" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/perizinan">Perizinan</a></div>
            <div class="breadcrumb-item">Tambah Data Perizinan</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="/perizinan" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Surat Izin Keluar</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="id_santri">ID Santri</label>
                    <textarea class="form-control <?= ($validation->hasError('id_santri')) ? 'is-invalid' : ''; ?>" name="id_santri" id="id_santri" rows="3"></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('id_santri'); ?>
                    </div>
                </div>
                <div clas <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" name="keterangan" id="keterangan" rows="3"></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('keterangan'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal_izin">tanggal_izin</label>
                    <textarea class="form-control <?= ($validation->hasError('tanggal_izin')) ? 'is-invalid' : ''; ?>" name="tanggal_izin" id="tanggal_izin" rows="3"></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_izin'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal_kembali">tanggal_kembali</label>
                    <textarea class="form-control <?= ($validation->hasError('tanggal_kembali')) ? 'is-invalid' : ''; ?>" name="tanggal_kembali" id="tanggal_kembali" rows="3"></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_kembali'); ?>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary">Tambah Data</button>
                    <a href="/pembayaran" class="btn btn-light ml-2">Batal</a>
                </div>
            </div>
        </form>
    </div>

</section>
<?= $this->endSection(); ?>