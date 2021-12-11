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
        <form action="/pembayaran/<?= $keuangan['id_keuangan']; ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Tambah Data Santri</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="id_santri">NIS</label>
                    <select class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" name="nis" id="id_santri">
                        <option value="" hidden><?= $lunas['nis']; ?></option>
                        <?php
                        foreach ($santri as $s) :
                        ?>
                            <option value="<?= $s['id_santri']; ?>"><?= $s['nis']; ?></option>
                        <?php endforeach;  ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nis'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_santri">Nama Santri</label>
                    <select class="form-control <?= ($validation->hasError('id_santri')) ? 'is-invalid' : ''; ?>" name="id_santri" id="id_santri">
                        <option value="" hidden><?= $lunas['nama_lengkap']; ?></option>
                        <?php foreach ($santri as $s) :  ?>
                            <option value="<?= $s['id_santri']; ?>"><?= $s['nama_lengkap']; ?></option>
                        <?php endforeach;  ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('id_santri'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_tagihan"> Pembayaran</label>
                    <select class="form-control <?= ($validation->hasError('nama_pembayaran')) ? 'is-invalid' : ''; ?>" name="id_tagihan" id="id_tagihan">
                        <option value="" hidden></option>
                        <?php foreach ($tagihan as $t) :  ?>
                            <option value="<?= $t['id_tagihan']; ?>"><?= $t['nama_pembayaran']; ?></option>
                        <?php endforeach;  ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_pembayaran'); ?>
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
                    <button class="btn btn-primary">Edit Data</button>
                    <a href="/pembayaran" class="btn btn-light ml-2">Batal</a>
                </div>
            </div>
        </form>
    </div>

</section>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        var y = document.getElementById("password_conf");
        if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }
</script>
<?= $this->endSection(); ?>