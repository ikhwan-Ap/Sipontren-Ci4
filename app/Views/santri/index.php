<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>

        <div class="section-header-button">
            <a href="/santri/add" class="btn btn-primary">
                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                    Tambah
                </span>
            </a>
            <button type="button" class="btn btn-primary" onclick="btnImport()">
                <span class="ion ion-ios-cloud-upload" data-pack="android" data-tags="plus, include, invite">
                    Import
                </span>
            </button>
            <a href="/download" class="btn btn-primary" target="_blank">
                <span class="ion ion-archive" data-pack="android" data-tags="plus, include, invite">
                    Excel
                </span>
            </a>
            <a href="#" class="btn btn-primary" data-toggle="dropdown">
                <span class="ion ion-android-arrow-dropdown-circle" data-pack="android" data-tags="plus, include, invite">
                    Konfirmasi
                </span>
            </a>
            <ul class="dropdown-menu">
                <a class="nav-link" href="/konfirmasi">Santri Aktif</a>
                <a class="nav-link" href="/konfirmasi_Baru">Santri Baru</a>
            </ul>
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
                <h4 class="text-dark">Data Santri Aktif</h4>
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
                            foreach ($santri as $s) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $s['nis']; ?></td>
                                    <td><?= $s['nama_lengkap']; ?></td>
                                    <td><?= $s['alamat']; ?></td>
                                    <td><?= $s['jenis_kelamin']; ?></td>
                                    <td><?= $s['no_hp_santri']; ?></td>
                                    <td>
                                        <div class="badges badge badge-success"><?= $s['status']; ?></div>
                                    </td>
                                    <td>
                                        <button type="button" title="DELETE" class="btn btn-danger" onclick="btnDel(<?= $s['id_santri']; ?>)">
                                            <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                        </button>
                                        <a href="/santri/edit/<?= $s['id_santri']; ?>" title="EDIT" class="btn btn-light">
                                            <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                                        </a>
                                        <button type="button" title="DETAIL" class="btn btn-light" onclick="btnDetail(<?= $s['id_santri']; ?>)">
                                            <span class="ion ion-android-open" data-pack="android" data-tags="">
                                        </button>
                                    </td>
                                </tr>


                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL IMPORT EXCEL -->

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Santri Non Aktif</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
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
                            foreach ($santriNon as $s) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <th><?= $s['nis']; ?></th>
                                    <td><?= $s['nama_lengkap']; ?></td>
                                    <td><?= $s['alamat']; ?></td>
                                    <td><?= $s['jenis_kelamin']; ?></td>
                                    <td><?= $s['no_hp_santri']; ?></td>
                                    <td>
                                        <div class="badges badge badge-dark"><?= $s['status']; ?></div>
                                    </td>
                                    <td>
                                        <button type="button" title="DELETE" class="btn btn-danger" onclick="btnDel(<?= $s['id_santri']; ?>)">
                                            <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                        </button>
                                        <a href="/santri/editnonaktif/<?= $s['id_santri']; ?>" title="EDIT" class="btn btn-light">
                                            <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                                        </a>
                                        <button type="button" title="DETAIL" class="btn btn-light" onclick="btnDetail(<?= $s['id_santri']; ?>)">
                                            <span class="ion ion-android-open" data-pack="android" data-tags="">
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Delete + Detail -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalSantri">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body import">
                                                <?php echo form_open_multipart('', ['id' => 'formImport']); ?>
                                                <div class="form-group">
                                                    <label>Masukan File</label>
                                                    <input type="file" class="form-control-file" name="file_excel" accept=".xls,.xlsx">
                                                    <div class="invalid-feedback errorFile">

                                                    </div>
                                                </div>
                                                <div class="modal-footer importData">
                                                    <button type="submit" id="btnAdd" onclick="btnSave()" class="btn btn-danger btn-sm">Tambah</button>
                                                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                            <div class="modal-body detail">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="nis_santri">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="nama_santri">

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
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="pengalaman_mondok">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="kamar">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="diniyah">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="program">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="kelas">

                                                        </h6>
                                                    </div>
                                                </div>
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
                                            <div class="modal-footer detailData">
                                                <button type="button" class="btn btn-secondary kembali" data-dismiss="modal">Kembali</button>
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
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Akan Menghapus Data Ini!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, Hapus Data!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('santri/softDel/'); ?>" + id_santri,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Data Santri Berhasil Di Delete',
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

    function btnDetail(id_santri) {
        $('#modalSantri').modal('show');
        $('.modal-title').text('Detail Data Santri');
        $('.import').hide();
        $('.detail').show();
        $('#btnDel').hide();
        $('.detailData').show();
        $('.importData').hide();
        $.ajax({
            type: "POST",
            url: "<?= site_url('santri/detailSantri'); ?>/" + id_santri,
            dataType: "json",
            success: function(data) {
                if (data.nama_kelas != null) {
                    $('#nis_santri').html("Nis Santri :" + data.nis);
                } else {
                    $('#nis_santri').html("Nis Santri : -");
                }
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
                if (data.nama_kelas != null) {
                    $('#kelas').html("Kelas Pondok :" + data.nama_kelas);
                } else {
                    $('#kelas').html("Kelas Pondok : -");
                }
                if (data.nama_diniyah != null) {
                    $('#diniyah').html("Diniyah :" + data.nama_diniyah);
                } else {
                    $('#diniyah').html("Diniyah Pondok : -");
                }
                if (data.nama_program != null) {
                    $('#program').html("Program Pondok :" + data.nama_program);
                } else {
                    $('#program').html("Program Pondok : -");
                }
                if (data.nama_kamar != null) {
                    $('#kamar').html("Kamar :" + data.nama_kamar);
                } else {
                    $('#kamar').html("kamar : -");
                }
                $('#nama_ayah').html("Nama Ayah :" + data.nama_ayah);
                $('#nama_ibu').html("Nama Ibu :" + data.nama_ibu);
                $('#pekerjaan_ortu').html("Pekerjaan Orang Tua :" + data.pekerjaan_ortu);
                $('#no_hp_wali').html("No HP :" + data.no_hp_wali);
                $('#jenis_kendaraan').html("Jenis Kendaraan :" + data.jenis_kendaraan);
                $('#plat_nomor').html("Plat Nomor :" + data.plat_nomor);
            }
        });
    }

    function btnImport() {
        $('#modalSantri').modal('show');
        $('.modal-title').text('Import Data Santri');
        $('.import').show();
        $('.detail').hide();
        $('.importData').show();
        $('.detailData').hide();
    }

    function btnSave() {
        let form = $('#formImport')[0];
        let data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "<?= site_url('santri/import'); ?>",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function(e) {
                $('#btnAdd').prop('disabled', 'disabled');
                $('#btnAdd').html('<i class ="fa fa-spin fa-spinne"></i>');
            },
            complete: function(e) {
                $('#btnAdd').removeAttr('disabled');
                $('#btnAdd').html('Import');
            },
            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: `Data File Harus Di isi/ Bukan Excel !!!`,
                    }).then((result) => {
                        if (result.value) {

                        }
                    })
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data Berhasil Di tambahkan`,
                    }).then((result) => {
                        if (result.value) {
                            $('#modalSantri').modal('hide');
                            $("#file_excel").val("");
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