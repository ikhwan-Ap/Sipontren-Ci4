<?= $this->extend('layout/template_asatidz'); ?>
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
                            <?php foreach ($asatidz as $a) :  ?>
                                <img alt="image" src="/img/<?= $a['foto']; ?>" class="rounded-circle profile-widget-picture">
                            <?php endforeach;  ?>
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
                            <?php foreach ($asatidz as $a) :  ?>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Nama Lengkap</label>
                                        <p class="form-control"><?= $a['nama_lengkap']; ?></p>
                                        <div class="invalid-feedback">
                                            Please fill in the first name
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Program</label>
                                        <p class="form-control"><?= $a['program']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <p class="form-control"><?= $a['email']; ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>No Hp</label>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <p class="form-control"><?= $a['no_hp']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Tempat Lahir</label>
                                        <p class="form-control"><?= $a['tempat_lahir']; ?></p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Tanggal Lahir</label>
                                        <p class="form-control"><?= $a['tanggal_lahir']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Riwayat Pendidikan</label>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-graduation-cap"></i>
                                            </div>
                                            <p class="form-control"><?= $a['pendidikan']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-5 col-12">
                                        <a href="/asatidz/profil" class="btn btn-success">Detail</a>
                                    </div>
                                </div>
                        </div>
                    <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            NO
                                        </th>
                                        <th>Program</th>
                                        <th>Total Santri</th>
                                        <th>Jadwal</th>
                                        <th>Kelas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $i = 1;
                                        foreach ($asatidz as $a) :
                                        ?>
                                            <td>
                                                <?= $i++; ?>
                                            </td>
                                            <td><?= $a['program']; ?></td>
                                            <td><?= $a['total_santri']; ?></td>
                                            <td><?= $a['jadwal']; ?></td>
                                            <td><?= $a['kelas']; ?></td>
                                            <td><a href="#" class="btn btn-success">Detail</a></td>
                                    </tr>
                                    </tr>
                                <?php endforeach;  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<?= $this->endSection(); ?>