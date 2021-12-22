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
            <div class="breadcrumb-item">Pembayaran</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="/pembayaran/<?= $BelumLunas['id_keuangan']; ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Pembayaran Santri</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id_keuangan" value="<?= $BelumLunas['id_keuangan']; ?>">
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Nama Lengkap</label>
                        <p class="form-control"><?= $BelumLunas['nama_lengkap']; ?></p>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>NIS</label>
                        <p class="form-control"><?= $BelumLunas['nis']; ?></p>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label for="nama_pembayaran">Keterangan</label>
                        <p class="form-control"><?= $BelumLunas['nama_pembayaran']; ?></p>
                        <div class="invalid-feedback">
                            Please fill in the first name
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="jumlah_pembayaran">Tagihan</label>
                        <input id="jumlah_pembayaran" type="text" class="form-control" name="jumlah_pembayaran" value="<?= $BelumLunas['jumlah_pembayaran']; ?>" readonly>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah_pembayaran'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label for="jumlah_bayar">Jumlah Pembayaran</label>
                        <input id="jumlah_bayar" type="number" class="form-control <?= ($validation->hasError('jumlah_bayar')) ? 'is-invalid' : ''; ?>" name="jumlah_bayar" value="<?= old('jumlah_bayar'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah_bayar'); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Bayar</button>
                    <a href="/pembayaran" class="btn btn-light ml-2">Batal</a>
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