<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/register" class="btn btn-primary">
                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                    Regist
                </span>
            </a>
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
    <?php elseif (session()->getFlashdata('error') != null) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <?= session()->getFlashdata('error'); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Santri Baru</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Santri</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP Santri</th>
                                <th>Nama Ayah</th>
                                <th>Pekerjaan Orang Tua</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($santri as $s) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $s['nama_lengkap']; ?></td>
                                    <td><?= $s['alamat']; ?></td>
                                    <td><?= $s['jenis_kelamin']; ?></td>
                                    <td><?= $s['no_hp_santri']; ?></td>
                                    <td><?= $s['nama_ayah']; ?></td>
                                    <td><?= $s['pekerjaan_ortu']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger" title="DELETE" onclick="btnDel(<?= $s['id_santri']; ?>)">
                                            <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                        </button>
                                        <button class="btn btn-info" title="DETAIL" onclick="btnDetail(<?= $s['id_santri']; ?>)">
                                            <span class="ion ion-android-open" data-pack="android" data-tags="">
                                        </button>
                                        <button class="btn btn-success" title="TERIMA" onclick="btnAccept(<?= $s['id_santri']; ?>)">
                                            <span class="ion ion-checkmark-round" data-pack="android" data-tags="">
                                        </button>
                                        <!-- <a href="/pendaftaran/accept/<?= $s['id_santri']; ?>" title="TERIMA" class="btn btn-success">
                                            <span class="ion ion-checkmark-round" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                        </a> -->
                                    </td>
                                </tr>

                                <!-- Modal Hapus -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalPendaftaran">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body Del">
                                                <form action="#" id="formPend" class="form-horizontal">
                                                    <input type="text" name="id_santri" id="id_santri" hidden value="">
                                                    <h5 class="hpsSantri">Apakah Data Ini Akan Di Hapus?</h5>
                                                    <h5 class="terima_santri">Apakah Data Ini Akan Di Terima?</h5>
                                                </form>
                                            </div>
                                            <div class="modal-body Detail">

                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="nama_santri">

                                                        </h6>
                                                    </div>

                                                    <div class="col">
                                                        <h6 id="pengalaman_mondok">

                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="no_ktpSantri">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="no_kkSantri">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="email_santri">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="no_hpSantri">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="jenis_kelaminSantri">

                                                        </h6>
                                                    </div>

                                                    <div class="col">
                                                        <h6 id="alamat_santri">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="provinsi">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="kabupaten">

                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="kecamatan">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="desa_kelurahan">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="pendidikan_santri">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="riwayat_santri">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="nisn_nim">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="nama_almet">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="jurusan">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="kelas_semester">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="tempat_lahirSantri">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="tanggal_lahirSantri">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="gol_darah">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="catatan_medis">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <hr>

                                                <hr>

                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="nama_ayah">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="nama_ibu">

                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="no_hp_wali">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="pekerjaan_ortu">

                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="jenis_kendaraan">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="plat_nomor">

                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" onclick="delSantri()" class="btn btn-danger Hapus">Hapus</button>
                                                <button type="button" onclick="accSantri()" class="btn btn-primary Terima">Terima</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
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
    function btnDel(id_santri) {
        $('#formPend')[0].reset();
        $('#modalPendaftaran').modal('show');
        $('.modal-title').text('Peringatan')
        $('.Del').show();
        $('.Detail').hide();
        $('.Hapus').show();
        $('.Terima').hide();
        $('.hpsSantri').show();
        $('.terima_santri').hide();
        $.ajax({
            type: "GET",
            url: "<?= site_url('pendaftaran/delSantri/'); ?>/" + id_santri,
            dataType: "json",
            success: function(data) {
                $('[name=id_santri]').val(data.id_santri);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function btnAccept(id_santri) {
        $('#formPend')[0].reset();
        $('#modalPendaftaran').modal('show');
        $('.modal-title').text('Terima Santri')
        $('.Del').show();
        $('.Detail').hide();
        $('.Terima').show();
        $('.Hapus').hide();
        $('.hpsSantri').hide();
        $('.terima_santri').show();
        $.ajax({
            type: "GET",
            url: "<?= site_url('pendaftaran/terima_santri/'); ?>/" + id_santri,
            dataType: "json",
            success: function(data) {
                $('[name=id_santri]').val(data.id_santri);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function accSantri() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('pendaftaran/accept_santri'); ?>",
            data: $('#formPend').serialize(),
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data berhasil di hapus`,
                    }).then((result) => {
                        if (result.value) {
                            $('#modalPendaftaran').modal('hide');
                            window.location.reload();
                        }
                    })
                }
            }
        });
    }

    function delSantri() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('pendaftaran/softDel/'); ?>/",
            data: $('#formPend').serialize(),
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data berhasil di hapus`,
                    }).then((result) => {
                        if (result.value) {
                            $('#modalPendaftaran').modal('hide');
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

    function btnDetail(id_santri) {
        $('#formPend')[0].reset();
        $('#modalPendaftaran').modal('show');
        $('.modal-title').text('Detail Calon Santri')
        $('.Detail').show();
        $('.Del').hide();
        $('.Hapus').hide();
        $('.Terima').hide();
        $.ajax({
            type: "GET",
            url: "<?= site_url('pendaftaran/getSantri/'); ?>/" + id_santri,
            dataType: "json",
            success: function(data) {
                $('#nama_santri').html("Nama Santri :" + data.nama_lengkap);
                $('#no_ktpSantri').html("No KTP :" + data.nik_ktp);
                $('#no_kkSantri').html("No KK :" + data.no_kk);
                $('#email_santri').html("Email :" + data.email);
                $('#no_hpSantri').html("No HP :" + data.no_hp_santri);
                $('#alamat_santri').html("Alamat :" + data.alamat);
                $('#jenis_kelaminSantri').html("Jenis Kelamin :" + data.jenis_kelamin);
                $('#provinsi').html("Provinsi :" + data.nama_provinsi);
                $('#kabupaten').html("Kabupaten :" + data.nama_kabupaten);
                $('#kecamatan').html("Kecamatan :" + data.nama_kecamatan);
                $('#desa_kelurahan').html("Desa/Kelurahan :" + data.nama_desa);
                $('#pendidikan_santri').html("Pendidikan Saat Ini :" + data.pendidikan_sekarang);
                $('#riwayat_santri').html("Pendidikan Terakhir :" + data.pendidikan_terakhir);
                $('#nisn_nim').html("NISN/NIM :" + data.nisn_nim);
                $('#nama_almet').html("Nama Almameter :" + data.nama_almet);
                $('#jurusan').html("Jurusan :" + data.jurusan);
                $('#kelas_semester').html("Kelas/Semester :" + data.kelas_semester);
                $('#tempat_lahirSantri').html("Tempat Lahir :" + data.tempat_lahir);
                $('#tanggal_lahirSantri').html("Tanggal Lahir :" + data.tanggal_lahir);
                $('#gol_darah').html("Golongan Darah :" + data.gol_darah);
                $('#catatan_medis').html("Catatan Medis :" + data.catatan_medis);
                $('#pengalaman_mondok').html("Pengalaman Mondok :" + data.pengalaman_mondok);
                $('#nama_ayah').html("Nama Ayah :" + data.nama_ayah);
                $('#nama_ibu').html("Nama Ibu :" + data.nama_ibu);
                $('#pekerjaan_ortu').html("Pekerjaan Orang Tua :" + data.pekerjaan_ortu);
                $('#no_hp_wali').html("No HP :" + data.no_hp_wali);
                $('#jenis_kendaraan').html("Jenis Kendaraan :" + data.jenis_kendaraan);
                $('#plat_nomor').html("Plat Nomor :" + data.plat_nomor);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>
<?= $this->endSection(); ?>