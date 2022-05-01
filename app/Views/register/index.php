<?= $this->extend('layout/template_login') ?>

<?= $this->section('content_login'); ?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">
                    <img src="/img/logo-sipontren.jpeg" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="text-success">Form Pendaftaran Santri Baru</h4>
                    </div>
                    <div class="col">
                        <div class="form-group text-left">
                            <a href="/pendaftaran" class="btn btn-success btn-lg btn-icon" tabindex="4">
                                Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="#" class="formSimpan">
                            <?php foreach ($pendaftaran as $data) :  ?>
                                <input type="hidden" name="jumlah_pembayaran" id="jumlah_pembayaran" value="<?= $data['jumlah_pembayaran']; ?>">
                            <?php endforeach;  ?>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">NIK KTP</label>
                                    <input id="nik_ktp" type="number" class="form-control" name="nik_ktp">
                                    <div class=" invalid-feedback errorNik">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="no_kk">No KK</label>
                                    <input id="no_kk" type="number" class="form-control" name="no_kk">
                                    <div class="invalid-feedback errorNokk">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap">
                                    <div class="invalid-feedback errorNama">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email">
                                    <div class="invalid-feedback errorEmail">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input id="tempat_lahir" type="text" class="form-control " name="tempat_lahir">
                                    <div class="invalid-feedback errorTempatlahir">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input id="tanggal_lahir" type="date" class="form-control" name="tanggal_lahir">
                                    <div class=" invalid-feedback errorTanggal">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="provinsi">Provinsi</label>
                                    <select class="form-control" name="provinsi" id="provinsi">
                                        <option value="" hidden></option>
                                        <?php foreach ($wilayah as $provinsi) : ?>
                                            <option value="<?= $provinsi['id']; ?>"><?= $provinsi['name']; ?></option>
                                        <?php endforeach;  ?>
                                    </select>
                                    <div class="invalid-feedback errorProvinsi">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="kabupaten">Kabupaten</label>
                                    <select class="form-control " name="kabupaten" id="kabupaten">
                                        <?php

                                        ?>
                                    </select>
                                    <div class="invalid-feedback errorKabupaten">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-control" name="kecamatan" id="kecamatan">
                                        <?php

                                        ?>
                                    </select>
                                    <div class="invalid-feedback errorKecamatan">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="desa_kelurahan">Desa/Kelurahan</label>
                                    <select class="form-control " name=" desa_kelurahan" id="desa_kelurahan">
                                        <?php

                                        ?>
                                    </select>
                                    <div class="invalid-feedback errorDesa">

                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input id="alamat" type="text" class="form-control" name="alamat">
                                <div class="invalid-feedback errorAlamat">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="no_hp_santri">NO HP Santri</label>
                                    <input id="no_hp_santri" type="number" class="form-control" name="no_hp_santri">
                                    <div class="invalid-feedback errornohpSantri">
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="gol_darah">Golongan Darah Santri</label>
                                    <select class="form-control" name="gol_darah" id="gol_darah">
                                        <option value="">== Pilih Gol Darah ==</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                    <div class="invalid-feedback errorgolDarah">

                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">== Pilih Jenis Kelamin ==</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback errorjenisKelamin">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pengalaman_mondok">Pengalaman Mondok</label>
                                <textarea id="pengalaman_mondok" type="text" class="form-control " name="pengalaman_mondok"></textarea>
                                <div class="invalid-feedback errorPengalaman">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="catatan_medis">Catatan Medis</label>
                                <textarea id="catatan_medis" type="text" class="form-control " name="catatan_medis"></textarea>
                                <div class="invalid-feedback errorMedis">

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="pendidikan_sekarang">Pendidikan Sekarang</label>
                                    <select class="form-control " name="pendidikan_sekarang" id="pendidikan_sekarang">
                                        <option value="">== Pendidikan Saat Ini ==</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA/SMK">SMA/SMK</option>
                                        <option value="S1">S1</option>
                                    </select>
                                    <div class="invalid-feedback errorPendidikan_sekarang">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <select class="form-control " name="pendidikan_terakhir" id="pendidikan_terakhir">
                                        <option value="">== Pendidikan Terakhir ==</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA/SMK">SMA/SMK</option>
                                        <option value="S1">S1</option>
                                    </select>
                                    <div class="invalid-feedback errorPendidikan_terakhir">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nisn_nim">NISN / NIM</label>
                                    <input id="nisn_nim" type="number" class="form-control" name="nisn_nim">
                                    <div class="invalid-feedback errorNis">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="nama_almet">Nama Almamater</label>
                                    <input id="nama_almet" type="text" class="form-control " name="nama_almet">
                                    <div class="invalid-feedback errorAlmet">

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="jurusan">Jurusan</label>
                                    <input id="jurusan" type="text" class="form-control " name="jurusan">
                                    <div class="invalid-feedback errorJurusan">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="kelas_semester">Kelas / Semester</label>
                                    <input id="kelas_semester" type="text" class="form-control " name="kelas_semester">
                                    <div class="invalid-feedback errorKelas">

                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input id="nama_ayah" type="text" class="form-control " name="nama_ayah">
                                    <div class="invalid-feedback errornamaAyah">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input id="nama_ibu" type="text" class="form-control" name="nama_ibu">
                                    <div class="invalid-feedback errornamaIbu">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="no_hp_wali">No HP Wali</label>
                                    <input id="no_hp_wali" type="number" class="form-control " name="no_hp_wali">
                                    <div class="invalid-feedback errornohpWali">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="pekerjaan_ortu">Pekerjaan Orang Tua</label>
                                    <input id="pekerjaan_ortu" type="text" class="form-control " name="pekerjaan_ortu">
                                    <div class="invalid-feedback errorPekerjaan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                    <input id="jenis_kendaraan" type="text" class="form-control" name="jenis_kendaraan">
                                    <div class="invalid-feedback errorKendaraan">

                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="plat_nomor">Plat Nomor</label>
                                    <input id="plat_nomor" type="text" class="form-control " name="plat_nomor">
                                    <div class="invalid-feedback errorPlat">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button id="btnAdd" type="submit" class="btn btn-success btn-lg btn-block">
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

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/07323268fb.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
<script>
    // $("#kabupaten").chained("#provinsi");
    // $("#kecamatan").chained("#kabupaten");
    // $("#desa_kelurahan").chained("#kecamatan");
    $(document).ready(function() {

        //request data kabupaten
        $('#provinsi').change(function() {
            var provinsi_id = $('#provinsi').val(); //ambil value id dari provinsi
            if (provinsi_id != '') {
                $.ajax({
                    url: "<?php echo base_url('/register/Get_kabupaten/') ?>/" + provinsi_id,
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
                    url: "<?php echo base_url('/register/Get_kecamatan/') ?>/" + kabupaten_id,
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
                    url: "<?php echo base_url('/register/Get_desa/') ?>/" + kecamatan_id,
                    method: 'GET',

                    success: function(kecamatan_id) {
                        $('#desa_kelurahan').html(kecamatan_id)
                    }
                });
            }
        });

        $('.formSimpan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?= base_url('register/simpanData'); ?>",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(e) {
                    $('#btnAdd').prop('disabled', true);
                    $('#btnAdd').html('Silahkan Tunggu');
                },
                complete: function(e) {
                    $('#btnAdd').prop('disabled', false);
                    $('#btnAdd').html('Register');
                },
                success: function(response) {
                    if (response.error) {
                        let data = response.error;
                        if (data.errorNik) {
                            $('#nik_ktp').addClass('is-invalid');
                            $('.errorNik').html(data.errorNik);
                        } else {
                            $('#nik_ktp').removeClass('is-invalid');
                            $('#nik_ktp').addClass('is-valid');
                        }
                        if (data.errorNokk) {
                            $('#no_kk').addClass('is-invalid');
                            $('.errorNokk').html(data.errorNokk);
                        } else {
                            $('#no_kk').removeClass('is-invalid');
                            $('#no_kk').addClass('is-valid');
                        }
                        if (data.errorNama) {
                            $('#nama_lengkap').addClass('is-invalid');
                            $('.errorNama').html(data.errorNama);
                        } else {
                            $('#nama_lengkap').removeClass('is-invalid');
                            $('#nama_lengkap').addClass('is-valid');
                        }
                        if (data.errorEmail) {
                            $('#email').addClass('is-invalid');
                            $('.errorEmail').html(data.errorEmail);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('#email').addClass('is-valid');
                        }
                        if (data.errorTempatlahir) {
                            $('#tempat_lahir').addClass('is-invalid');
                            $('.errorTempatlahir').html(data.errorTempatlahir);
                        } else {
                            $('#tempat_lahir').removeClass('is-invalid');
                            $('#tempat_lahir').addClass('is-valid');
                        }
                        if (data.errorTanggal) {
                            $('#tanggal_lahir').addClass('is-invalid');
                            $('.errorTanggal').html(data.errorTanggal);
                        } else {
                            $('#tanggal_lahir').removeClass('is-invalid');
                            $('#tanggal_lahir').addClass('is-valid');
                        }
                        if (data.errorProvinsi) {
                            $('#provinsi').addClass('is-invalid');
                            $('.errorProvinsi').html(data.errorProvinsi);
                        } else {
                            $('#provinsi').removeClass('is-invalid');
                            $('#provinsi').addClass('is-valid');
                        }
                        if (data.errorKabupaten) {
                            $('#kabupaten').addClass('is-invalid');
                            $('.errorKabupaten').html(data.errorKabupaten);
                        } else {
                            $('#kabupaten').removeClass('is-invalid');
                            $('#kabupaten').addClass('is-valid');
                        }
                        if (data.errorKecamatan) {
                            $('#kecamatan').addClass('is-invalid');
                            $('.errorKecamatan').html(data.errorKecamatan);
                        } else {
                            $('#kecamatan').removeClass('is-invalid');
                            $('#kecamatan').addClass('is-valid');
                        }
                        if (data.errorDesa) {
                            $('#desa_kelurahan').addClass('is-invalid');
                            $('.errorDesa').html(data.errorDesa);
                        } else {
                            $('#desa_kelurahan').removeClass('is-invalid');
                            $('#desa_kelurahan').addClass('is-valid');
                        }
                        if (data.errorAlamat) {
                            $('#alamat').addClass('is-invalid');
                            $('.errorAlamat').html(data.errorAlamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('#alamat').addClass('is-valid');
                        }
                        if (data.errornohpSantri) {
                            $('#no_hp_santri').addClass('is-invalid');
                            $('.errornohpSantri').html(data.errornohpSantri);
                        } else {
                            $('#no_hp_santri').removeClass('is-invalid');
                            $('#no_hp_santri').addClass('is-valid');
                        }
                        if (data.errorgolDarah) {
                            $('#gol_darah').addClass('is-invalid');
                            $('.errorgolDarah').html(data.errorgolDarah);
                        } else {
                            $('#gol_darah').removeClass('is-invalid');
                            $('#gol_darah').addClass('is-valid');
                        }
                        if (data.errorjenisKelamin) {
                            $('#jenis_kelamin').addClass('is-invalid');
                            $('.errorjenisKelamin').html(data.errorjenisKelamin);
                        } else {
                            $('#jenis_kelamin').removeClass('is-invalid');
                            $('#jenis_kelamin').addClass('is-valid');
                        }
                        if (data.errorPengalaman) {
                            $('#pengalaman_mondok').addClass('is-invalid');
                            $('.errorPengalaman').html(data.errorPengalaman);
                        } else {
                            $('#pengalaman_mondok').removeClass('is-invalid');
                            $('#pengalaman_mondok').addClass('is-valid');
                        }
                        if (data.errorMedis) {
                            $('#catatan_medis').addClass('is-invalid');
                            $('.errorMedis').html(data.errorMedis);
                        } else {
                            $('#catatan_medis').removeClass('is-invalid');
                            $('#catatan_medis').addClass('is-valid');
                        }
                        if (data.errorPendidikan_sekarang) {
                            $('#pendidikan_sekarang').addClass('is-invalid');
                            $('.errorPendidikan_sekarang').html(data.errorPendidikan_sekarang);
                        } else {
                            $('#pendidikan_sekarang').removeClass('is-invalid');
                            $('#pendidikan_sekarang').addClass('is-valid');
                        }
                        if (data.errorPendidikan_terakhir) {
                            $('#pendidikan_terakhir').addClass('is-invalid');
                            $('.errorPendidikan_terakhir').html(data.errorPendidikan_terakhir);
                        } else {
                            $('#pendidikan_terakhir').removeClass('is-invalid');
                            $('#pendidikan_terakhir').addClass('is-valid');
                        }
                        if (data.errorNis) {
                            $('#nisn_nim').addClass('is-invalid');
                            $('.errorNis').html(data.errorNis);
                        } else {
                            $('#nisn_nim').removeClass('is-invalid');
                            $('#nisn_nim').addClass('is-valid');
                        }
                        if (data.errorAlmet) {
                            $('#nama_almet').addClass('is-invalid');
                            $('.errorAlmet').html(data.errorAlmet);
                        } else {
                            $('#nama_almet').removeClass('is-invalid');
                            $('#nama_almet').addClass('is-valid');
                        }
                        if (data.errorJurusan) {
                            $('#jurusan').addClass('is-invalid');
                            $('.errorJurusan').html(data.errorJurusan);
                        } else {
                            $('#jurusan').removeClass('is-invalid');
                            $('#jurusan').addClass('is-valid');
                        }
                        if (data.errorKelas) {
                            $('#kelas_semester').addClass('is-invalid');
                            $('.errorKelas').html(data.errorKelas);
                        } else {
                            $('#kelas_semester').removeClass('is-invalid');
                            $('#kelas_semester').addClass('is-valid');
                        }
                        if (data.errornamaAyah) {
                            $('#nama_ayah').addClass('is-invalid');
                            $('.errornamaAyah').html(data.errornamaAyah);
                        } else {
                            $('#nama_ayah').removeClass('is-invalid');
                            $('#nama_ayah').addClass('is-valid');
                        }
                        if (data.errornamaIbu) {
                            $('#nama_ibu').addClass('is-invalid');
                            $('.errornamaIbu').html(data.errornamaIbu);
                        } else {
                            $('#nama_ibu').removeClass('is-invalid');
                            $('#nama_ibu').addClass('is-valid');
                        }
                        if (data.errornohpWali) {
                            $('#no_hp_wali').addClass('is-invalid');
                            $('.errornohpWali').html(data.errornohpWali);
                        } else {
                            $('#no_hp_wali').removeClass('is-invalid');
                            $('#no_hp_wali').addClass('is-valid');
                        }
                        if (data.errorPekerjaan) {
                            $('#pekerjaan_ortu').addClass('is-invalid');
                            $('.errorPekerjaan').html(data.errorPekerjaan);
                        } else {
                            $('#pekerjaan_ortu').removeClass('is-invalid');
                            $('#pekerjaan_ortu').addClass('is-valid');
                        }
                        if (data.errorKendaraan) {
                            $('#jenis_kendaraan').addClass('is-invalid');
                            $('.errorKendaraan').html(data.errorKendaraan);
                        } else {
                            $('#jenis_kendaraan').removeClass('is-invalid');
                            $('#jenis_kendaraan').addClass('is-valid');
                        }
                        if (data.errorPlat) {
                            $('#plat_nomor').addClass('is-invalid');
                            $('.errorPlat').html(data.errorPlat);
                        } else {
                            $('#plat_nomor').removeClass('is-invalid');
                            $('#plat_nomor').addClass('is-valid');
                        }
                    }
                    if (response.sukses) {
                        window.location.replace("<?= base_url('pendaftaran') ?>/");
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

            return false;
        });

    });
</script>
<?= $this->endSection(); ?>