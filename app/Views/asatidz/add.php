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

    <?= session()->getFlashdata('message'); ?>

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
                            <input class="form-check-input" type="checkbox" id="show_password" onclick="myFunction()">
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
                    <div class="form-group col-4">
                        <label for="no_hp">No Hp</label>
                        <input id="no_hp" type="number" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" name="no_hp" value="<?= old('no_hp'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_hp'); ?>
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
                    <label for="program">Program</label>
                    <input id="program" type="text" class="form-control <?= ($validation->hasError('program')) ? 'is-invalid' : ''; ?>" name="program" value="<?= old('program'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('program'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="jadwal">Jadwal</label>
                    <input id="jadwal" type="text" class="form-control <?= ($validation->hasError('jadwal')) ? 'is-invalid' : ''; ?>" name="jadwal" value="<?= old('jadwal'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jadwal'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="pendidikan">Riwayat Pendidikan</label>
                        <select class="form-control <?= ($validation->hasError('pendidikan')) ? 'is-invalid' : ''; ?>" name="pendidikan" id="pendidikan">
                            <option value="">== Pendidikan Saat Ini ==</option>
                            <option value="SD" <?= (old('pendidikan') == 'SD') ? 'selected' : ''; ?>>SD</option>
                            <option value="SMP" <?= (old('pendidikan') == 'SMP') ? 'selected' : ''; ?>>SMP</option>
                            <option value="SMA/SMK" <?= (old('pendidikan') == 'SMA/SMK') ? 'selected' : ''; ?>>SMA/SMK</option>
                            <option value="S1" <?= (old('pendidikan') == 'S1') ? 'selected' : ''; ?>>S1</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pendidikan'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="total_santri">Total Santri</label>
                        <input id="total_santri" type="number" class="form-control <?= ($validation->hasError('total_santri')) ? 'is-invalid' : ''; ?>" name="total_santri" value="<?= old('total_santri'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('total_santri'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="kelas">Kelas</label>
                        <input id="kelas" type="text" class="form-control <?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?>" name="kelas" value="<?= old('kelas'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kelas'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pertemuan">Pertemuan</label>
                    <input id="pertemuan" type="text" class="form-control <?= ($validation->hasError('pertemuan')) ? 'is-invalid' : ''; ?>" name="pertemuan" value="<?= old('pertemuan'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('pertemuan'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input id="foto" type="text" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" name="foto" value="<?= old('foto'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('foto'); ?>
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