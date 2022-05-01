<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="col">
            <a href="/daftar_ulang_add" class="btn btn-primary">
                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                    Tambah
                </span>
            </a>
        </div>
    </div>

    <?php if (session()->getFlashdata('message') != null) :  ?>
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
                    <div class="card-body">
                        <form action="<?= base_url(); ?>/daftar_ulang" method="POST" class="inline">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col">
                                        <label for="tgl_mulai">Tanggal Awal</label>
                                        <input type="date" name="tgl_mulai" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="tgl_akhir">Tanggal Akhir</label>
                                        <input type="date" name="tgl_selesai" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="tgl_akhir">Pilih Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" hidden></option>
                                            <option value="Lunas">Lunas</option>
                                            <option value="Belum Lunas">Belum Lunas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="">Pilih</label>
                                        <button type="submit" name="filter" value="Filter" class="form-control btn btn-info">Filter Data</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>nis</th>
                                        <th>nama santri</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $hariIni = new DateTime();
                                    foreach ($hasil as $k) :
                                    ?>
                                        <tr>

                                            <?php if ($k['status'] == 'Belum Lunas') : ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php else :  ?>
                                                <td> <?= $i++; ?></td>
                                            <?php endif;  ?>


                                            <?php if ($k['status'] == 'Belum Lunas') : ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php else : ?>
                                                <td> <?= $k['nis']; ?></td>
                                            <?php endif; ?>


                                            <?php if ($k['status'] == 'Belum Lunas') : ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php else : ?>
                                                <td> <?= $k['nama_lengkap']; ?></td>
                                            <?php endif;  ?>


                                            <?php if ($k['status'] == 'Belum Lunas') : ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php else : ?>
                                                <td> <?= $k['waktu']; ?></td>
                                            <?php endif; ?>

                                            <?php if ($k['status'] == 'Belum Lunas') : ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php else :  ?>
                                                <td> <?= date('d-m-Y', strtotime($k['periode'])) ?></td>
                                            <?php endif; ?>

                                            <?php if ($k['status'] == 'Belum Lunas') : ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php else : ?>
                                                <td><?= "Rp " . number_format($k['jumlah_bayar'], 2, ',', '.'); ?></td>
                                            <?php endif; ?>

                                            <?php if ($k['status'] == 'Belum Lunas') : ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php else :  ?>
                                                <td><?= "Rp " . number_format($k['jumlah_tagihan'], 2, ',', '.'); ?></td>
                                            <?php endif;  ?>

                                            <?php if ($k['status'] == 'Lunas') : ?>
                                                <td>
                                                    <p class="badge badge-success"><?= $k['status']; ?> </p>
                                                </td>
                                            <?php else :  ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php endif; ?>

                                            <?php if ($k['status'] == 'Lunas') : ?>
                                                <td> <a href="/keamanan/detail/<?= $k['id_keuangan']; ?>" onclick="topFunction()" title="DETAIL" class="btn btn-light" data-toggle="modal" data-target="#detaildaftarUlang<?= $k['id_keuangan']; ?>">
                                                        <span class="ion ion-android-open" data-pack="android" data-tags="">
                                                    </a>
                                                </td>
                                            <?php elseif ($k['status'] == 'Belum Lunas') :  ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php else :  ?>
                                                <td hidden> <?php echo '' ?></td>
                                            <?php endif  ?>


                                        </tr>

                                        <!-- Modal Detail  -->
                                        <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="detaildaftarUlang<?= $k['id_keuangan']; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Pembayaran</h5>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col">
                                                            <h6 class="text-dark">Nama Santri :<?= $k['nama_lengkap']; ?></h6>
                                                            <h6 class="text-dark">Status:
                                                                <h7 class="badge badge-success"><?= $k['status']; ?></h7>
                                                            </h6>
                                                            <h6 class="text-dark center">Bukti Transfer:</h6>
                                                            <?php if ($k['ket_bayar'] == 'langsung') :  ?>
                                                                <div class="col">
                                                                    <img src="/uploads/langsung/<?= $k['bukti']; ?>" height="400px" width="400px">
                                                                </div>
                                                            <?php else :  ?>
                                                                <div class="col">
                                                                    <img src="/uploads/transfer/<?= $k['bukti']; ?>" height="400px" width="400px">
                                                                </div>
                                                            <?php endif;  ?>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-dark">Pembayaran Daftar Ulang Belum Lunas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>nama santri</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Jumlah Pembayaran</th>
                                            <th>Jumlah Tagihan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $hariIni = new DateTime();
                                        foreach ($Belum_Lunas as $k) :
                                        ?>
                                            <tr>

                                                <?php if ($k['status'] == 'Lunas') : ?>
                                                    <td hidden> <?php echo '' ?></td>
                                                <?php else :  ?>
                                                    <td> <?= $i++; ?></td>
                                                <?php endif;  ?>


                                                <?php if ($k['status'] == 'Lunas') : ?>
                                                    <td hidden> <?php echo '' ?></td>
                                                <?php else : ?>
                                                    <td> <?= $k['nama_lengkap']; ?></td>
                                                <?php endif;  ?>

                                                <?php if ($k['status'] == 'Lunas') : ?>
                                                    <td hidden> <?php echo '' ?></td>
                                                <?php else : ?>
                                                    <td> <?= $k['waktu']; ?></td>
                                                <?php endif; ?>

                                                <?php if ($k['status'] == 'Lunas') : ?>
                                                    <td hidden> <?php echo '' ?></td>
                                                <?php else :  ?>
                                                    <td> <?= date('d-m-Y', strtotime($k['periode'])) ?></td>
                                                <?php endif; ?>

                                                <?php if ($k['status'] == 'Lunas') : ?>
                                                    <td hidden> <?php echo '' ?></td>
                                                <?php else : ?>
                                                    <td><?= "Rp " . number_format($k['jumlah_bayar'], 2, ',', '.'); ?></td>
                                                <?php endif; ?>

                                                <?php if ($k['status'] == 'Lunas') : ?>
                                                    <td hidden> <?php echo '' ?></td>
                                                <?php else :  ?>
                                                    <td><?= "Rp " . number_format($k['jumlah_tagihan'], 2, ',', '.'); ?></td>
                                                <?php endif;  ?>

                                                <?php if ($k['status'] == 'Belum Lunas') : ?>
                                                    <td>
                                                        <p class="badge badge-danger"><?= $k['status']; ?> </p>
                                                    </td>
                                                <?php else :  ?>
                                                    <td hidden> <?php echo '' ?></td>
                                                <?php endif; ?>

                                                <?php if ($k['status'] == 'Lunas') : ?>
                                                    <td hidden><?php echo ''; ?></td>
                                                <?php elseif ($k['status'] == 'Belum Lunas') :  ?>
                                                    <td>
                                                        <a type="button" class="badge badge-primary text-white" onclick="btnBayar(<?= $k['id_keuangan']; ?>)">
                                                            <span> Bayar </span>
                                                        </a>
                                                    </td>
                                                <?php else :  ?>
                                                    <td hidden><?php echo ''; ?></td>
                                                <?php endif; ?>

                                            </tr>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="daftarUlang">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open_multipart('', ['id' => 'formDaftarUlang']); ?>
                                    <div class="card-body">
                                        <input type="text" name="id_keuangan" id="id_keuangan" value="" hidden>
                                        <input type="text" name="id_santri" id="id_santri" value="" hidden>
                                        <input type="text" id="jumlah_bayar" name="jumlah_bayar" value="" hidden>
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="text-dark namaSantri"></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="text-dark Tagihan"></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="text-dark jumlahBayar"></h6>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="ket_bayar">Keterangan</label>
                                            <select id="ket_bayar" class="form-control" name="ket_bayar">
                                                <option value="" hidden></option>
                                                <option value="transfer">Transfer</option>
                                                <option value="langsung">Pembayaran Langsung</option>
                                            </select>
                                            <div class="invalid-feedback errorKet">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nis">Masukan NIS</label>
                                            <input type="number" class="form-control" name="nis" id="nis" value="">
                                            <div class="invalid-feedback errorNis">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="bukti">Masukan File</label>
                                            <input type="file" class="form-control-file " name="bukti" id="bukti" accept=".jpg,.jpeg,.png">
                                            <div class="invalid-feedback errorBukti">


                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" id="btnSave" onclick="bayar_daftarUlang()" class="btn btn-danger">Bayar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                        </div>
                                    </div>
                                    <?php form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function btnBayar(id_keuangan) {
        $('#daftarUlang').modal('show');
        $('.modal-title').text('Pembayaran Daftar Ulang');
        $.ajax({
            type: "GET",
            url: "<?= site_url('daftar_ulang/get_daftarUlang/'); ?>" + id_keuangan,
            dataType: "json",
            success: function(data) {
                $('#id_keuangan').val(data.id_keuangan);
                $('#id_santri').val(data.id_santri);
                $('#jumlah_bayar').val(data.jumlah_tagihan);
                $('.namaSantri').html("Nama Lengkap :" + data.nama_lengkap);
                $('.Tagihan').html("Tagihan :" + data.jumlah_tagihan);
                $('.jumlahBayar').html("Jumlah Telah Dibayarkan :" + data.jumlah_bayar);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    };

    function bayar_daftarUlang() {
        let form = $('#formDaftarUlang')[0];
        let data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "<?= site_url('daftar_ulang/bayar_daftarUlang'); ?>",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('#btnSave').prop('disabled', true);
                $('#btnSave').html('Loading');
            },
            complete: function() {
                $('#btnSave').prop('disabled', false);
                $('#btnSave').html('Unggah');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error
                    if (data.errorKet) {
                        $('#ket_bayar').addClass('is-invalid');
                        $('.errorKet').html(data.errorKet);
                    } else {
                        $('#ket_bayar').removeClass('is-invalid');
                        $('#ket_bayar').addClass('is-valid');
                    }
                    if (data.errorNis) {
                        $('#nis').addClass('is-invalid');
                        $('.errorNis').html(data.errorNis);
                    } else {
                        $('#nis').removeClass('is-invalid');
                        $('#nis').addClass('is-valid');
                    }
                    if (data.errorBukti) {
                        $('#bukti').addClass('is-invalid');
                        $('.errorBukti').html(data.errorBukti);
                    } else {
                        $('#bukti').removeClass('is-invalid');
                        $('#bukti').addClass('is-valid');
                    }

                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Pembayaran berhasil di inputkan`,
                    }).then((result) => {
                        if (result.value) {
                            $('#daftarUlang').modal('hide');
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
</script>
<?= $this->endSection(); ?>