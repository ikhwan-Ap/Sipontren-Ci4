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
                                    <input id="tanggal_lahir" type="text" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tanggal_lahir'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Provinsi</label>
                                    <select class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>">
                                        <option value="">== Pilih Provinsi ==</option>
                                        <option value="">Sumatra Utara</option>
                                        <option value="">Jawa Tengah</option>
                                        <option value="">Kalimantan Timur</option>
                                        <option value="">Sulawesi Tenggara</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('provinsi'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label>Kabupaten</label>
                                    <select class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>">
                                        <option value="">== Pilih Kabupaten ==</option>
                                        <option value="">Banyumas</option>
                                        <option value="">Purbalingga</option>
                                        <option value="">Banjarnegara</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('kabupaten'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label>Desa/Kelurahan</label>
                                    <select class="form-control <?= ($validation->hasError('desa_kelurahan')) ? 'is-invalid' : ''; ?>">
                                        <option value="">== Pilih Desa/Kelurahan ==</option>
                                        <option value="">Rancamaya</option>
                                        <option value="">Pliken</option>
                                        <option value="">Bantar Kawung</option>
                                        <option value="">Watumas</option>
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
                                    <label for="no_hp_santri">NO HP Santri</label>
                                    <input id="no_hp_santri" type="text" class="form-control <?= ($validation->hasError('no_hp_santri')) ? 'is-invalid' : ''; ?>" name="no_hp_santri" value="<?= old('no_hp_santri'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_hp_santri'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="no_hp_wali">No HP Wali</label>
                                    <input id="no_hp_wali" type="text" class="form-control <?= ($validation->hasError('no_hp_wali')) ? 'is-invalid' : ''; ?>" name="no_hp_wali" value="<?= old('no_hp_wali'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_hp_wali'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="pekerjaan_ortu">Pekerjaan Orang Tua</label>
                                    <input id="nama_lengkap" type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_lengkap'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="gol_darah">Golongan Darah Santri</label>
                                    <input id="gol_darah" type="text" class="form-control <?= ($validation->hasError('gol_darah')) ? 'is-invalid' : ''; ?>" name="gol_darah" value="<?= old('gol_darah'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('gol_darah'); ?>
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

                            <hr>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Pendidikan Sekarang</label>
                                    <select class="form-control <?= ($validation->hasError('pendidikan_sekarang')) ? 'is-invalid' : ''; ?>">
                                        <option value="">== Pendidikan Saat Ini ==</option>
                                        <option value="">SD</option>
                                        <option value="">SMP</option>
                                        <option value="">SMA/SMK</option>
                                        <option value="">S1</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pendidikan_sekarang'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="nisn">NISN</label>
                                    <input id="nisn" type="text" class="form-control <?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?>" name="nisn" value="<?= old('nisn'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nisn'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama_almet">Nama Almamater</label>
                                    <input id="nama_almet" type="text" class="form-control <?= ($validation->hasError('nama_almet')) ? 'is-invalid' : ''; ?>" name="nama_almet" value="<?= old('nama_almet'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_almet'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="jurusan">Jurusan</label>
                                    <input id="jurusan" type="text" class="form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : ''; ?>" name="jurusan" value="<?= old('jurusan'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jurusan'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kelas_semester">Kelas / Semester</label>
                                <input id="kelas_semester" type="text" class="form-control <?= ($validation->hasError('kelas_semester')) ? 'is-invalid' : ''; ?>" name="kelas_semester" value="<?= old('kelas_semester'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kelas_semester'); ?>
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