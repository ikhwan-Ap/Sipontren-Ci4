<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/pembayaran" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/pembayaran">Pembayaran</a></div>
            <div class="breadcrumb-item">Tambah Data Pembayaran</div>
        </div>
    </div>


    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">

        <form action="/pembayaran" method="POST">

            <div class="card-header">
                <h4 class="text-dark">Form Pembayaran SPP</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
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
                    <label for="id_tagihan"> Pembayaran</label>
                    <select class="form-control <?= ($validation->hasError('id_tagihan')) ? 'is-invalid' : ''; ?>" name="id_tagihan" id="id_tagihan">
                        <option value="" hidden></option>
                        <option value="5">uang syahriyah</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('id_tagihan'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="waktu">Tanggal Pembayaran</label>
                        <input id="waktu" type="date" class="form-control <?= ($validation->hasError('waktu')) ? 'is-invalid' : ''; ?>" name="waktu[]" value="<?= date('Y-m-d'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('waktu'); ?>
                        </div>
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

<script>
    $(document).ready(function() {
        $('#nis').autocomplete({
            source: "<?php echo site_url('pembayaran/get_autofill/?')  ?>",
            select: function(event, ui) {
                $('[name="nis"]').val(ui.item.label);
                $('[name="nama_lengkap"]').val(ui.item.nama_lengkap);
                $('[name="id_santri"]').val(ui.item.id_santri);

            }
        })
    });
</script>
<?= $this->endSection(); ?>