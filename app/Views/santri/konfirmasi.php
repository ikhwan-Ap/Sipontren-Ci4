<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header" title="KEMBALI">
        <a href="/santri" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        <h1><?= $title; ?></h1>
    </div>

    <?php if (session()->getFlashdata('message') != null) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <?= session()->getFlashdata('message'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Konfirmasi Data Santri Aktif</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>Nama Santri</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP Santri</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($santriAktif as $data) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['nis']; ?></td>
                                    <td><?= $data['nama_lengkap']; ?></td>
                                    <td><?= $data['alamat']; ?></td>
                                    <td><?= $data['jenis_kelamin']; ?></td>
                                    <td><?= $data['no_hp_santri']; ?></td>
                                    <td>
                                        <div class="badges badge badge-success"><?= $data['status']; ?></div>
                                    </td>
                                    <td>
                                        <button type="button" onclick="btnKonfirmasi(<?= $data['id_santri']; ?>)" title="Konfirmasi" class="btn btn-light">
                                            <span class="ion ion-android-checkbox-outline" data-pack="default" data-tags="settings, options, cog"></span>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalKonfirmasi">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="#" id="formKonfirmasi">
                                                    <div class="card-body">
                                                        <input type="hidden" id="id_santri" name="id_santri" value="">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h6 class="text-dark nama_santri"></h6>
                                                            </div>

                                                            <div class="col">
                                                                <h6 class="text-dark nis_santri"></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-6">
                                                                <label>Password</label>
                                                                <input type="password" class="form-control" value="" id="password" name="password">
                                                                <div class="invalid-feedback errorPassword">

                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label>Konfirmasi Password</label>
                                                                <input type="password" class="form-control" value="" id="password_conf" name="password_conf">
                                                                <div class="invalid-feedback errorKonfirmasi">

                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="showpass" onclick="myFunction()">
                                                                    <label class="form-check-label" for="showpass">
                                                                        Show Password
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-6">
                                                                <label for="id_kelas">kelas</label>
                                                                <select class="form-control" name="id_kelas" id="id_kelas">
                                                                    <option value="" hidden></option>
                                                                    <?php foreach ($kelas as $d) :  ?>
                                                                        <option value="<?= $d['id_kelas']; ?>"><?= $d['nama_kelas']; ?></option>
                                                                    <?php endforeach;  ?>
                                                                </select>
                                                                <div class="invalid-feedback errorKelas">

                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="id_diniyah">Diniyah</label>
                                                                <select class="form-control" name="id_diniyah" id="id_diniyah">
                                                                    <option value="" hidden></option>
                                                                    <?php foreach ($diniyah as $d) :  ?>
                                                                        <option value="<?= $d['id_diniyah']; ?>"><?= $d['nama_diniyah']; ?></option>
                                                                    <?php endforeach;  ?>
                                                                </select>
                                                                <div class="invalid-feedback errorDiniyah">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-6">
                                                                <label for="id_program">Program</label>
                                                                <select class="form-control " name="id_program" id="id_program">
                                                                    <option value="" hidden></option>
                                                                    <?php foreach ($program as $d) :  ?>
                                                                        <option value="<?= $d['id_program']; ?>"><?= $d['nama_program']; ?></option>
                                                                    <?php endforeach;  ?>
                                                                </select>
                                                                <div class="invalid-feedback errorProgram">

                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="id_kamar">Kamar</label>
                                                                <select class="form-control " name="id_kamar" id="id_kamar">
                                                                    <option value="" hidden></option>
                                                                    <?php foreach ($kamar as $d) :  ?>
                                                                        <option value="<?= $d['id_kamar']; ?>"><?= $d['nama_kamar']; ?></option>
                                                                    <?php endforeach;  ?>
                                                                </select>
                                                                <div class="invalid-feedback errorKamar">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-6">
                                                                <label for="provinsi">Provinsi</label>
                                                                <select class="form-control " name="provinsi" id="provinsi">
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
                                                                <select class="form-control >" name="kabupaten" id="kabupaten">
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
                                                                <select class="form-control >" name="kecamatan" id="kecamatan">
                                                                    <?php

                                                                    ?>
                                                                </select>
                                                                <div class="invalid-feedback errorKecamatan">

                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="desa_kelurahan">Desa/Kelurahan</label>
                                                                <select class="form-control " name="desa_kelurahan" id="desa_kelurahan">
                                                                    <?php

                                                                    ?>
                                                                </select>
                                                                <div class="invalid-feedback errorDesa">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" onclick="btnAdd()" id="btnSave" class="btn btn-danger">Save</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    function btnKonfirmasi(id_santri) {
        $('#formKonfirmasi')[0].reset();
        $('#modalKonfirmasi').modal('show');
        $('.modal-title').text('Konfirmasi Data Santri Aktif');
        $.ajax({
            type: "GET",
            url: "<?= site_url('santri/get_id'); ?>/" + id_santri,
            dataType: "json",
            success: function(data) {
                $('[name=id_santri]').val(data.id_santri);
                $('.nama_santri').text("Nama Santri:" + data.nama_lengkap);
                $('.nis_santri').text("NIS :" + data.nis);
            }
        });
    }

    function btnAdd() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('santri/save_aktif'); ?>",
            data: $('#formKonfirmasi').serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#btnSave').prop('disabled', 'disabled');
                $('#btnSave').html('<i class ="fa fa-spin fa-spinne"></i>');
            },
            complete: function() {
                $('#btnSave').removeAttr('disabled');
                $('#btnSave').html('Save');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error
                    if (data.errorPassword) {
                        $('#password').addClass('is-invalid');
                        $('.errorPassword').html(data.errorPassword);
                    } else {
                        $('#password').removeClass('is-invalid');
                        $('#password').addClass('is-valid');
                    }
                    if (data.errorKonfirmasi) {
                        $('#password_conf').addClass('is-invalid');
                        $('.errorKonfirmasi').html(data.errorKonfirmasi);
                    } else {
                        $('#password_conf').removeClass('is-invalid');
                        $('#password_conf').addClass('is-valid');
                    }
                    if (data.errorKelas) {
                        $('#id_kelas').addClass('is-invalid');
                        $('.errorKelas').html(data.errorKelas);
                    } else {
                        $('#id_kelas').removeClass('is-invalid');
                        $('#id_kelas').addClass('is-valid');
                    }
                    if (data.errorDiniyah) {
                        $('#id_diniyah').addClass('is-invalid');
                        $('.errorDiniyah').html(data.errorDiniyah);
                    } else {
                        $('#id_diniyah').removeClass('is-invalid');
                        $('#id_diniyah').addClass('is-valid');
                    }
                    if (data.errorProgram) {
                        $('#id_program').addClass('is-invalid');
                        $('.errorProgram').html(data.errorProgram);
                    } else {
                        $('#id_program').removeClass('is-invalid');
                        $('#id_program').addClass('is-valid');
                    }
                    if (data.errorKamar) {
                        $('#id_kamar').addClass('is-invalid');
                        $('.errorKamar').html(data.errorKamar);
                    } else {
                        $('#id_kamar').removeClass('is-invalid');
                        $('#id_kamar').addClass('is-valid');
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
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di Konfirmasi`,
                    }).then((result) => {
                        if (result.value) {
                            $('#modalKonfirmasi').modal('hide');
                            window.location.reload();
                            document.body.scrollTop = 0;
                            document.documentElement.scrollTop = 0;

                        }
                    })
                }
            }
        });
    }
</script>
<?= $this->endSection(); ?>