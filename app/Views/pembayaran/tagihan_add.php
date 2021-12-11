<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/tagihan" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/pembayaran/tagihan">Pembayaran Pendaftaran</a></div>
            <div class="breadcrumb-item">Tambah Data Pendaftaran</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="/tagihan" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Pembayaran Pendaftaran</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="nama_pembayaran">Nama Pembayaran Baru</label>
                    <input id="nama_pembayaran" type=" number" class="form-control <?= ($validation->hasError('nama_pembayaran')) ? 'is-invalid' : ''; ?>" name="nama_pembayaran" value="<?= old('nama_pembayaran'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_pembayaran'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jumlah_pembayaran">Jumlah Pembayaran/Tagihan Baru</label>
                    <input id="jumlah_pembayaran" type="number" class="form-control <?= ($validation->hasError('jumlah_pembayaran')) ? 'is-invalid' : ''; ?>" name="jumlah_pembayaran" value="<?= old('jumlah_pembayaran'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_pembayaran'); ?>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Tambah Data</button>
                    <a href="/tagihan" class="btn btn-light ml-2">Batal</a>
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