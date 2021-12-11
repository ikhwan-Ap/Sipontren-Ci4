<?= $this->extend('layout/template_santri'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>
    <?= session()->getFlashdata('message'); ?>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Biodata</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" value="<?= $santri['nama_lengkap']; ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control" value="<?= $santri['nis']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No Hp</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class=" input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control phone-number" value="<?= $santri['no_hp_santri']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kamar</label>
                            <div class="input-group">
                                <input type="text" class="form-control currency" value="<?= $santri['id_kamar']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Diniyah</label>
                            <input type="text" class="form-control purchase-code" value="<?= $santri['id_diniyah']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Program</label>
                            <input type="text" class="form-control invoice-input" value="<?= $santri['id_program']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['tanggal_lahir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['tempat_lahir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['tempat_lahir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['tempat_lahir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['jenis_kelamin']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Desa/kelurahan</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['desa_kelurahan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['kecamatan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['kabupaten']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['provinsi']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['gol_darah']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Catatan Medis</label>
                            <input type="text" class="form-control creditcard" value="<?= $santri['catatan_medis']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['pendidikan_terakhir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Pengalaman Mondok</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['pengalaman_mondok']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Sekarang</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['pendidikan_sekarang']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Almet</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['nama_almet']; ?>">
                        </div>
                        <div class="form-group">
                            <label>NISN/NIM</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['nisn_nim']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['jurusan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kelas/Semester</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['kelas_semester']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['status']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Biodata Orang tua</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" class="form-control" value="<?= $santri['nama_ayah']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" class="form-control" value="<?= $santri['nama_ibu']; ?>">
                        </div>
                        <div class="form-group">
                            <label>No Hp Wali</label>
                            <input type="text" class="form-control" value="<?= $santri['no_hp_wali']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Plat Nomor</label>
                            <input type="text" class="form-control" value="<?= $santri['plat_nomor']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kendaraan</label>
                            <input type="text" class="form-control" value="<?= $santri['jenis_kendaraan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" class="form-control" value="<?= $santri['pekerjaan_ortu']; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>