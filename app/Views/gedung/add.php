<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/gedung" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/gedung">Gedung</a></div>
            <div class="breadcrumb-item">Tambah Gedung</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-6">
        <form action="/gedung" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Tambah Data Gedung</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label>Nama Gedung</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_gedung')) ? 'is-invalid' : ''; ?>" id="nama_gedung" name="nama_gedung" value="<?= old('nama_gedung'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_gedung'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Tambah Data</button>
                <a href="/gedung" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>
<?= $this->endSection(); ?>