<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/kelas" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/kelas">Kelas</a></div>
            <div class="breadcrumb-item">Ubah Kelas</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-6">
        <form action="/kelas/<?= $kelas['id_kelas'] ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Ubah Data Kelas</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>Nama Kelas</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_kelas')) ? 'is-invalid' : ''; ?>" id="nama_kelas" name="nama_kelas" value="<?= (old('nama_kelas')) ? old('nama_kelas') : $kelas['nama_kelas']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_kelas'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Ubah Data</button>
                <a href="/kelas" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>
<?= $this->endSection(); ?>