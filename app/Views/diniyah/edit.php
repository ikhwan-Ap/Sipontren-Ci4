<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/diniyah" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/diniyah">Diniyah</a></div>
            <div class="breadcrumb-item">Ubah Diniyah</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-6">
        <form action="/diniyah/<?= $diniyah['id_diniyah'] ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Ubah Data Diniyah</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>Nama Diniyah</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_diniyah')) ? 'is-invalid' : ''; ?>" id="nama_diniyah" name="nama_diniyah" value="<?= (old('nama_diniyah')) ? old('nama_diniyah') : $diniyah['nama_diniyah']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_diniyah'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Ubah Data</button>
                <a href="/diniyah" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>
<?= $this->endSection(); ?>