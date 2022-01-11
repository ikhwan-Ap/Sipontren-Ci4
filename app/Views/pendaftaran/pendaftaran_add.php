<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/pendaftaran/pendaftaran" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/pembayaran/pendaftaran">Pembayaran Pendaftaran</a></div>
            <div class="breadcrumb-item">Tambah Data Pendaftaran</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="/pendaftaran" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Pembayaran Pendaftaran</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input id="id_santri" type="hidden" name="id_santri">
                <div class="form-group">
                    <label>NAMA SANTRI</label>
                    <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('id_santri'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_tagihan"> Pembayaran</label>
                    <select class="form-control <?= ($validation->hasError('id_tagihan')) ? 'is-invalid' : ''; ?>" name="id_tagihan" id="id_tagihan">
                        <option value="" hidden></option>
                        <option value="3">uang pendaftaran</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('id_tagihan'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jumlah Bayar</label>
                    <input id="jumlah_bayar" type="number" class="form-control" name="jumlah_bayar" value="<?= old('jumlah_bayar'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_bayar'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jumlah Tagihan</label>
                    <input id="jumlah_tagihan" type="number" class="form-control" name="jumlah_tagihan" value="<?= old('jumlah_tagihan'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_tagihan'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="waktu">Tanggal Pembayaran</label>
                        <input id="waktu" type="date" class="form-control <?= ($validation->hasError('waktu')) ? 'is-invalid' : ''; ?>" name="waktu" value="<?= old('waktu'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('waktu'); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Tambah Data</button>
                    <a href="/pendaftaran/pendaftaran" class="btn btn-light ml-2">Batal</a>
                </div>
            </div>
        </form>
    </div>

</section>

<script>
    $(document).ready(function() {
        $('#nama_lengkap').autocomplete({
            source: "<?php echo site_url('pendaftaran/get_autofill/?')  ?>",
            select: function(event, ui) {
                $('[name="nama_lengkap"]').val(ui.item.label);
                $('[name="id_santri"]').val(ui.item.id_santri);

            }
        })
    });
</script>
<?= $this->endSection(); ?>