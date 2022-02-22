<?= $this->extend('layout/template_santri'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>
    <?= session()->getFlashdata('message'); ?>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="/santri/editprofil" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_santri" value="<?= $santri['id_santri']; ?>">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $santri['nama_lengkap']; ?>">
                                        </div>
                                        <div class=" form-group">
                                            <label>Tanggal Lahir</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="date" class="form-control pwstrength" id="tanggal_lahir" name="tanggal_lahir" data-indicator="pwindicator" value="<?= (old('tanggal_lahir')) ? old('tanggal_lahir') : $santri['tanggal_lahir']; ?>">
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
                                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control pwstrength" data-indicator="pwindicator" value="<?= (old('tempat_lahir')) ? old('tempat_lahir') : $santri['tempat_lahir']; ?>">
                                            </div>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" id="alamat" name="alamat" class="form-control purchase-code" value="<?= (old('alamat')) ? old('alamat') : $santri['alamat']; ?>">
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
                                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                            <select class="form-control <?= ($validation->hasError('pendidikan_terakhir')) ? 'is-invalid' : ''; ?>" name="pendidikan_terakhir" id="pendidikan_terakhir">
                                                <option value="<?= $santri['pendidikan_terakhir']; ?>" hidden><?= $santri['pendidikan_terakhir']; ?></option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA/SMK">SMA/SMK</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('pendidikan_terakhir'); ?>
                                            </div>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('password'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input type="password" class="form-control <?= ($validation->hasError('password_conf')) ? 'is-invalid' : ''; ?>" id="password_conf" name="password_conf">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('password_conf'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="showpass" class="custom-control-input" tabindex="3" id="showpass" onclick="myFunction()">
                                                    <label class="custom-control-label" for="showpass">Show Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-success">Edit Data</button>
                                                <a href="<?= base_url('dashboard/santri'); ?>" class="btn btn-success">Kembali</a>
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
<script>
    function myFunction() {
        var x = document.getElementById("password");
        var y = document.getElementById("password_conf");
        if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }
</script>
<?= $this->endSection(); ?>