<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/kurikulum" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/kurikulum">Kurikulum</a></div>
            <div class="breadcrumb-item">Tambah Kurikulum</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card">
        <form action="/kurikulum" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Tambah Data Kurikulum</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="program">Program</label>
                            <select class="form-control" name="program" id="program">
                                <option value="">--- Pilih Program ---</option>
                                <?php foreach ($program as $p) : ?>
                                    <option value="<?= $p['id_program']; ?>" <?= (old('program') == $p['nama_program']) ? 'selected' : ''; ?>><?= $p['nama_program']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('program'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Asatidz</label>
                            <select class="form-control" name="asatidz" id="asatidz">
                                <option value="">--- Pilih Asatidz ---</option>
                                <?php foreach ($asatidz as $a) : ?>
                                    <option value="<?= $a['id']; ?>" <?= (old('asatidz') == $a['nama_lengkap']) ? 'selected' : ''; ?>><?= $a['nama_lengkap']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('asatidz'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Ruang Kelas</label>
                            <select class="form-control" name="kelas" id="kelas">
                                <option value="">--- Pilih Ruang Kelas ---</option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['id_kelas']; ?>" <?= (old('kelas') == $k['nama_kelas']) ? 'selected' : ''; ?>><?= $k['nama_kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('kelas'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control" name="hari" id="hari">
                                <option value="">--- Pilih Hari ---</option>
                                <option value="Senin" <?= (old('hari') == 'Senin') ? 'selected' : ''; ?>>Senin</option>
                                <option value="Selasa" <?= (old('hari') == 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
                                <option value="Rabu" <?= (old('hari') == 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
                                <option value="Kamis" <?= (old('hari') == 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
                                <option value="Jumat" <?= (old('hari') == 'Jumat') ? 'selected' : ''; ?>>Jumat</option>
                                <option value="Sabtu" <?= (old('hari') == 'Sabtu') ? 'selected' : ''; ?>>Sabtu</option>
                                <option value="Minggu" <?= (old('hari') == 'Minggu') ? 'selected' : ''; ?>>Minggu</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('hari'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Santri</label>
                            <select class="form-control select2" name="santri" id="santri" multiple="">
                                <?php foreach ($santri as $s) : ?>
                                    <option><?= $s['nama_lengkap']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('kelas'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Waktu Mulai</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai">
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError('waktu_mulai'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Waktu Selesai</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <input type="time" class="form-control" name="waktu_selesai" id="waktu_selesai">
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError('waktu_selesai'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-left">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
                <a href="/kurikulum" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>
<!-- <script>
    $("#program")
        .change(function() {
            var str = "";
            $("select option:selected").each(function() {
                str += $(this).text() + " ";
            });
            alert('isi');
        })
        .change();
</script> -->
<?= $this->endSection(); ?>