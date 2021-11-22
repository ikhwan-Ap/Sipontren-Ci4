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
                            <option value="">== Pilih Status</option>
                            <option value="Aktif" <?= ($santri['status'] == "Aktif") ? 'selected' : old('status'); ?>>Aktif</option>
                            <option value="Non Aktif" <?= ($santri['status'] == "Non Aktif") ? 'selected' : old('status'); ?>>Non Aktif</option>
                            <option value="Alumni" <?= ($santri['status'] == "Alumni") ? 'selected' : old('status'); ?>>Alumni</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status'); ?>
                        </div>
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
                            <option value="">Pilih Provinsi</option>
                            <option value="Sumatera Utara" <?= ($santri['provinsi'] == "Sumatera Utara") ? 'selected' : old('provinsi'); ?>>Sumatera Utara</option>
                            <option value="Jawa Tengah" <?= ($santri['provinsi'] == "Jawa Tengah") ? 'selected' : old('provinsi'); ?>>Jawa Tengah</option>
                            <option value="Sulawesi Tenggara" <?= ($santri['provinsi'] == "Sulawesi Tenggara") ? 'selected' : old('provinsi'); ?>>Sulawesi Tenggara</option>
                            <option value="Kalimantan Timur" <?= ($santri['provinsi'] == "Kalimantan Timur") ? 'selected' : old('provinsi'); ?>>Kalimantan Timur</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('provinsi'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="kabupaten">Kabupaten</label>
                        <select class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" name="kabupaten" id="kabupaten">
                            <option value="">== Pilih Kabupaten ==</option>
                            <option value="Banyumas" <?= ($santri['kabupaten'] == "Banyumas") ? 'selected' : old('kabupaten'); ?>>Banyumas</option>
                            <option value="Purbalingga" <?= ($santri['kabupaten'] == "Purbalingga") ? 'selected' : old('kabupaten'); ?>>Purbalingga</option>
                            <option value="Banjarnegara" <?= ($santri['kabupaten'] == "Banjarnegara") ? 'selected' : old('kabupaten'); ?>>Banjarnegara</option>
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
                            <option value="Kembaran" <?= ($santri['kecamatan']) ? 'selected' : old('kecamatan'); ?>>Kembaran</option>
                            <option value="Sokaraja" <?= ($santri['kecamatan']) ? 'selected' : old('kecamatan'); ?>>Sokaraja</option>
                            <option value="Cilongok" <?= ($santri['kecamatan']) ? 'selected' : old('kecamatan'); ?>>Cilongok</option>
                            <option value="Baturaden" <?= ($santri['kecamatan']) ? 'selected' : old('kecamatan'); ?>>Baturaden</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kecamatan'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="desa_kelurahan">Desa/Kelurahan</label>
                        <select class="form-control <?= ($validation->hasError('desa_kelurahan')) ? 'is-invalid' : ''; ?>" name="desa_kelurahan" id="desa_kelurahan">
                            <option value="">== Pilih Desa/Kelurahan ==</option>
                            <option value="Rancamaya" <?= ($santri['desa_kelurahan']) ? 'selected' : old('desa_kelurahan'); ?>>Rancamaya</option>
                            <option value="Pliken" <?= ($santri['desa_kelurahan']) ? 'selected' : old('desa_kelurahan'); ?>>Pliken</option>
                            <option value="Bantar Kawung" <?= ($santri['desa_kelurahan']) ? 'selected' : old('desa_kelurahan'); ?>>Bantar Kawung</option>
                            <option value="Watumas" <?= ($santri['desa_kelurahan']) ? 'selected' : old('desa_kelurahan'); ?>>Watumas</option>
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
                            <option value="">== Pilih Gol Darah ==</option>
                            <option value="A" <?= ($santri['gol_darah']) ? 'selected' : old('gol_darah'); ?>>A</option>
                            <option value="B" <?= ($santri['gol_darah']) ? 'selected' : old('gol_darah'); ?>>B</option>
                            <option value="AB" <?= ($santri['gol_darah']) ? 'selected' : old('gol_darah'); ?>>AB</option>
                            <option value="O" <?= ($santri['gol_darah']) ? 'selected' : old('gol_darah'); ?>>O</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('gol_darah'); ?>
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="">== Pilih Jenis Kelamin ==</option>
                            <option value="Laki-laki" <?= ($santri['jenis_kelamin']) ? 'selected' : old('jenis_kelamin'); ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($santri['jenis_kelamin']) ? 'selected' : old('jenis_kelamin'); ?>>Perempuan</option>
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
                            <option value="">== Pendidikan Saat Ini ==</option>
                            <option value="SD" <?= ($santri['pendidikan_sekarang']) ? 'selected' : old('pendidikan_sekarang'); ?>>SD</option>
                            <option value="SMP" <?= ($santri['pendidikan_sekarang']) ? 'selected' : old('pendidikan_sekarang'); ?>>SMP</option>
                            <option value="SMA/SMK" <?= ($santri['pendidikan_sekarang']) ? 'selected' : old('pendidikan_sekarang'); ?>>SMA/SMK</option>
                            <option value="S1" <?= ($santri['pendidikan_sekarang']) ? 'selected' : old('pendidikan_sekarang'); ?>>S1</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pendidikan_sekarang'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                        <select class="form-control <?= ($validation->hasError('pendidikan_terakhir')) ? 'is-invalid' : ''; ?>" name="pendidikan_terakhir" id="pendidikan_terakhir">
                            <option value="">== Pendidikan Terakhir ==</option>
                            <option value="SD" <?= ($santri['pendidikan_terakhir']) ? 'selected' : old('pendidikan_terakhir'); ?>>SD</option>
                            <option value="SMP" <?= ($santri['pendidikan_terakhir']) ? 'selected' : old('pendidikan_terakhir'); ?>>SMP</option>
                            <option value="SMA/SMK" <?= ($santri['pendidikan_terakhir']) ? 'selected' : old('pendidikan_terakhir'); ?>>SMA/SMK</option>
                            <option value="S1" <?= ($santri['pendidikan_terakhir']) ? 'selected' : old('pendidikan_terakhir'); ?>>S1</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pendidikan_terakhir'); ?>
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
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Ubah Data</button>
                <a href="/santri" class="btn btn-light ml-2">Batal</a>
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