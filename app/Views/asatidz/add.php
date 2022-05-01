<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/asatidz" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/asatidz">Asatidz</a></div>
            <div class="breadcrumb-item">Tambah Asatidz</div>
        </div>
    </div>


    <div class="card col-lg-8">
        <form action="/asatidz" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Tambah Data Asatidz</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="nik_ktp">NIK KTP</label>
                        <input id="nik_ktp" type="number" class="form-control <?= ($validation->hasError('nik_ktp')) ? 'is-invalid' : ''; ?>" name="nik_ktp" value="<?= old('nik_ktp'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik_ktp'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="no_kk">No KK</label>
                        <input id="no_kk" type="number" class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" name="no_kk" value="<?= old('no_kk'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_kk'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username">username</label>
                    <input id="username" type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label>Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label>Konfirmasi Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password_conf')) ? 'is-invalid' : ''; ?>" id="password_conf" name="password_conf">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password_conf'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showpass" onclick="myFunction()">
                            <label class="form-check-label" for="show_password">
                                Show Password
                            </label>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input id="nama_lengkap" type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_lengkap'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" value="<?= old('email'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input id="tempat_lahir" type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" name="tempat_lahir" value="<?= old('tempat_lahir'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_lahir'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input id="tanggal_lahir" type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_lahir'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input id="alamat" type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" value="<?= old('alamat'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="no_hp">No Hp</label>
                        <input id="no_hp" type="number" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" name="no_hp" value="<?= old('no_hp'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_hp'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="">== Pilih Jenis Kelamin ==</option>
                            <option value="Laki-laki" <?= (old('jenis_kelamin') == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?= (old('jenis_kelamin') == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jenis_kelamin'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="id_program">Program</label>
                        <select class="form-control <?= ($validation->hasError('id_program')) ? 'is-invalid' : ''; ?>" name="id_program" id="id_program">
                            <option value="">== Program ==</option>
                            <?php foreach ($program as $d) :  ?>
                                <option value="<?= $d['id_program']; ?>"><?= $d['nama_program']; ?></option>
                            <?php endforeach;  ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_program'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="pendidikan">Pendidikan Terakhir</label>
                        <select class="form-control <?= ($validation->hasError('pendidikan')) ? 'is-invalid' : ''; ?>" name="pendidikan" id="pendidikan">
                            <option value="">== Pendidikan Terakhir ==</option>
                            <option value="SD" <?= (old('pendidikan') == 'SD') ? 'selected' : ''; ?>>SD</option>
                            <option value="SMP" <?= (old('pendidikan') == 'SMP') ? 'selected' : ''; ?>>SMP</option>
                            <option value="SMA/SMK" <?= (old('pendidikan') == 'SMA/SMK') ? 'selected' : ''; ?>>SMA/SMK</option>
                            <option value="S1" <?= (old('pendidikan') == 'S1') ? 'selected' : ''; ?>>S1</option>
                            <option value="S2" <?= (old('pendidikan') == 'S2') ? 'selected' : ''; ?>>S2</option>
                            <option value="S3" <?= (old('pendidikan') == 'S3') ? 'selected' : ''; ?>>S3</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pendidikan'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" name="provinsi" id="provinsi">
                            <option value="" hidden></option>
                            <?php foreach ($provinsi as $prov) : ?>
                                <option value="<?= $prov['id']; ?>"><?= $prov['name']; ?></option>
                            <?php endforeach;  ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('provinsi'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="kabupaten">Kabupaten</label>
                        <select class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" name="kabupaten" id="kabupaten">
                            <?php

                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kabupaten'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="kecamatan">Kecamatan</label>
                        <select class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" name="kecamatan" id="kecamatan">
                            <?php

                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kecamatan'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="desa_kelurahan">Desa/Kelurahan</label>
                        <select class="form-control  <?= ($validation->hasError('desa_kelurahan')) ? 'is-invalid' : ''; ?>" name="desa_kelurahan" id="desa_kelurahan">
                            <?php

                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('desa_kelurahan'); ?>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Tambah Data</button>
                <a href="/asatidz" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>
<script>
    $(document).ready(function() {

        //request data kabupaten
        $('#provinsi').change(function() {
            var provinsi_id = $('#provinsi').val(); //ambil value id dari provinsi
            if (provinsi_id != '') {
                $.ajax({
                    url: "<?php echo site_url('daerah/Get_kabupaten/') ?>/" + provinsi_id,
                    method: 'GET',

                    success: function(provinsi_id) {
                        $('#kabupaten').html(provinsi_id)
                    }
                });
            }
        });
        //request data kecamatan
        $('#kabupaten').change(function() {
            var kabupaten_id = $('#kabupaten').val(); // ambil value id dari kabupaten
            if (kabupaten_id != '') {
                $.ajax({
                    url: "<?php echo site_url('daerah/Get_kecamatan/') ?>/" + kabupaten_id,
                    method: 'GET',

                    success: function(kabupaten_id) {
                        $('#kecamatan').html(kabupaten_id)
                    }
                });
            }
        });

        //request data desa
        $('#kecamatan').change(function() {
            var kecamatan_id = $('#kecamatan').val(); // ambil value id dari kecamatan
            if (kecamatan_id != '') {
                $.ajax({
                    url: "<?php echo site_url('daerah/Get_desa/') ?>/" + kecamatan_id,
                    method: 'GET',

                    success: function(kecamatan_id) {
                        $('#desa_kelurahan').html(kecamatan_id)
                    }
                });
            }
        });

        //jika tombol kirim di klik
        $('#showpass').click(function() {
            var x = document.getElementById("password");
            var y = document.getElementById("password_conf");
            if (x.type === "password" || y.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        });

    });
</script>
<?= $this->endSection(); ?>