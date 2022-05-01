<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <button onclick="btnTambah()" class="btn btn-primary">
                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                    Tambah
                </span>
            </button>
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
                    <div class="card-header">
                        <h4>Data Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pengeluaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($Pengeluaran as $k) :
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $k['nama_pengeluaran']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $k['id_keluar']; ?>">
                                                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                                </button>
                                                <button onclick="btnEdit(<?= $k['id_keluar']; ?>)" title="EDIT" class="btn btn-light">
                                                    <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $k['id_keluar']; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Peringatan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah data ini akan dihapus?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="/pengeluaran/pengeluaran_baru<?= $k['id_keluar']; ?>" method="POST">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger">Ya</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
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
        </div>
    </div>

    <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modalPengeluaran">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="formPengeluaran">
                        <input type="text" name="id_keluar" id="id_keluar" hidden>
                        <label for="nama_pengeluaran">Nama Pengeluaran</label>
                        <input type="text" class="form-control" name="nama_pengeluaran" id="nama_pengeluaran" value="">
                        <div class="invalid-feedback errorNama">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnSave" onclick="btnSave()" class="btn btn-danger">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    var save_method;

    function btnTambah() {
        save_method = 'add';
        $('#modalPengeluaran').modal('show');
        $('.modal-title').text('Tambah Data Pengeluaran');
        $('#formPengeluaran')[0].reset();
    }

    function btnEdit(id_keluar) {
        save_method = 'update';
        $('#modalPengeluaran').modal('show');
        $('.modal-title').text('Edit Data Pengeluaran');
        $('#formPengeluaran')[0].reset();
        $.ajax({
            type: "GET",
            url: "<?= site_url('pengeluaran/get_id_data/'); ?>" + id_keluar,
            dataType: "json",
            success: function(data) {
                $('#nama_pengeluaran').val(data.nama_pengeluaran);
                $('#id_keluar').val(data.id_keluar);
            }
        });
    }

    function btnSave() {
        if (save_method == 'add') {
            url = "<?= site_url('pengeluaran/tambah_data_pengeluaran'); ?>"
        } else {
            url = "<?= site_url('pengeluaran/edit_data_pengeluaran'); ?>"
        }
        $.ajax({
            type: "POST",
            url: url,
            data: $('#formPengeluaran').serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#btnSave').prop('disabled', true);
                $('#btnSave').html('Silahkan Tunggu');
            },
            complete: function() {
                $('#btnSave').prop('disabled', false);
                $('#btnSave').html('Save');
            },
            success: function(response) {
                if (response.error) {
                    let data = response.error;
                    if (data.errorNama) {
                        $('#nama_pengeluaran').addClass('is-invalid');
                        $('.errorNama').html(data.errorNama);
                    } else {
                        $('#nama_pengeluaran').removeClass('is-invalid');
                        $('#nama_pengeluaran').addClass('is-valid');
                    }
                }
                if (response.sukses) {
                    window.location.reload();
                }
            }
        });
    }
</script>
<?= $this->endSection(); ?>