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
            <div class="breadcrumb-item"><a href="/pengeluaran_baru">Tagihan</a></div>
            <div class="breadcrumb-item">Ubah Tagihan</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-6">
        <form action="/pengeluaran_baru/<?= $data['id_keluar'] ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Ubah Data Tagihan</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>Nama Pengeluaran</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_pengeluaran')) ? 'is-invalid' : ''; ?>" id="nama_pengeluaran" name="nama_pengeluaran" value="<?= (old('nama_pengeluaran')) ? old('nama_pengeluaran') : $data['nama_pengeluaran']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_pengeluaran'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Ubah Data</button>
                <a href="/pengeluaran_baru" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>
<?= $this->endSection(); ?>