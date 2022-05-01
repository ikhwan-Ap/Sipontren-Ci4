<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header" onclick="topFunction()" title="KEMBALI">
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
                <h4 class="text-dark">Konfirmasi Data Santri Baru</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2" style="width: 100%;">
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
                            foreach ($santriBaru as $data) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <?php if ($data['nis'] != null) : ?>
                                        <td><?= $data['nis']; ?></td>
                                    <?php else : ?>
                                        <td style="color: red">Pembayaran Harus Di Selesaikan</td>
                                    <?php endif; ?>
                                    <td><?= $data['nama_lengkap']; ?></td>
                                    <td><?= $data['alamat']; ?></td>
                                    <td><?= $data['jenis_kelamin']; ?></td>
                                    <td><?= $data['no_hp_santri']; ?></td>
                                    <td>
                                        <div class="badges badge badge-success"><?= $data['status']; ?></div>
                                    </td>
                                    <td>
                                        <?php if ($data['nis'] != null) : ?>
                                            <button type="button" onclick="btnKonfirmasi(<?= $data['id_santri']; ?>)" title="Konfirmasi" class="btn btn-light">
                                                <span class="ion ion-android-checkbox-outline" data-pack="default" data-tags="settings, options, cog"></span>
                                            </button>
                                        <?php else : ?>
                                        <?php endif;  ?>
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
                                                        <input type="text" name="id_santri" value="" hidden>
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
                                                                <input type="password" class="form-control" id="password" name="password">
                                                                <div class="invalid-feedback errorPassword">

                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label>Konfirmasi Password</label>
                                                                <input type="password" class="form-control " id="password_conf" value="" name="password_conf">
                                                                <div class="invalid-feedback errorKonfirmasi">

                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="showpass" value="" onclick="myFunction()">
                                                                    <label class="form-check-label" for="showpass">
                                                                        Show Password
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-6">
                                                                <label for="id_kelas">kelas</label>
                                                                <select class="form-control " name="id_kelas" id="id_kelas">
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
                                                                <select class="form-control " name="id_diniyah" id="id_diniyah">
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
        $('.modal-title').text('Konfirmasi Data Santri Baru');
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
            url: "<?= site_url('santri/save_baru'); ?>",
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
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di konfirmasi`,
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