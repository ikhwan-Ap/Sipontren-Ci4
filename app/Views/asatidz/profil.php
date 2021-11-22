<?= $this->extend('layout/template_asatidz'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>
    <?= session()->getFlashdata('message'); ?>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="/asatidz/editprofil" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $asatidz['id']; ?>">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class=" form-group">
                                            <label for="foto">Foto</label>
                                            <div class=" col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <img src="/img/<?= $asatidz['foto']; ?>" class="img-thumbnail img-preview">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                                            <label class="custom-file-label" for="foto"><?= $asatidz['foto']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $asatidz['nama_lengkap']; ?>">
                                        </div>
                                        <div class=" form-group">
                                            <label>Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="number" id="no_hp" name="no_hp" class="form-control phone-number" value="<?= (old('no_hp')) ? old('no_hp') : $asatidz['no_hp']; ?>">
                                            </div>
                                        </div>
                                        <div class=" form-group">
                                            <label>Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control pwstrength" id="email" name="email" data-indicator="pwindicator" value="<?= (old('email')) ? old('email') : $asatidz['email']; ?>">
                                            </div>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Tanggal Lahir</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-map-marker"></i>
                                                    </div>
                                                </div>
                                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control pwstrength" data-indicator="pwindicator" value="<?= (old('tempat_lahir')) ? old('tempat_lahir') : $asatidz['tempat_lahir']; ?>">
                                            </div>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" id="alamat" name="alamat" class="form-control purchase-code" value="<?= (old('alamat')) ? old('alamat') : $asatidz['alamat']; ?>">
                                        </div>
                                        <div class=" card">
                                            <div class="card-header">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Riwayat Pendidikan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-graduation-cap"></i>
                                                    </div>
                                                </div>
                                                <input type="text" id="pendidikan" name="pendidikan" class="form-control pwstrength" data-indicator="pwindicator" value="<?= (old('pendidikan')) ? old('pendidikan') : $asatidz['pendidikan']; ?>">
                                            </div>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-success">Edit Data</button>
                                                <a href="<?= base_url('dashboard/asatidz'); ?>" class="btn btn-success">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>