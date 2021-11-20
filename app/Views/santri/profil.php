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
                                        <div class=" form-group">
                                            <label for="foto">Foto</label>
                                            <div class=" col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <img src="/img/default" class="img-thumbnail img-preview">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                                            <label class="custom-file-label" for="foto"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $santri['nama_lengkap']; ?>">
                                        </div>
                                        <div class=" form-group">
                                            <label>Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="number" id="no_hp_santri" name="no_hp_santri" class="form-control phone-number" value="<?= (old('no_hp_santri')) ? old('no_hp_santri') : $santri['no_hp_santri']; ?>">
                                            </div>
                                        </div>
                                        <div class=" form-group">
                                            <label>Tanggal Lahir</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control pwstrength" id="tanggal_lahir" name="tanggal_lahir" data-indicator="pwindicator" value="<?= (old('tanggal_lahir')) ? old('tanggal_lahir') : $santri['tanggal_lahir']; ?>">
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
                                            <label>NIS</label>
                                            <input type="number" id="nis" name="nis" class="form-control datemask" value="<?= (old('nis')) ? old('nis') : $santri['nis']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Kamar</label>
                                            <input type="number" id="id_kamar" name="id_kamar" class="form-control datemask" value="<?= (old('id_kamar')) ? old('id_kamar') : $santri['id_kamar']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Riwayat Pendidikan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-graduation-cap"></i>
                                                    </div>
                                                </div>
                                                <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir" class="form-control pwstrength" data-indicator="pwindicator" value="<?= (old('pendidikan_terakhir')) ? old('pendidikan_terakhir') : $santri['pendidikan_terakhir']; ?>">
                                            </div>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Program</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                </div>
                                                <input type="text" id="id_program" name="id_program" class="form-control pwstrength" data-indicator="pwindicator" value="<?= (old('id_program')) ? old('id_program') : $santri['id_program']; ?>">
                                            </div>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input type="text" id="jenis_kelaming" name="jenis_kelamin" class="form-control" value="<?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $santri['jenis_kelamin']; ?>">
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
<?= $this->endSection(); ?>