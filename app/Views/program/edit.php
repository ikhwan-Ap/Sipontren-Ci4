<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/program" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/program">Program</a></div>
            <div class="breadcrumb-item">Ubah Program</div>
        </div>
    </div>


    <div class="card col-lg-6">
        <form action="/program/<?= $program['id_program'] ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Ubah Data Program</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>Nama Program</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_program')) ? 'is-invalid' : ''; ?>" id="nama_program" name="nama_program" value="<?= (old('nama_program')) ? old('nama_program') : $program['nama_program']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_program'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Ubah Data</button>
                <a href="/program" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>
<?= $this->endSection(); ?>