<?= $this->extend('layout/template_login') ?>

<?= $this->section('content_login'); ?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">
                    <img src="/img/logo-sipontren.jpeg" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <?= session()->getFlashdata('message'); ?>

                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="text-success">Form Pendaftaran Santri Baru</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="/register">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nik_ktp">NIK KTP</label>
                                    <input id="nik_ktp" type="text" class="form-control <?= ($validation->hasError('nik_ktp')) ? 'is-invalid' : ''; ?>" name="nik_ktp" value="<?= old('nik_ktp'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nik_ktp'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="no_kk">No KK</label>
                                    <input id="no_kk" type="text" class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" name="no_kk" value="<?= old('no_kk'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_kk'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input id="nama_lengkap" type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_lengkap'); ?>
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

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="provinsi">Provinsi</label>
                                    <select class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" name="provinsi" id="provinsi">
                                        <option value="">== Pilih Provinsi ==</option>
                                        <option value="Sumatra Utara" <?= (old('provinsi') == 'Sumatra Utara') ? 'selected' : ''; ?>>Sumatra Utara</option>
                                        <option value="Jawa Tengah" <?= (old('provinsi') == 'Jawa Tengah') ? 'selected' : ''; ?>>Jawa Tengah</option>
                                        <option value="Kalimantan Timur" <?= (old('provinsi') == 'Kalimantan Timur') ? 'selected' : ''; ?>>Kalimantan Timur</option>
                                        <option value="Sulawesi Tenggara" <?= (old('provinsi') == 'Sulawesi Tenggara') ? 'selected' : ''; ?>>Sulawesi Tenggara</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('provinsi'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="kabupaten">Kabupaten</label>
                                    <select class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" name="kabupaten" id="kabupaten">
                                        <option value="">== Pilih Kabupaten ==</option>
                                        <option value="Banyumas" <?= (old('kabupaten') == 'Banyumas') ? 'selected' : ''; ?>>Banyumas</option>
                                        <option value="Purbalingga" <?= (old('kabupaten') == 'Purbalingga') ? 'selected' : ''; ?>>Purbalingga</option>
                                        <option value="Banjarnegara" <?= (old('kabupaten') == 'Banjarnegara') ? 'selected' : ''; ?>>Banjarnegara</option>
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
                                        <option value="">== Pilih Kecamatan ==</option>
                                        <option value="Kembaran" <?= (old('kecamatan') == 'Kembaran') ? 'selected' : ''; ?>>Kembaran</option>
                                        <option value="Sokaraja" <?= (old('kecamatan') == 'Sokaraja') ? 'selected' : ''; ?>>Sokaraja</option>
                                        <option value="Cilongok" <?= (old('kecamatan') == 'Cilongok') ? 'selected' : ''; ?>>Cilongok</option>
                                        <option value="Baturaden" <?= (old('kecamatan') == 'Baturaden') ? 'selected' : ''; ?>>Baturaden</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('desa_kelurahan'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="desa_kelurahan">Desa/Kelurahan</label>
                                    <select class="form-control <?= ($validation->hasError('desa_kelurahan')) ? 'is-invalid' : ''; ?>" name="desa_kelurahan" id="desa_kelurahan">
                                        <option value="">== Pilih Desa/Kelurahan ==</option>
                                        <option value="Rancamaya" <?= (old('desa_kelurahan') == 'Rancamaya') ? 'selected' : ''; ?>>Rancamaya</option>
                                        <option value="Pliken" <?= (old('desa_kelurahan') == 'Pliken') ? 'selected' : ''; ?>>Pliken</option>
                                        <option value="Bantar Kawung" <?= (old('desa_kelurahan') == 'Bantar Kawung') ? 'selected' : ''; ?>>Bantar Kawung</option>
                                        <option value="Watumas" <?= (old('desa_kelurahan') == 'Watumas') ? 'selected' : ''; ?>>Watumas</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('desa_kelurahan'); ?>
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
                                <div class="form-group col-4">
                                    <label for="no_hp_santri">NO HP Santri</label>
                                    <input id="no_hp_santri" type="text" class="form-control <?= ($validation->hasError('no_hp_santri')) ? 'is-invalid' : ''; ?>" name="no_hp_santri" value="<?= old('no_hp_santri'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_hp_santri'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="gol_darah">Golongan Darah Santri</label>
                                    <select class="form-control <?= ($validation->hasError('gol_darah')) ? 'is-invalid' : ''; ?>" name="gol_darah" id="gol_darah">
                                        <option value="">== Pilih Gol Darah ==</option>
                                        <option value="A" <?= (old('gol_darah') == 'A') ? 'selected' : ''; ?>>A</option>
                                        <option value="B" <?= (old('gol_darah') == 'B') ? 'selected' : ''; ?>>B</option>
                                        <option value="AB" <?= (old('gol_darah') == 'AB') ? 'selected' : ''; ?>>AB</option>
                                        <option value="O" <?= (old('gol_darah') == 'O') ? 'selected' : ''; ?>>O</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('gol_darah'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-4">
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

                            <div class="form-group">
                                <label for="pengalaman_mondok">Pengalaman Mondok</label>
                                <textarea id="pengalaman_mondok" type="text" class="form-control <?= ($validation->hasError('pengalaman_mondok')) ? 'is-invalid' : ''; ?>" name="pengalaman_mondok"><?= old('pengalaman_mondok'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengalaman_mondok'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="catatan_medis">Catatan Medis</label>
                                <textarea id="catatan_medis" type="text" class="form-control <?= ($validation->hasError('catatan_medis')) ? 'is-invalid' : ''; ?>" name="catatan_medis"><?= old('catatan_medis'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('catatan_medis'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="pendidikan_sekarang">Pendidikan Sekarang</label>
                                    <select class="form-control <?= ($validation->hasError('pendidikan_sekarang')) ? 'is-invalid' : ''; ?>" name="pendidikan_sekarang" id="pendidikan_sekarang">
                                        <option value="">== Pendidikan Saat Ini ==</option>
                                        <option value="SD" <?= (old('pendidikan_sekarang') == 'SD') ? 'selected' : ''; ?>>SD</option>
                                        <option value="SMP" <?= (old('pendidikan_sekarang') == 'SMP') ? 'selected' : ''; ?>>SMP</option>
                                        <option value="SMA/SMK" <?= (old('pendidikan_sekarang') == 'SMA/SMK') ? 'selected' : ''; ?>>SMA/SMK</option>
                                        <option value="S1" <?= (old('pendidikan_sekarang') == 'S1') ? 'selected' : ''; ?>>S1</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pendidikan_sekarang'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <select class="form-control <?= ($validation->hasError('pendidikan_terakhir')) ? 'is-invalid' : ''; ?>" name="pendidikan_terakhir" id="pendidikan_terakhir">
                                        <option value="">== Pendidikan Terakhir ==</option>
                                        <option value="SD" <?= (old('pendidikan_terakhir') == 'SD') ? 'selected' : ''; ?>>SD</option>
                                        <option value="SMP" <?= (old('pendidikan_terakhir') == 'SMP') ? 'selected' : ''; ?>>SMP</option>
                                        <option value="SMA/SMK" <?= (old('pendidikan_terakhir') == 'SMA/SMK') ? 'selected' : ''; ?>>SMA/SMK</option>
                                        <option value="S1" <?= (old('pendidikan_terakhir') == 'S1') ? 'selected' : ''; ?>>S1</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pendidikan_terakhir'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nisn_nim">NISN / NIM</label>
                                    <input id="nisn_nim" type="text" class="form-control <?= ($validation->hasError('nisn_nim')) ? 'is-invalid' : ''; ?>" name="nisn_nim" value="<?= old('nisn_nim'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nisn_nim'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="nama_almet">Nama Almamater</label>
                                    <input id="nama_almet" type="text" class="form-control <?= ($validation->hasError('nama_almet')) ? 'is-invalid' : ''; ?>" name="nama_almet" value="<?= old('nama_almet'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_almet'); ?>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="jurusan">Jurusan</label>
                                    <input id="jurusan" type="text" class="form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : ''; ?>" name="jurusan" value="<?= old('jurusan'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jurusan'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="kelas_semester">Kelas / Semester</label>
                                    <input id="kelas_semester" type="text" class="form-control <?= ($validation->hasError('kelas_semester')) ? 'is-invalid' : ''; ?>" name="kelas_semester" value="<?= old('kelas_semester'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('kelas_semester'); ?>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input id="nama_ayah" type="text" class="form-control <?= ($validation->hasError('nama_ayah')) ? 'is-invalid' : ''; ?>" name="nama_ayah" value="<?= old('nama_ayah'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_ayah'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input id="nama_ibu" type="text" class="form-control <?= ($validation->hasError('nama_ibu')) ? 'is-invalid' : ''; ?>" name="nama_ibu" value="<?= old('nama_ibu'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_ibu'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="no_hp_wali">No HP Wali</label>
                                    <input id="no_hp_wali" type="text" class="form-control <?= ($validation->hasError('no_hp_wali')) ? 'is-invalid' : ''; ?>" name="no_hp_wali" value="<?= old('no_hp_wali'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_hp_wali'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="pekerjaan_ortu">Pekerjaan Orang Tua</label>
                                    <input id="pekerjaan_ortu" type="text" class="form-control <?= ($validation->hasError('pekerjaan_ortu')) ? 'is-invalid' : ''; ?>" name="pekerjaan_ortu" value="<?= old('pekerjaan_ortu'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pekerjaan_ortu'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg btn-block">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; <?= date('Y'); ?> | SIPONTREN - Pondok Pesantren Darussalam Dukuhwaluh Purwokerto
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?= $this->endSection(); ?>