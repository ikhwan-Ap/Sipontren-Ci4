    <?= $this->extend('layout/template_admin'); ?>

    <?= $this->section('content'); ?>

    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
            <div class="section-header-button">
                <button class="btn btn-primary" onclick="add_alumni()">
                    <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                        Tambah
                    </span>
                </button>
                <button class="btn btn-primary" onclick="add_multiple()">
                    <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                        Tambah Multiple
                    </span>
                </button>
            </div>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="alumni">
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_token_name" />
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No. HP</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" data-backdrop="false" role="dialog" id="modalAlumni">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Peringatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" onclick="reset()">×</span>
                        </button>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="form" class="form-horizontal">
                            <div class="card-body Method">
                                <input type="hidden" value="" name="id_santri" />
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="nis">NIS Alumni</label>
                                        <input id="nis" type="number" class="form-control" value="" name="nis">
                                        <div class="invalid-feedback errorNis">

                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="no_kk">No KK</label>
                                        <input id="no_kk" type="number" class="form-control" value="" name="no_kk">
                                        <div class="invalid-feedback errorNokk">

                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="nik_ktp">NIK KTP</label>
                                    <input id="nik_ktp" type="text" class="form-control" value="" name="nik_ktp">
                                    <div class="invalid-feedback errorNik">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input id="nama_lengkap" type="text" class="form-control" value="" name="nama_lengkap">
                                        <div class="invalid-feedback errorNama">

                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" value="" name="email">
                                        <div class="invalid-feedback errorEmail">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input id="tempat_lahir" type="text" class="form-control" value="" name="tempat_lahir">
                                        <div class="invalid-feedback errorTempatlahir">

                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input id="tanggal_lahir" type="date" class="form-control" value="" name="tanggal_lahir">
                                        <div class="invalid-feedback errorTanggal">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input id="alamat" type="text" class="form-control" value="" name="alamat">
                                    <div class="invalid-feedback errorAlamat">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="no_hp_santri">No Hp</label>
                                        <input id="no_hp_santri" type="number" class="form-control" value="" name="no_hp_santri">
                                        <div class="invalid-feedback errornohpSantri">

                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-control " name="jenis_kelamin" id="jenis_kelamin" value="">
                                            <option value="">== Pilih Jenis Kelamin ==</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        <div class="invalid-feedback errorjenisKelamin">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="pendidikan_terakhir">Riwayat Pendidikan Terakhir</label>
                                        <select class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir">
                                            <option value="">== Pendidikan Terakhir Saat Ini ==</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA/SMK">SMA/SMK</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                        <div class="invalid-feedback errorPendidikan_terakhir">

                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="pendidikan_sekarang">Riwayat Pendidikan Terakhir</label>
                                        <select class="form-control" name="pendidikan_sekarang" id="pendidikan_sekarang">
                                            <option value="">== Pendidikan Sekarang saat ini ==</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA/SMK">SMA/SMK</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                        <div class="invalid-feedback errorPendidikan_sekarang">

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                    <div class="card-body Detail">
                        <div class="row">
                            <div class="col">
                                <h6 id="nis_alumni">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="nama_alumni">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="no_ktpAlumni">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="no_kkAlumni">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="email_alumni">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="no_hpAlumni">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="alamat_alumni">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="jenis_kelaminAlumni">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="pendidikan_alumni">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="riwayat_alumni">

                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 id="tempat_lahirAlumni">

                                </h6>
                            </div>
                            <div class="col">
                                <h6 id="tanggal_lahirAlumni">

                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer Foot">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                        <button type="button" id="delete" onclick="btnDel()" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-light reset" onclick="reset()" data-dismiss="modal">Tidak</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalStatus">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <div class="form-group">
                            <button type="submit" class="btn btn-light addForm">
                                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                                    Tambah Pembayaran
                                </span>
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="card col">
                                <form action="#" id="form_status" class="form-horizontal">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="nis_status">NIS</label>
                                            <input id="nis_status" type="number" class="form-control" name="nis_status">
                                            <div class="invalid-feedback errorNis_spp">

                                            </div>
                                        </div>
                                        <div class="form-group col">
                                            <label for="nama_lengkap_status">Nama Santri</label>
                                            <input id="nama_lengkap_status[]" type="text" class="form-control" name="nama_lengkap_status[]" readonly>

                                        </div>
                                        <input type="hidden" value="" name="id_santri_status[]" id="id_santri_status[]">
                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <input type="hidden" name="_method">
                                    <button type="button" onclick="tambah_spp()" class="btn btn-primary">Tambah</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var save_method;
        var table;
        $(document).ready(function() {
            table = $('#alumni').DataTable({
                "processing": true,
                "serverSide": true,
                'destroy': true,
                "order": [],
                "ajax": {
                    "url": "<?= site_url('alumni/getAlumni'); ?>",
                    "type": "POST",
                },
                "columnDefs": [{
                    "targets": [-1],
                    "orderable": false,
                }, ],

            });

            $('#nis_status').autocomplete({
                source: "<?php echo site_url('alumni/get_status/?')  ?>",
                select: function(event, ui) {
                    $('[name="nis_status"]').val(ui.item.label);
                    $('[name="nama_lengkap_status[]"]').val(ui.item.nama_lengkap);
                    $('[name="id_santri_status[]"]').val(ui.item.id_santri);
                }
            });



            $('.addForm').click(function(e) {
                e.preventDefault();
                $('#form_status').append(`
                <div class="row">
                                        <div class="form-group col">
                                            <label for="nis_status">NIS</label>
                                            <input id="nis_status" type="number" class="form-control" name="nis_status">
                                            <div class="invalid-feedback errorNis_spp">

                                            </div>
                                        </div>
                                        <div class="form-group col">
                                            <label for="nama_lengkap_status">Nama Santri</label>
                                            <input id="nama_lengkap_status" type="text" class="form-control" name="nama_lengkap_status" readonly>

                                        </div>
                                        <input type="hidden" value="" name="id_santri_status[]" id="id_santri_status[]">
                                    </div>
                `);
            })

        });

        function reload_table() {
            table.ajax.reload(null, false);
        }

        function add_alumni() {
            save_method = 'add';
            $('#form')[0].reset();
            $('#modalAlumni').modal('show');
            $('.modal-title').text('Tambah Data ALumni');
            $('#delete').hide();
        }

        function add_multiple() {
            save_method = 'add';
            $('#form_status')[0].reset();
            $('#modalStatus').modal('show');
            $('.modal-title').text('Tambah Data ALumni');
            $('#delete').hide();
        }

        function edit_alumni(id_santri) {
            save_method = 'update';
            $('#form')[0].reset();
            $('.form').show();
            $('.Foot').show();
            $('#btnSave').show();
            $('.Detail').hide();
            $.ajax({
                url: "<?= site_url('alumni/edit_alumni/'); ?>/" + id_santri,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('[name=id_santri]').val(data.id_santri);
                    $('[name=nis]').val(data.nis);
                    $('[name=nik_ktp]').val(data.nik_ktp);
                    $('[name=no_kk]').val(data.no_kk);
                    $('[name=nama_lengkap]').val(data.nama_lengkap);
                    $('[name=email]').val(data.email);
                    $('[name=tempat_lahir]').val(data.tempat_lahir);
                    $('[name=tanggal_lahir]').val(data.tanggal_lahir);
                    $('[name=alamat]').val(data.alamat);
                    $('[name=no_hp_santri]').val(data.no_hp_santri);
                    $('[name=jenis_kelamin]').val(data.jenis_kelamin);
                    $('[name=pendidikan_sekarang]').val(data.pendidikan_sekarang);
                    $('[name=pendidikan_terakhir]').val(data.pendidikan_terakhir);
                    $('#modalAlumni').modal('show');
                    $('.modal-title').text('Edit Data Alumni');
                    $('#delete').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function reset() {
            $('#nis').removeClass('is-invalid');
            $('#nis').removeClass('is-valid');
            $('#nik_ktp').removeClass('is-invalid');
            $('#nik_ktp').removeClass('is-valid');
            $('#no_kk').removeClass('is-invalid');
            $('#no_kk').removeClass('is-valid');
            $('#nama_lengkap').removeClass('is-invalid');
            $('#nama_lengkap').removeClass('is-valid');
            $('#email').removeClass('is-invalid');
            $('#email').removeClass('is-valid');
            $('#tempat_lahir').removeClass('is-invalid');
            $('#tempat_lahir').removeClass('is-valid');
            $('#tanggal_lahir').removeClass('is-invalid');
            $('#tanggal_lahir').removeClass('is-valid');
            $('#tempat_lahir').removeClass('is-invalid');
            $('#tempat_lahir').removeClass('is-valid');
            $('#jenis_kelamin').removeClass('is-valid');
            $('#jenis_kelamin').removeClass('is-invalid');
            $('#alamat').removeClass('is-valid');
            $('#alamat').removeClass('is-invalid');
            $('#pendidikan_sekarang').removeClass('is-valid');
            $('#pendidikan_sekarang').removeClass('is-invalid');
            $('#pendidikan_terakhir').removeClass('is-valid');
            $('#pendidikan_terakhir').removeClass('is-invalid');
            $('#no_hp_santri').removeClass('is-valid');
            $('#no_hp_santri').removeClass('is-invalid');
        }

        function save() {
            if (save_method == 'add') {
                url = "<?php echo site_url('alumni/add_alumni') ?>";
            } else {
                url = "<?php echo site_url('alumni/update_alumni') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        let data = response.error;
                        if (data.errorNis) {
                            $('#nis').addClass('is-invalid');
                            $('.errorNis').html(data.errorNis);
                        } else {
                            $('#nis').removeClass('is-invalid');
                            $('#nis').addClass('is-valid');
                        }
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
                        if (data.errorjenisKelamin) {
                            $('#jenis_kelamin').addClass('is-invalid');
                            $('.errorjenisKelamin').html(data.errorjenisKelamin);
                        } else {
                            $('#jenis_kelamin').removeClass('is-invalid');
                            $('#jenis_kelamin').addClass('is-valid');
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

                    }
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `Data berhasil di simpan`,
                        }).then((result) => {
                            if (result.value) {
                                $('#modalAlumni').modal('hide');
                                reset();
                                reload_table();
                            }
                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        }

        function deleteAlumni(id_santri) {
            $('#form')[0].reset();
            $('.Detail').hide();
            $('.Foot').show();
            $('#delete').show();
            $.ajax({
                type: "GET",
                url: "<?= site_url('alumni/getData/'); ?>/" + id_santri,
                dataType: "json",
                success: function(data) {
                    $('[name=id_santri]').val(data.id_santri);
                    $('#modalAlumni').modal('show');
                    $('.modal-title').text('Apakah Anda Yakin Ingin Menghapus?');
                    $('.form').hide();
                    $('#btnSave').hide();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function btnDel() {
            $.ajax({
                type: "POST",
                url: "<?= site_url('alumni/softDelete'); ?>",
                dataType: "json",
                data: $('#form').serialize(), // lebih bagus langsung hapus saja ,, 
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `Data berhasil di hapus`,
                        }).then((result) => {
                            if (result.value) {
                                $('#modalAlumni').modal('hide');
                                reload_table();
                            }
                        })

                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function btnDetail(id_santri) {
            $('#form')[0].reset();
            $('#modalAlumni').modal('show');
            $('.modal-title').text('Detail Alumni');
            $('.Detail').show();
            $.ajax({
                url: "<?= site_url('alumni/edit_alumni/'); ?>/" + id_santri,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#nis_alumni').html("Nis Alumni :" + data.nis);
                    $('#nama_alumni').html("Nama Alumni :" + data.nama_lengkap);
                    $('#no_ktpAlumni').html("No. KTP :" + data.nik_ktp);
                    $('#no_kkAlumni').html("No. KK :" + data.no_kk);
                    $('#email_alumni').html("Email :" + data.email);
                    $('#no_hpAlumni').html("No. HP :" + data.no_hp_santri);
                    $('#alamat_alumni').html("Alamat :" + data.alamat);
                    $('#jenis_kelaminAlumni').html("Jenis Kelamin :" + data.jenis_kelamin);
                    $('#pendidikan_alumni').html("Pendidikan Saat Ini :" + data.pendidikan_sekarang);
                    $('#riwayat_alumni').html("Pendidikan Terakhir :" + data.pendidikan_terakhir);
                    $('#tempat_lahirAlumni').html("Tempat Lahir :" + data.tempat_lahir);
                    $('#tanggal_lahirAlumni').html("Tanggal Lahir :" + data.tanggal_lahir);
                    $('.form').hide();
                    $('.Foot').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }
    </script>
    <?= $this->endSection(); ?>