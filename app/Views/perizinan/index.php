<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <button type="button" class="btn btn-primary" onclick="btnAdd()">
                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                    Tambah
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
            <div class="card-header">
                <h4 class="text-dark">Data Perizinan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>Nama Santri</th>
                                <th>Tanggal Izin</th>
                                <th>Tanggal Estimasi</th>
                                <th>Status</th>
                                <?php if (session()->get('role') == 1) : ?>
                                    <th>Keputusan</th>
                                <?php endif; ?>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($izin as $z) : ?>
                                <?php $j = $i++;  ?>
                                <tr>
                                    <td><?= strrev($j); ?></td>
                                    <td><?= $z['nis']; ?></td>
                                    <td><?= $z['nama_lengkap']; ?></td>
                                    <td><?= date_format(date_create($z['tanggal_izin']), "Y-m-d H:i:s"); ?></td>
                                    <td><?= date('Y-m-d h:i:s', strtotime($z['tanggal_estimasi'])); ?></td>
                                    <td>
                                        <?php if ($z['tanggal_diterima'] == null && $z['tanggal_ditolak'] == null) : ?>
                                            <p class="badge badge-warning">Menunggu</p>
                                        <?php elseif (date('Y-m-d H:i:s') > $z['tanggal_estimasi']) : ?>
                                            <p class="badge badge-dark">Terlambat</p>
                                        <?php elseif ($z['tanggal_diterima'] && $z['tanggal_pulang'] == null) : ?>
                                            <p class="badge badge-primary">Diterima</p>
                                        <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_pulang'] == null) : ?>
                                            <p class="badge badge-danger">Ditolak</p>
                                        <?php elseif ($z['tanggal_pulang']) : ?>
                                            <p class="badge badge-success">Pulang</p>
                                        <?php endif; ?>
                                    </td>
                                    <?php if (session()->get('role') == 1) : ?>
                                        <td>
                                            <?php if ($z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null && $z['tanggal_ditolak'] == null) : ?>
                                                <button onclick="btnTerima(<?= $z['id_izin']; ?>)" class="btn btn-info">Terima</button>
                                                <button onclick="btnTolak(<?= $z['id_izin']; ?>)" class="btn btn-dark">Tolak</button>
                                            <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null) : ?>
                                                <p class="text-center">-</p>
                                            <?php elseif (date('Y-m-d H:i:s') <= $z['tanggal_estimasi']) : ?>
                                                <button onclick="btnPulang(<?= $z['id_izin']; ?>)" class="btn btn-info">Pulang</button>
                                            <?php elseif (date('Y-m-d H:i:s') > $z['tanggal_estimasi']) : ?>
                                                <button type="button" class="btn btn-dark" onclick="btnTerlambat(<?= $z['id_izin']; ?>)">
                                                    Terlambat
                                                </button>
                                            <?php else : ?>
                                                <p class="text-center">-</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-light" title="DETAIL" data-toggle="modal" data-target="#exampleModal1<?= $z['id_izin']; ?>">
                                                <span class="ion ion-android-open" data-pack="android" data-tags="">
                                            </button>
                                            <button type="button" class="btn btn-danger" title="DELETE" onclick="btnDel(<?= $z['id_izin']; ?>)">
                                                <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                    <?php if (session()->get('role') == 2) : ?>
                                        <td>
                                            <?php if ($z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null && $z['tanggal_ditolak'] == null) : ?>
                                                <button type="button" class="btn btn-danger" title="DELETE" onclick="btnDel(<?= $z['id_izin']; ?>)">
                                                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                                </button>
                                            <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null) : ?>
                                            <?php else : ?>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-light" onclick="btnTerlambat(<?= $z['id_izin']; ?>)">
                                                <span class="ion ion-android-open" data-pack="android" data-tags="">
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                </tr>


                                <!-- Modal detail -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal1<?= $z['id_izin']; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Keterangan Perizinan</h5>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?= $z['keterangan']; ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Kembali</button>
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
    <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalPerizinan">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <form action="#" id="formPerizinan">
                    <div class="modal-body tambahIzin">
                        <div class="card-body">
                            <div class="card col">
                                <div class="form-group">
                                    <input type="hidden" name="user_penginput" value="<?= session()->get('name'); ?>">
                                    <label for="nis">NIS</label>
                                    <input id="nis" type="number" class="form-control" value="" name="nis">
                                    <div class="invalid-feedback errorNis">

                                    </div>
                                </div>
                                <input type="hidden" name="id_santri" value="" id="id_santri">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Santri</label>
                                    <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" readonly>
                                    <div class="invalid-feedback errorNama">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3" value=""></textarea>
                                    <div class="invalid-feedback errorKeterangan">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="tanggal_izin">Tanggal Izin</label>
                                        <input id="tanggal_izin" type="datetime-local" class="form-control" name="tanggal_izin" value="">
                                        <div class="invalid-feedback errorIzin">

                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="tanggal_estimasi">Tanggal Estimasi Kembali</label>
                                        <input id="tanggal_estimasi" type="datetime-local" class="form-control" name="tanggal_estimasi" value="">
                                        <div class="invalid-feedback errorEstimasi">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body terlambatIzin">
                        <div class="card-body">
                            <div class="card col">
                                <input type="hidden" name="id_terlambat" id="id_terlambat" value="">
                                <input type="hidden" name="user_update" id="user_update" value="<?= session()->get('name'); ?>">
                                <div class="form-group">
                                    <label>Keterangan Terlambat</label>
                                    <input type="text" class="form-control" id="ket_terlambat" value="" name="ket_terlambat">
                                    <div class="invalid-feedback errorTerlambat">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnTambah" onclick="save()" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>`
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var save_method;
    $(document).ready(function() {
        $('#nis').autocomplete({
            source: "<?php echo site_url('perizinan/get_autofill/?')  ?>",
            select: function(event, ui) {
                $('[name="nis"]').val(ui.item.label);
                $('[name="nama_lengkap"]').val(ui.item.nama_lengkap);
                $('[name="id_santri"]').val(ui.item.id_santri);
            }
        })
    });

    function btnAdd() {
        save_method = 'add';
        $('#formPerizinan')[0].reset();
        $('#modalPerizinan').modal('show');
        $('.modal-title').text('Tambah Data Perizinan');
        $('.tambahIzin').show();
        $('.terlambatIzin').hide();
    }

    function btnTerlambat(id_izin) {
        save_method = 'update';
        $('#formPerizinan')[0].reset();
        $('#modalPerizinan').modal('show');
        $('.modal-title').text('Perizinan Terlambat');
        $('.tambahIzin').hide();
        $('.terlambatIzin').show();
        $.ajax({
            type: "GET",
            url: "<?= site_url('perizinan/get_id/'); ?>" + id_izin,
            dataType: "json",
            success: function(data) {
                $('#id_terlambat').val(data.id_izin);
            }
        });
    }

    function save() {
        if (save_method == 'add') {
            $.ajax({
                type: "POST",
                url: "<?= site_url('perizinan/save'); ?>",
                data: $('#formPerizinan').serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#btnTambah').prop('disabled', 'disabled');
                    $('#btnTambah').html('<i class ="fa fa-spin fa-spinne"></i>');
                },
                complete: function() {
                    $('#btnTambah').removeAttr('disabled');
                    $('#btnTambah').html('Tambah');
                },
                success: function(response) {
                    if (response.error) {
                        let data = response.error
                        if (data.errorNis) {
                            $('#nis').addClass('is-invalid');
                            $('.errorNis').html(data.errorNis);
                        } else {
                            $('#nis').removeClass('is-invalid');
                            $('#nis').addClass('is-valid');
                        }
                        if (data.errorNama) {
                            $('#nama_lengkap').addClass('is-invalid');
                            $('.errorNama').html(data.errorNama);
                        } else {
                            $('#nama_lengkap').removeClass('is-invalid');
                            $('#nama_lengkap').addClass('is-valid');
                        }
                        if (data.errorKeterangan) {
                            $('#keterangan').addClass('is-invalid');
                            $('.errorKeterangan').html(data.errorKeterangan);
                        } else {
                            $('#keterangan').removeClass('is-invalid');
                            $('#keterangan').addClass('is-valid');
                        }
                        if (data.errorIzin) {
                            $('#tanggal_izin').addClass('is-invalid');
                            $('.errorIzin').html(data.errorIzin);
                        } else {
                            $('#tanggal_izin').removeClass('is-invalid');
                            $('#tanggal_izin').addClass('is-valid');
                        }
                        if (data.errorEstimasi) {
                            $('#tanggal_estimasi').addClass('is-invalid');
                            $('.errorEstimasi').html(data.errorEstimasi);
                        } else {
                            $('#tanggal_estimasi').removeClass('is-invalid');
                            $('#tanggal_estimasi').addClass('is-valid');
                        }
                    }
                    if (response.fail) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal...',
                            text: 'Tanggal Izin dan Estimasi Tidak Relevan!',
                        });
                    }
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `Data Berhasil Di Konfirmasi`,
                        }).then((result) => {
                            if (result.value) {
                                $('#modalPerizinan').modal('hide');
                                window.location.reload();
                                document.body.scrollTop = 0;
                                document.documentElement.scrollTop = 0;

                            }
                        })
                    }
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "<?= site_url('perizinan/terlambat'); ?>",
                data: $('#formPerizinan').serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#btnTambah').prop('disabled', 'disabled');
                    $('#btnTambah').html('<i class ="fa fa-spin fa-spinne"></i>');
                },
                complete: function() {
                    $('#btnTambah').removeAttr('disabled');
                    $('#btnTambah').html('Konfirmasi');
                },
                success: function(response) {
                    if (response.error) {
                        let data = response.error
                        if (data.errorTerlambat) {
                            $('#ket_terlambat').addClass('is-invalid');
                            $('.errorTerlambat').html(data.errorTerlambat);
                        } else {
                            $('#ket_terlambat').removeClass('is-invalid');
                            $('#ket_terlambat').addClass('is-valid');
                        }
                    }
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `Data Berhasil Di Inputkan`,
                        }).then((result) => {
                            if (result.value) {
                                $('#modalPerizinan').modal('hide');
                                window.location.reload();
                                document.body.scrollTop = 0;
                                document.documentElement.scrollTop = 0;

                            }
                        })
                    }
                }
            });
        }


    }

    function btnPulang(id_izin) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menerima Kepulangan Santri?",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Terima!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('perizinan/pulang/'); ?>" + id_izin,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Berhasil!',
                                'Perizinan Pulang Berhasil Di Terima',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                    document.body.scrollTop = 0;
                                    document.documentElement.scrollTop = 0;
                                }
                            })
                        }
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data Tidak Jadi Di Terima :)',
                    'error'
                )
            }
        })
    }

    function btnTolak(id_izin) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menolak Perizinan Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Tolak Perizinan!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('perizinan/tolak/'); ?>" + id_izin,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Berhasil!',
                                'Perizinan Berhasil Di Tolak',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                    document.body.scrollTop = 0;
                                    document.documentElement.scrollTop = 0;
                                }
                            })
                        }
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data Tidak Jadi Di Terima :)',
                    'error'
                )
            }
        })
    }

    function btnTerima(id_izin) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menerima Perizinan Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Terima Perizinan!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('perizinan/terima/'); ?>" + id_izin,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Berhasil!',
                                'Perizinan Berhasil Di Terima',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                    document.body.scrollTop = 0;
                                    document.documentElement.scrollTop = 0;
                                }
                            })
                        }
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data Tidak Jadi Di Terima :)',
                    'error'
                )
            }
        })
    }

    function btnDel(id_izin) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Perizinan Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('perizinan/delete/'); ?>" + id_izin,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Perizinan Berhasil Di Delete',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                    document.body.scrollTop = 0;
                                    document.documentElement.scrollTop = 0;
                                }
                            })
                        }
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data Tidak Jadi Di Hapus :)',
                    'error'
                )
            }
        })
    }
</script>
<?= $this->endSection(); ?>