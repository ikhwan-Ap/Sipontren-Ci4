<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/asatidz/add" class="btn btn-primary">
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
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Asatidz</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIK KTP</th>
                                <th>Nama Asatidz</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($asatidz as $a) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $a['nik_ktp']; ?></td>
                                    <td><?= $a['nama_lengkap']; ?></td>
                                    <td><?= $a['alamat']; ?></td>
                                    <td><?= $a['jenis_kelamin']; ?></td>
                                    <td><?= $a['no_hp']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger" title="DELETE" onclick="btnDel(<?= $a['id']; ?>)">
                                            <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                        </button>
                                        <a href="/asatidz/edit/<?= $a['id']; ?>" title="EDIT" class="btn btn-light">
                                            <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                                        </a>
                                        <button title=" DETAIL" class="btn btn-light" onclick="btnDetail(<?= $a['id']; ?>)">
                                            <span class="ion ion-android-open" data-pack="android" data-tags="">
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalAsatidz">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body Del">
                                                <form action="#" id="formAsatidz" class="form-horizontal">
                                                    <input type="text" value="" id="id" name="id" hidden>
                                                    <p>Apakah data ini akan dihapus?</p>
                                                </form>
                                            </div>
                                            <div class="modal-body Detail">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="nik_ktp">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="no_kk">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="nama_lengkap">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="no_hp">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="username">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="email">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="jenis_kelamin">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="tempat_lahir">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="tanggal_lahir">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="pendidikan">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="program">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="alamat">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="provinsi">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="kabupaten">

                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 id="kecamatan">

                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 id="desa_kelurahan">

                                                        </h6>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" onclick="delAsatidz()" class="btn btn-danger Hapus">Hapus</button>
                                                <button type="button" class="btn btn-secondary Kembali" data-dismiss="modal">Kembali</button>
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
    function btnDel(id) {
        $('#formAsatidz')[0].reset();
        $('#modalAsatidz').modal('show');
        $('.modal-title').text('Peringatan');
        $('.Del').show();
        $('.Detail').hide();
        $('.Hapus').show();
        $.ajax({
            type: "GET",
            url: "<?= site_url('asatidz/softDel/'); ?>/" + id,
            dataType: "json",
            success: function(data) {
                $('[name=id]').val(data.id);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function delAsatidz() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('asatidz/btn_softDel'); ?>",
            dataType: "json",
            data: $('#formAsatidz').serialize(),
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `Data berhasil di hapus`,
                    }).then((result) => {
                        if (result.value) {
                            $('#modalAsatidz').modal('hide');
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

    function btnDetail(id) {
        $('#formAsatidz')[0].reset();
        $('#modalAsatidz').modal('show');
        $('.modal-title').text('Detail Data Asatidz');
        $('.Del').hide();
        $('.Detail').show();
        $('.Hapus').hide();
        $.ajax({
            type: "GET",
            url: "<?= site_url('asatidz/detailAsatidz/'); ?>/" + id,
            dataType: "json",
            success: function(data) {
                $('#nik_ktp').html("NIK KTP :" + data.nik_ktp);
                $('#no_kk').html("NO KTP :" + data.no_kk);
                $('#nama_lengkap').html("Nama Lengkap :" + data.nama_lengkap);
                $('#no_hp').html("No HP :" + data.no_hp);
                $('#username').html("Username :" + data.username);
                $('#email').html("Email :" + data.email);
                $('#jenis_kelamin').html("Jenis Kelamin :" + data.jenis_kelamin);
                $('#tempat_lahir').html("Tempat Lahir :" + data.tempat_lahir);
                $('#tanggal_lahir').html("Tanggal Lahir :" + data.tanggal_lahir);
                $('#pendidikan').html("Pendidikan :" + data.pendidikan);
                $('#program').html("Program Pondok :" + data.nama_program);
                $('#alamat').html("Alamat :" + data.alamat);
                $('#provinsi').html("Provinsi :" + data.nama_provinsi);
                $('#kabupaten').html("Kabupaten :" + data.nama_kabupaten);
                $('#kecamatan').html("Kecamatan :" + data.nama_kecamatan);
                $('#desa_kelurahan').html("Desa/Kelurahan :" + data.nama_desa_kelurahan);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>
<?= $this->endSection(); ?>