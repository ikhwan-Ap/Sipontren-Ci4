<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/santri" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/santri">Santri</a></div>
            <div class="breadcrumb-item">Ubah Santri</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="/santri/<?= $santri['id_santri']; ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Ubah Data Santri</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id_santri" value="<?= $santri['id_santri']; ?>">
                <input type="hidden" name="id_orangtua" value="<?= $santri['id_orangtua']; ?>">

                <div class="row">
                    <div class="form-group col-6">
                        <label for="nis">NIS</label>
                        <input id="nis" type="number" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" name="nis" value="<?= (old('nis')) ? old('nis') : $santri['nis']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nis'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="status">Status</label>
                        <select class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" name="status" id="status">
                            <option value="<?= $santri['status']; ?>" hidden><?= $santri['status']; ?></option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                            <option value="Alumni">Alumni</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= (old('password')) ? old('password') : $santri['password']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password_conf')) ? 'is-invalid' : ''; ?>" id="password_conf" name="password_conf" value="<?= (old('password')) ? old('password') : $santri['password']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password_conf'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="showpass" class="custom-control-input" tabindex="3" id="showpass" onclick="myFunction()">
                        <label class="custom-control-label" for="showpass">Show Password</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="nik_ktp">NIK KTP</label>
                        <input id="nik_ktp" type="number" class="form-control <?= ($validation->hasError('nik_ktp')) ? 'is-invalid' : ''; ?>" name="nik_ktp" value="<?= (old('nik_ktp')) ? old('nik_ktp') : $santri['nik_ktp']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik_ktp'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="no_kk">No KK</label>
                        <input id="no_kk" type="number" class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" name="no_kk" value="<?= (old('no_kk')) ? old('no_kk') : $santri['no_kk']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_kk'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input id="nama_lengkap" type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $santri['nama_lengkap']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_lengkap'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" value="<?= (old('email')) ? old('email') : $santri['email']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input id="tempat_lahir" type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" name="tempat_lahir" value="<?= (old('tempat_lahir')) ? old('tempat_lahir') : $santri['tempat_lahir']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_lahir'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input id="tanggal_lahir" type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" name="tanggal_lahir" value="<?= (old('tanggal_lahir')) ? old('tanggal_lahir') : $santri['tanggal_lahir']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_lahir'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" name="provinsi" id="provinsi">
                            <option value="<?= $provinsi['id_provinsi']; ?>" hidden><?= $provinsi['nama_provinsi']; ?></option>
                            <?php foreach ($wilayah as $provinsi) : ?>
                                <option value="<?= $provinsi['id']; ?>"><?= $provinsi['name']; ?></option>
                            <?php endforeach;  ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('provinsi'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="kabupaten">Kabupaten</label>
                        <select class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" name="kabupaten" id="kabupaten">
                            <option value="<?= $kabupaten['id_kabupaten']; ?>" hidden><?= $kabupaten['nama_kabupaten']; ?></option>
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
                            <option value="<?= $kecamatan['id_kecamatan']; ?>" hidden><?= $kecamatan['nama_kecamatan']; ?></option>
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
                            <option value="<?= $desa['id_desa']; ?>" hidden><?= $desa['nama_desa']; ?></option>
                            <?php

                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('desa_kelurahan'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input id="alamat" type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $santri['alamat']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="no_hp_santri">NO HP Santri</label>
                        <input id="no_hp_santri" type="number" class="form-control <?= ($validation->hasError('no_hp_santri')) ? 'is-invalid' : ''; ?>" name="no_hp_santri" value="<?= (old('no_hp_santri')) ? old('no_hp_santri') : $santri['no_hp_santri']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_hp_santri'); ?>
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="gol_darah">Golongan Darah Santri</label>
                        <select class="form-control <?= ($validation->hasError('gol_darah')) ? 'is-invalid' : ''; ?>" name="gol_darah" id="gol_darah">
                            <option value="<?= $santri['gol_darah']; ?>" hidden><?= $santri['gol_darah']; ?></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('gol_darah'); ?>
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="<?= $santri['jenis_kelamin']; ?>" hidden><?= $santri['jenis_kelamin']; ?></option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jenis_kelamin'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pengalaman_mondok">Pengalaman Mondok</label>
                    <textarea id="pengalaman_mondok" type="text" class="form-control <?= ($validation->hasError('pengalaman_mondok')) ? 'is-invalid' : ''; ?>" name="pengalaman_mondok"><?= (old('pengalaman_mondok')) ? old('pengalaman_mondok') : $santri['pengalaman_mondok']; ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('pengalaman_mondok'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="catatan_medis">Catatan Medis</label>
                    <textarea id="catatan_medis" type="text" class="form-control <?= ($validation->hasError('catatan_medis')) ? 'is-invalid' : ''; ?>" name="catatan_medis"><?= (old('catatan_medis')) ? old('catatan_medis') : $santri['catatan_medis']; ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('catatan_medis'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="pendidikan_sekarang">Pendidikan Sekarang</label>
                        <select class="form-control <?= ($validation->hasError('pendidikan_sekarang')) ? 'is-invalid' : ''; ?>" name="pendidikan_sekarang" id="pendidikan_sekarang">
                            <option value="<?= $santri['pendidikan_sekarang']; ?>" hidden><?= $santri['pendidikan_sekarang']; ?></option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pendidikan_sekarang'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
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
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3">
                        <label for="id_kelas">kelas</label>
                        <select class="form-control <?= ($validation->hasError('id_kelas')) ? 'is-invalid' : ''; ?>" name="id_kelas" id="id_kelas">
                            <option value="<?= $santri['id_kelas']; ?>" hidden><?= $santri['nama_kelas']; ?></option>
                            <?php foreach ($kelas as $d) :  ?>
                                <option value="<?= $d['id_kelas']; ?>"><?= $d['nama_kelas']; ?></option>
                            <?php endforeach;  ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pendidikan_sekarang'); ?>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label for="id_diniyah">Diniyah</label>
                        <select class="form-control <?= ($validation->hasError('id_diniyah')) ? 'is-invalid' : ''; ?>" name="id_diniyah" id="id_diniyah">
                            <option value="<?= $santri['id_diniyah']; ?>" hidden><?= $santri['nama_diniyah']; ?></option>
                            <?php foreach ($diniyah as $d) :  ?>
                                <option value="<?= $d['id_diniyah']; ?>"><?= $d['nama_diniyah']; ?></option>
                            <?php endforeach;  ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_diniyah'); ?>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label for="id_program">Program</label>
                        <select class="form-control <?= ($validation->hasError('id_program')) ? 'is-invalid' : ''; ?>" name="id_program" id="id_program">
                            <option value="<?= $santri['id_program']; ?>" hidden><?= $santri['nama_program']; ?></option>
                            <?php foreach ($program as $d) :  ?>
                                <option value="<?= $d['id_program']; ?>"><?= $d['nama_program']; ?></option>
                            <?php endforeach;  ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_program'); ?>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label for="id_kamar">Kamar</label>
                        <select class="form-control <?= ($validation->hasError('id_kamar')) ? 'is-invalid' : ''; ?>" name="id_kamar" id="id_kamar">
                            <option value="<?= $santri['id_kamar']; ?>" hidden><?= $santri['nama_kamar']; ?></option>
                            <?php foreach ($kamar as $d) :  ?>
                                <option value="<?= $d['id_kamar']; ?>"><?= $d['nama_kamar']; ?></option>
                            <?php endforeach;  ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_kamar'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="nisn_nim">NISN / NIM</label>
                        <input id="nisn_nim" type="text" class="form-control <?= ($validation->hasError('nisn_nim')) ? 'is-invalid' : ''; ?>" name="nisn_nim" value="<?= (old('nisn_nim')) ? old('nisn_nim') : $santri['nisn_nim']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nisn_nim'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="nama_almet">Nama Almamater</label>
                        <input id="nama_almet" type="text" class="form-control <?= ($validation->hasError('nama_almet')) ? 'is-invalid' : ''; ?>" name="nama_almet" value="<?= (old('nama_almet')) ? old('nama_almet') : $santri['nama_almet']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_almet'); ?>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="jurusan">Jurusan</label>
                        <input id="jurusan" type="text" class="form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : ''; ?>" name="jurusan" value="<?= (old('jurusan')) ? old('jurusan') : $santri['jurusan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jurusan'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="kelas_semester">Kelas / Semester</label>
                        <input id="kelas_semester" type="text" class="form-control <?= ($validation->hasError('kelas_semester')) ? 'is-invalid' : ''; ?>" name="kelas_semester" value="<?= (old('kelas_semester')) ? old('kelas_semester') : $santri['kelas_semester']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kelas_semester'); ?>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="nama_ayah">Nama Ayah</label>
                        <input id="nama_ayah" type="text" class="form-control <?= ($validation->hasError('nama_ayah')) ? 'is-invalid' : ''; ?>" name="nama_ayah" value="<?= (old('nama_ayah')) ? old('nama_ayah') : $santri['nama_ayah']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_ayah'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="nama_ibu">Nama Ibu</label>
                        <input id="nama_ibu" type="text" class="form-control <?= ($validation->hasError('nama_ibu')) ? 'is-invalid' : ''; ?>" name="nama_ibu" value="<?= (old('nama_ibu')) ? old('nama_ibu') : $santri['nama_ibu']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_ibu'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="no_hp_wali">No HP Wali</label>
                        <input id="no_hp_wali" type="text" class="form-control <?= ($validation->hasError('no_hp_wali')) ? 'is-invalid' : ''; ?>" name="no_hp_wali" value="<?= (old('no_hp_wali')) ? old('no_hp_wali') : $santri['no_hp_wali']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_hp_wali'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="pekerjaan_ortu">Pekerjaan Orang Tua</label>
                        <input id="pekerjaan_ortu" type="text" class="form-control <?= ($validation->hasError('pekerjaan_ortu')) ? 'is-invalid' : ''; ?>" name="pekerjaan_ortu" value="<?= (old('pekerjaan_ortu')) ? old('pekerjaan_ortu') : $santri['pekerjaan_ortu']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('pekerjaan_ortu'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="jenis_kendaraan">Jenis Kendaraan</label>
                        <input id="jenis_kendaraan" type="text" class="form-control <?= ($validation->hasError('jenis_kendaraan')) ? 'is-invalid' : ''; ?>" name="jenis_kendaraan" value="<?= (old('jenis_kendaraan')) ? old('jenis_kendaraan') : $santri['jenis_kendaraan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jenis_kendaraan'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="plat_nomor">Plat Nomor</label>
                        <input id="plat_nomor" type="text" class="form-control <?= ($validation->hasError('plat_nomor')) ? 'is-invalid' : ''; ?>" name="plat_nomor" value="<?= (old('plat_nomor')) ? old('plat_nomor') : $santri['plat_nomor']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('plat_nomor'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Ubah Data</button>
                <a href="/santri" class="btn btn-light ml-2">Batal</a>
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
                    url: "<?php echo base_url('/santri/Get_kabupaten/') ?>/" + provinsi_id,
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
                    url: "<?php echo base_url('/santri/Get_kecamatan/') ?>/" + kabupaten_id,
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
                    url: "<?php echo base_url('/santri/Get_desa/') ?>/" + kecamatan_id,
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