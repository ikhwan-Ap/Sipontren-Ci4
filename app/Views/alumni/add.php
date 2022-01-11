<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/alumni" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/alumni">Alumni</a></div>
            <div class="breadcrumb-item">Tambah Alumni</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="/alumni" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Tambah Data Asatidz</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="nis">NIS Alumni</label>
                        <input id="nis" type="number" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" name="nis" value="<?= old('nis'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nis'); ?>
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
                    <label for="nik_ktp">NIK KTP</label>
                    <input id="nik_ktp" type="text" class="form-control <?= ($validation->hasError('nik_ktp')) ? 'is-invalid' : ''; ?>" name="nik_ktp" value="<?= old('nik_ktp'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nik_ktp'); ?>
                    </div>
                </div>

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
                        <label for="no_hp_santri">No Hp</label>
                        <input id="no_hp_santri" type="number" class="form-control <?= ($validation->hasError('no_hp_santri')) ? 'is-invalid' : ''; ?>" name="no_hp_santri" value="<?= old('no_hp_santri'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_hp_santri'); ?>
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

                <div class="row">
                    <div class="form-group col-6">
                        <label for="pendidikan_terakhir">Riwayat Pendidikan Terakhir</label>
                        <select class="form-control <?= ($validation->hasError('pendidikan_terakhir')) ? 'is-invalid' : ''; ?>" name="pendidikan_terakhir" id="pendidikan_terakhir">
                            <option value="">== pendidikan_terakhir Saat Ini ==</option>
                            <option value="SD" <?= (old('pendidikan_terakhir') == 'SD') ? 'selected' : ''; ?>>SD</option>
                            <option value="SMP" <?= (old('pendidikan_terakhir') == 'SMP') ? 'selected' : ''; ?>>SMP</option>
                            <option value="SMA/SMK" <?= (old('pendidikan_terakhir') == 'SMA/SMK') ? 'selected' : ''; ?>>SMA/SMK</option>
                            <option value="S1" <?= (old('pendidikan_terakhir') == 'S1') ? 'selected' : ''; ?>>S1</option>
                            <option value="S2" <?= (old('pendidikan_terakhir') == 'S2') ? 'selected' : ''; ?>>S2</option>
                            <option value="S3" <?= (old('pendidikan_terakhir') == 'S3') ? 'selected' : ''; ?>>S3</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pendidikan_terakhir'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="pendidikan_sekarang">Riwayat Pendidikan Terakhir</label>
                        <select class="form-control <?= ($validation->hasError('pendidikan_sekarang')) ? 'is-invalid' : ''; ?>" name="pendidikan_sekarang" id="pendidikan_sekarang">
                            <option value="">== pendidikan_sekarang Saat Ini ==</option>
                            <option value="SD" <?= (old('pendidikan_sekarang') == 'SD') ? 'selected' : ''; ?>>SD</option>
                            <option value="SMP" <?= (old('pendidikan_sekarang') == 'SMP') ? 'selected' : ''; ?>>SMP</option>
                            <option value="SMA/SMK" <?= (old('pendidikan_sekarang') == 'SMA/SMK') ? 'selected' : ''; ?>>SMA/SMK</option>
                            <option value="S1" <?= (old('pendidikan_sekarang') == 'S1') ? 'selected' : ''; ?>>S1</option>
                            <option value="S2" <?= (old('pendidikan_sekarang') == 'S2') ? 'selected' : ''; ?>>S2</option>
                            <option value="S3" <?= (old('pendidikan_sekarang') == 'S3') ? 'selected' : ''; ?>>S3</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pendidikan_sekarang'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Tambah Data</button>
                <a href="/alumni" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>
<?= $this->endSection(); ?>