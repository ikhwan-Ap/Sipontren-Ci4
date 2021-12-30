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
                <input type="hidden" name="user_penginput" value="<?= $user_penginput; ?>">
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input id="nis" type=" number" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" name="nis" value="<?= old('nis'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nis'); ?>
                    </div>
                </div>
                <input id="id_santri" type="hidden" name="id_santri">
                <div class="form-group">
                    <label>NAMA SANTRI</label>
                    <input id="nama_lengkap" type="text" class="form-control <?= ($validation->hasError('id_santri')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" value="<?= old('id_santri'); ?>" readonly>
                    <div class="invalid-feedback">
                        <?= $validation->getError('id_santri'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" name="keterangan" id="keterangan" rows="3"><?= old('keterangan'); ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('keterangan'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="tanggal_izin">Tanggal Izin</label>
                        <input id="tanggal_izin" type="datetime-local" class="form-control <?= ($validation->hasError('tanggal_izin')) ? 'is-invalid' : ''; ?>" name="tanggal_izin" value="<?= old('tanggal_izin'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_izin'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="tanggal_estimasi">Tanggal Estimasi Kembali</label>
                        <input id="tanggal_estimasi" type="datetime-local" class="form-control <?= ($validation->hasError('tanggal_estimasi')) ? 'is-invalid' : ''; ?>" name="tanggal_estimasi" value="<?= old('tanggal_estimasi'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_estimasi'); ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary">Tambah Data</button>
                    <a href="/perizinan" class="btn btn-light ml-2">Batal</a>
                </div>
            </div>
        </form>
    </div>

</section>
<script>
    $(document).ready(function() {
        $('#nis').autocomplete({
            source: "<?php echo site_url('perizinan/get_autofill/?')  ?>",
            select: function(event, ui) {
                $('[name="nis"]').val(ui.item.label);
                $('[name="nama_lengkap"]').val(ui.item.nama_lengkap);
                $('[name="id_santri"]').val(ui.item.id_santri);

            }
        })
    });
</script>
<?= $this->endSection(); ?>