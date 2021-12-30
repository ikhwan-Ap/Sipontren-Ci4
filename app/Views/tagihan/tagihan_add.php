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
            <div class="breadcrumb-item"><a href="/pembayaran/tagihan">Tagihan Baru</a></div>
            <div class="breadcrumb-item">Tambah Data Tagihan Baru</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="/tagihan" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Tambah Data Tagihan Baru</h4>
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
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Tambah Data</button>
                    <a href="/tagihan" class="btn btn-light ml-2">Batal</a>
                </div>
            </div>
        </form>
    </div>

</section>

<?= $this->endSection(); ?>