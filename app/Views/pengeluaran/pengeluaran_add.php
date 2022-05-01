<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/pengeluaran" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/pengeluaran">Pengeluaran</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
        </div>
    </div>

    <?php if (session()->getFlashdata('message') != null) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <?= session()->getFlashdata('message'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-8 ">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-money-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Anggaran Tersedia</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $sisa = $Lunas - $pengeluaran;

                        ?>
                        <?= "Rp " . number_format($sisa, 2, ',', '.'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card col-lg-8">
        <form action="/pengeluaran" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Pengeluaran Daftar Ulang</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="id_keluar">Pengeluaran</label>
                    <select class="form-control <?= ($validation->hasError('id_keluar')) ? 'is-invalid' : ''; ?>" name="id_keluar" id="id_keluar">
                        <option value="" hidden></option>
                        <?php foreach ($pengeluaran_baru as $t) : ?>
                            <option value="<?= $t['id_keluar']; ?>"><?= $t['nama_pengeluaran']; ?></option>
                        <?php endforeach;  ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('id_keluar'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jumlah_pengeluaran">Jumlan Pengeluaran</label>
                    <input id="jumlah_pengeluaran" type="number" class="form-control <?= ($validation->hasError('jumlah_pengeluaran')) ? 'is-invalid' : ''; ?>" name="jumlah_pengeluaran" value="<?= old('jumlah_pengeluaran'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_pengeluaran'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="waktu_pengeluaran">Tanggal</label>
                        <input id="waktu_pengeluaran" type="date" class="form-control <?= ($validation->hasError('waktu_pengeluaran')) ? 'is-invalid' : ''; ?>" name="waktu_pengeluaran" value="<?= old('waktu_pengeluaran'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('waktu_pengeluaran'); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Tambah Data</button>
                    <a href="/pengeluaran" class="btn btn-light ml-2">Batal</a>
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