<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/pengeluaran_baru" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/pengeluaran_baru">Pengeluaran baru</a></div>
            <div class="breadcrumb-item">Tambah Data Pengeluaran</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="/pengeluaran_baru" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Pengeluaran Baru</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="nama_pengeluaran">Nama pengeluaran Baru</label>
                    <input id="nama_pengeluaran" type=" number" class="form-control <?= ($validation->hasError('nama_pengeluaran')) ? 'is-invalid' : ''; ?>" name="nama_pengeluaran" value="<?= old('nama_pengeluaran'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_pengeluaran'); ?>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Tambah Data</button>
                    <a href="/pengeluaran_baru" class="btn btn-light ml-2">Batal</a>
                </div>
            </div>
        </form>
    </div>

</section>
<?= $this->endSection(); ?>