<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/admin" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/admin">Admin</a></div>
            <div class="breadcrumb-item">Detail Admin</div>
        </div>
    </div>

    <div class="card col-lg-6">
        <div class="card-header">
            <h4 class="text-dark">Detail Data Admin</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <h6 class="text-dark">Nama</h6>
                </div>
                <div class="col-lg-1">
                    <h6 class="text-dark">:</h6>
                </div>
                <div class="col-lg-4">
                    <h6><?= $admin['name']; ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <h6 class="text-dark">Username</h6>
                </div>
                <div class="col-lg-1">
                    <h6 class="text-dark">:</h6>
                </div>
                <div class="col-lg-4">
                    <h6><?= $admin['username']; ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <h6 class="text-dark">Email</h6>
                </div>
                <div class="col-lg-1">
                    <h6 class="text-dark">:</h6>
                </div>
                <div class="col-lg-4">
                    <h6><?= $admin['email']; ?></h6>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="/admin" class="btn btn-primary ml-2">Kembali</a>
        </div>
    </div>

</section>
<?= $this->endSection(); ?>