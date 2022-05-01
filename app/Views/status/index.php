<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <button type="button" class="btn btn-primary" onclick="add_spp()">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembayaran</h4>
                    </div>

                    <div class="card-body">
                        <div class="col">
                            <div class="row">
                                <form action="<?= base_url(); ?>/status_pembayaran" method="POST" class="inline">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="nama_lengkap">Nama Santri</label>
                                                <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>">
                                            </div>
                                        </div>
                                        <input id="id_santri" type="hidden" name="id_santri">
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="tahun">Pilih Bulan</label>
                                                <input type="month" name="tahun" class="form-control" id="tahun">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="">Pilih</label>
                                                <button type="submit" name="hasil" value="Hasil" class="form-control btn btn-info">Cek Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="<?= base_url(); ?>/status_pembayaran/filter" method="POST" class="inline">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="tgl_akhir">Pilih Kelas</label>
                                                <select name="id_kelas" id="id_kelas" class="form-control">
                                                    <option value="" hidden></option>
                                                    <?php foreach ($filter as $s) :  ?>
                                                        <option value="<?= $s['id_kelas']; ?>"><?= $s['nama_kelas']; ?></option>
                                                    <?php endforeach;  ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="bulan">Pilih Bulan</label>
                                                <input type="month" name="bulan" class="form-control" id="bulan">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="">Pilih</label>
                                                <button type="submit" name="filter" value="Filter" class="form-control btn btn-info">Filter Kelas</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tagihan</th>
                                        <th>Kelas</th>
                                        <th>Nama Santri</th>
                                        <th>Waktu Pembayaran</th>
                                        <th>Pembayaran</th>
                                        <th>Periode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($hasil as $p) :
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= "Rp " . number_format($p['tagihan'], 2, ',', '.'); ?></td>
                                            <td><?= $p['nama_kelas']; ?></td>
                                            <td><?= $p['nama_lengkap']; ?></td>
                                            <td><?= $p['bulan']; ?></td>
                                            <td><?= "Rp " . number_format($p['pembayaran'], 2, ',', '.'); ?></td>
                                            <?php if ($p['pembayaran'] != '0') : ?>
                                                <td><?= $p['periode']; ?></td>
                                            <?php else : ?>
                                                <td>-</td>
                                            <?php endif;  ?>
                                            <td>
                                                <?php if ($p['status'] == 'Lunas') : ?>
                                                    <p class="badge badge-success"><?= $p['status']; ?></p>
                                                <?php elseif ($p['status'] == 'Belum Lunas') : ?>
                                                    <p class="badge badge-danger"><?= $p['status']; ?></p>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <?php if (isset($p['pembayaran'])) : ?>
                                                <?php if ($p['status'] == 'Lunas') : ?>
                                                    <?php if ($p['status'] == 'Lunas') : ?>
                                                        <button type="submit" class="btn btn-light" onclick="keterangan(<?= $p['id_keuangan']; ?>)">
                                                            <span class="ion ion-android-open" data-pack="android" data-tags="" \>
                                                        </button>
                                                    <?php elseif ($p['status'] == 'Belum Lunas') : ?>
                                                        <form action="/spp/bayar_kekurangan/<?= $p['id_keuangan']; ?>" method="GET">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id_keuangan" value="<?= $p['id_keuangan']; ?>">
                                                            <button type="submit" class="btn btn-primary">Bayar Kekurangan</button>
                                                        </form>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?= csrf_field(); ?>
                                                    <button type="submit" onclick="bayarSpp(<?= $p['id_santri']; ?>)" class="btn btn-primary bayarSpp">Bayar</button>
                                                <?php endif; ?>
                                            <?php else :  ?>
                                                <?= $p['id_keuangan'] == null ?>
                                            <?php endif;  ?>
                                        </td>
                                        </tr>

                                        <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="Bayar">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"></h5>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-light addForm">
                                                                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                                                                    Tambah Pembayaran
                                                                </span>
                                                            </button>
                                                            <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <di class="modal-body form">
                                                        <form action="#" id="form" class="form-horizontal">
                                                            <div class="row">
                                                                <input type="hidden" value="" name="id_santri[]" />
                                                                <input type="hidden" id="data_santri" value="" name="data_santri" />
                                                                <input type="hidden" name="id_kelas[]" value="" />
                                                                <input type="hidden" name="id_tagihan[]" value="" />
                                                                <input type="hidden" name="jumlah_bayar[]" value="" />
                                                                <div class="form-group col nama">
                                                                    <label for="nama_lengkap">Nama Santri</label>
                                                                    <input id="nama_lengkap[]" type="text" class="form-control " name="nama_lengkap[]" readonly>

                                                                </div>
                                                                <div class="form-group col santri">
                                                                    <label for="nama_lengkap_detal">Nama Santri</label>
                                                                    <input id="nama_lengkap_detail" type="text" class="form-control " name="nama_lengkap_detail" readonly>

                                                                </div>

                                                                <div class="form-group col santri_bayar">
                                                                    <label for="ket_bayar_detail">Keterangan Bayar</label>
                                                                    <input id="ket_bayar_detail" type="text" class="form-control " name="ket_bayar_detail" readonly>

                                                                </div>

                                                                <div class="form-group col waktu">
                                                                    <label for="waktu">Tanggal Bayar</label>
                                                                    <input id="waktu[]" type="date" class="form-control " name="waktu[]">
                                                                    <div class="invalid-feedback errorWaktu">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-4 keterangan">
                                                                    <label for="ket_bayar">Ket erangan Bayar</label>
                                                                    <select id="ket_bayar[]" class="form-control " name="ket_bayar[]">
                                                                        <option value="" hidden></option>
                                                                        <option value="transfer">Transfer</option>
                                                                        <option value="langsung">Pembayaran Langsung</option>
                                                                    </select>
                                                                    <div class="invalid-feedback errorKet">

                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-4 dataBayar">
                                                                    <label for="">tagihan</label>
                                                                    <input id="jumlah_pembayaran" class="form-control" name="jumlah_pembayaran" value="" readonly>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">

                                                                <button type="button" onclick="bayar()" class="btn btn-primary Bayar">Bayar</button>
                                                                <button type="button" data-dismiss="modal" class="btn btn-dark ">Kembali</button>
                                                            </div>
                                                        </form>
                                                    </di v>
                                                </div>
                                            </div>
                                        </div>



                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="addSpp">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"></h5>
                                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="card col">
                                            <form action="#" id="form_add" class="form-horizontal">
                                                <div class="form-group">
                                                    <label for="nis">NIS</label>
                                                    <input id="nis" type="number" class="form-control" name="nis">
                                                    <div class="invalid-feedback errorNis_spp">

                                                    </div>
                                                </div>
                                                <input type="hidden" value="" name="id_santri_spp" id="id_santri_spp">
                                                <input type="hidden" value="" name="id_kelas_spp" id="id_kelas_spp">
                                                <input type="hidden" value="27" name="id_tagihan_spp" id="id_tagihan_spp">
                                                <div class="form-group">
                                                    <label for="nama_lengkap_spp">Nama Santri</label>
                                                    <input id="nama_lengkap_spp" type="text" class="form-control" name="nama_lengkap_spp" readonly>

                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah_tagihan_spp">Jumlah Tagihan</label>
                                                    <input type="number" id="jumlah_tagihan_spp" class="form-control" name="jumlah_tagihan_spp">
                                                    <div class="invalid-feedback errorTagihan_spp">

                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="hidden" name="_method">
                                                    <button type="button" onclick="tambah_spp()" class="btn btn-primary">Tambah</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
    $(document).ready(function() {
        var table;
        $('#nama_lengkap').autocomplete({
            source: "<?php echo site_url('status_pembayaran/get_autofill/?')  ?>",
            select: function(event, ui) {
                $('[name="nama_lengkap"]').val(ui.item.label);
                $('[name="nis"]').val(ui.item.nis);
                $('[name="id_santri"]').val(ui.item.id_santri);

            }
        });

        $('#nis').autocomplete({
            source: "<?php echo site_url('status_pembayaran/get_spp/?')  ?>",
            select: function(event, ui) {
                $('[name="nis"]').val(ui.item.label);
                $('[name="nama_lengkap_spp"]').val(ui.item.nama_lengkap);
                $('[name="id_santri_spp"]').val(ui.item.id_santri);
                $('[name="id_kelas_spp"]').val(ui.item.id_kelas);
            }
        });

        $('.addForm').click(function(e) {
            e.preventDefault();
            var id_santri = document.getElementById("data_santri").value;
            $.ajax({
                type: "GET",
                url: "<?= site_url('status_pembayaran/getSpp/'); ?>/" + id_santri,
                dataType: "json",
                success: function(data) {
                    $('#form').append(`
                                                                <div class="row dataForm">
                                                                <input type="hidden" value="" name="id_santri[]" />
                                                                <input type="hidden" name="id_kelas[]" value="" />
                                                                <input type="hidden" name="id_tagihan[]" value="" />
                                                                <input type="hidden" name="jumlah_bayar[]" value="" />
                                                                <div class="form-group col">
                                                                    <label for="nama_lengkap">Nama Santri</label>
                                                                    <input id="nama_lengkap[]" type="text" class="form-control " name="nama_lengkap[]" readonly>

                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="waktu">Tanggal Bayar</label>
                                                                    <input id="waktu" type="date" class="form-control " name="waktu[]">
                                                                    <div class="invalid-feedback errorWaktu">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-4">
                                                                    <label for="ket_bayar">Keterangan Bayar</label>
                                                                    <select id="ket_bayar" class="form-control " name="ket_bayar[]">
                                                                        <option value="" hidden></option>
                                                                        <option value="transfer">Transfer</option>
                                                                        <option value="langsung">Pembayaran Langsung</option>
                                                                    </select>
                                                                    <div class="invalid-feedback errorKet">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-2">
                                                                <label for="ket_bayar" type="hidden">Delete Data</label>
                                                                <button type="submit" class="btn btn-danger delForm">
                                                                <span class="ion ion-ios-trash" data-pack="android" data-tags="plus, include, invite" \>
                                                                </button>
                                                                </div>

                                                            </div>        
            `);
                    $('[name="id_santri[]"]').val(data.santri.id_santri);
                    $('[name="id_kelas[]"]').val(data.santri.id_kelas);
                    $('[name="nama_lengkap[]"]').val(data.santri.nama_lengkap);
                    $('[name="id_tagihan[]"]').val(data.kelas.id_tagihan);
                    $('[name="jumlah_pembayaran"]').val(data.tagihan.jumlah_tagihan);
                    $('[name="jumlah_bayar[]"]').val(data.tagihan.jumlah_tagihan);
                },

                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });



    });


    function add_spp() {
        $('#form_add')[0].reset();
        $('#addSpp').modal('show');
        $('.modal-title').text('Tambah Data Bayar SPP');
    }

    function tambah_spp() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('status_pembayaran/addSpp'); ?>",
            data: $('#form_add').serialize(),
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    let data = response.error;
                    if (data.errorNis_spp) {
                        $('#nis').addClass('is-invalid');
                        $('.errorNis_spp').text(data.errorNis_spp);
                    } else {
                        $('#nis').removeClass('is-invalid');
                        $('#nis').addClass('is-valid');
                    }
                    if (data.errorTagihan_spp) {
                        $('#jumlah_tagihan_spp').addClass('is-invalid');
                        $('.errorTagihan_spp').html(data.errorTagihan_spp);
                    } else {
                        $('#jumlah_tagihan_spp').removeClass('is-invalid');
                        $('#jumlah_tagihan_spp').addClass('is-valid');
                    }

                }
                if (response.session) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data dengan nama tersebut telah tersedia',
                    })
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Spp berhasil di simpan`,
                    }).then((result) => {
                        if (result.value) {
                            $('#form_add').modal('hide');
                            window.location.reload();
                        }
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function bayarSpp(id_santri) {
        $('#form')[0].reset();
        $('.modal-title').text('Bayar Spp');
        $('#Bayar').modal('show');
        $('.nama').show();
        $('.Bayar').show();
        $('.dataBayar').show();
        $('.addForm').show();
        $('.keterangan').show();
        $('.waktu').show();
        $('.santri').hide();
        $('.santri_bayar').hide();
        $.ajax({
            type: "GET",
            url: "<?= site_url('status_pembayaran/getSpp/'); ?>/" + id_santri,
            dataType: "json",
            success: function(data) {
                $('[name="id_santri[]"]').val(data.santri.id_santri);
                $('[name="data_santri"]').val(data.santri.id_santri);
                $('[name="id_kelas[]"]').val(data.santri.id_kelas);
                $('[name="nama_lengkap[]"]').val(data.santri.nama_lengkap);
                $('[name="id_tagihan[]"]').val(data.kelas.id_tagihan);
                $('[name="jumlah_pembayaran"]').val(data.tagihan.jumlah_tagihan);
                $('[name="jumlah_bayar[]"]').val(data.tagihan.jumlah_tagihan);
            },

            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function bayar() {
        $.ajax({
            url: "<?= site_url('status_pembayaran/bayar'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    let data = response.error[0];
                    for (var i = 0; i < response.length; i++) {
                        if (data.errorWaktu[i]) {
                            $('#waktu[]').addClass('is-invalid');
                            $('.errorWaktu').html(data.errorWaktu[i]);
                        } else {
                            $('#waktu[]').removeClass('is-invalid');
                            $('#waktu[]').addClass('is-valid');
                        }
                        if (data.errorKet[i]) {
                            $('#ket_bayar[]').addClass('is-invalid');
                            $('.errorKet').html(data.errorKet[i]);
                        } else {
                            $('#ket_bayar[]').removeClass('is-invalid');
                            $('#ket_bayar[]').addClass('is-valid');
                        }
                    }
                }
                if (response.session) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        html: `Terdapat pembayaran yang telah tersedia`,
                    });
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data pembayaran berhasil di simpan`,
                    }).then((result) => {
                        if (result.value) {
                            $('#Bayar').modal('hide');
                            window.location.reload();
                        }
                    })

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            },
        });
    }

    function keterangan(id_keuangan) {
        $('#Bayar').modal('show');
        $('#form')[0].reset();
        $('.modal-title').text('Keterangan');
        $('.nama').hide();
        $('.Bayar').hide();
        $('.dataBayar').hide();
        $('.addForm').hide();
        $('.keterangan').hide();
        $('.waktu').hide();
        $('.santri').show();
        $('.santri_bayar').show();
        $.ajax({
            type: "GET",
            url: "<?= site_url('status_pembayaran/getKeterangan/'); ?>/" + id_keuangan,
            dataType: "json",
            success: function(data) {
                $('[name="nama_lengkap_detail"]').val(data.nama_lengkap);
                $('[name="ket_bayar_detail"]').val(data.ket_bayar);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            },
        });
    }

    $(document).on('click', '.delForm', function(e) {
        e.preventDefault();
        $(this).parents('.dataForm').remove();
        $(this).parents('#form').remove();
    })
</script>
<?= $this->endSection(); ?>