<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/alumni" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/alumni">Alumni</a></div>
            <div class="breadcrumb-item">Detail Alumni</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-info col-lg-8">
            <div class="card-header">
                <h4 class="text-dark">Detail Data Alumni</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Status</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg-4">
                        <h6><?= $santri['status']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">NIS</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg-4">
                        <h6><?= $santri['nis']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Nama Lengkap</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg-4">
                        <h6><?= $santri['nama_lengkap']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Jenis Kelamin</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg-4">
                        <h6><?= $santri['jenis_kelamin']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Tempat, Tanggal Lahir</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg-4">
                        <h6><?= $santri['tempat_lahir']; ?>, <?= $santri['tanggal_lahir']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Alamat</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg-4">
                        <h6><?= $santri['alamat']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">No HP. Santri</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg-4">
                        <h6><?= $santri['no_hp_santri']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Pendidikan Terakhir</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg-4">
                        <h6><?= $santri['pendidikan_terakhir']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h6 class="text-dark">Pendidikan Sekarang</h6>
                    </div>
                    <div class="col-lg-1">
                        <h6 class="text-dark">:</h6>
                    </div>
                    <div class="col-lg-4">
                        <h6><?= $santri['pendidikan_sekarang']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="/alumni" class="btn btn-primary ml-2">Kembali</a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>