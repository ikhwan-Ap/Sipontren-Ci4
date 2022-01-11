<?= $this->extend('layout/template_santri'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="section-title-"><?= session()->get('nama_lengkap'); ?></h4>
                    </div>
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                        </div>
                    </div>
                    <div class="profile-widget-description">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form method="post" class="needs-validation" novalidate="">
                        <div class="card-header">
                            <h4>Profile</h4>
                        </div>
                        <div class="card-body">
                            <?php foreach ($santri as $s) : ?>
                                <div class="row">
                                    <div class="form-group col-md-10 col-12">
                                        <label>Nama Lengkap</label>
                                        <p class="form-control"><?= $s['nama_lengkap']; ?></p>
                                        <div class=" invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label>Status</label>
                                            <p class="btn btn-success"><?= $s['status']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-7 col-12">
                                        <label>NIS</label>
                                        <p class="form-control"><?= $s['nis']; ?></p>
                                    </div>
                                    <div class=" form-group col-md-5 col-12">
                                        <label>No Hp</label>
                                        <p class="form-control"><?= $s['no_hp_santri']; ?></p>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-5 col-12">
                                        <a href="/santri/profil" class="btn btn-success">Detail</a>
                                    </div>
                                </div>
                            <?php endforeach;  ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</section>
<?= $this->endSection(); ?>