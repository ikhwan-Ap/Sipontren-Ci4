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
            <div class="breadcrumb-item"><a href="/tagihan">Tagihan</a></div>
            <div class="breadcrumb-item">Ubah Tagihan</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-6">
        <form action="/tagihan/<?= $tagihan['id_tagihan'] ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Ubah Data Tagihan</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>Nama Tagihan</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_pembayaran')) ? 'is-invalid' : ''; ?>" id="nama_pembayaran" name="nama_pembayaran" value="<?= (old('nama_pembayaran')) ? old('nama_pembayaran') : $tagihan['nama_pembayaran']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_pembayaran'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Ubah Data</button>
                <a href="/tagihan" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>
<?= $this->endSection(); ?>