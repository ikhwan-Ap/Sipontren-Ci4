<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <button type="button" class="btn btn-primary" onclick="add_perizinan()" data-toggle="modal">
                Tambah
            </button>
            <!-- <a href="" data-target="modal-tambah" class="btn btn-primary">Tambah</a> -->
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

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
                                                <a href="/perizinan/terima/<?= $z['id_izin']; ?>" class="btn btn-info">Terima</a>
                                                <a href="/perizinan/ditolak/<?= $z['id_izin']; ?>" class="btn btn-dark">Tolak</a>
                                            <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null) : ?>
                                                <p class="text-center">-</p>
                                            <?php elseif (date('Y-m-d H:i:s') <= $z['tanggal_estimasi']) : ?>
                                                <a href="/perizinan/pulang_keamanan/<?= $z['id_izin']; ?>" class="btn btn-info">Pulang</a>
                                            <?php elseif (date('Y-m-d H:i:s') > $z['tanggal_estimasi']) : ?>
                                                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#terlambat<?= $z['id_izin']; ?>">
                                                    Terlambat
                                                </button>
                                            <?php else : ?>
                                                <p class="text-center">-</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal1<?= $z['id_izin']; ?>">
                                                Detail
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $z['id_izin']; ?>">
                                                Hapus
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                    <?php if (session()->get('role') == 2) : ?>
                                        <td>
                                            <?php if ($z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null && $z['tanggal_ditolak'] == null) : ?>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $z['id_izin']; ?>">
                                                    Hapus
                                                </button>
                                            <?php elseif ($z['tanggal_ditolak'] && $z['tanggal_diterima'] == null && $z['tanggal_pulang'] == null) : ?>
                                                <?php echo ''; ?>
                                            <?php else : ?>
                                                <?php echo ''; ?>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal1<?= $z['id_izin']; ?>">
                                                Detail
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                </tr>

                                <!-- Modal delete -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $z['id_izin']; ?>">
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
                                                <form action="/perizinan/<?= $z['id_izin']; ?>" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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


                                <!-- Modal Tambah Perizinan -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="modal_tambah">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Form Tambah Perizinan Santri</h5>
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="card col">
                                                        <form action="#" id="form">
                                                            <?= csrf_field(); ?>
                                                            <div class="form-group">
                                                                <input type="hidden" name="user_penginput" value="<?= $user_penginput; ?>">
                                                                <label for="nis">NIS</label>
                                                                <input id="nis" type="number" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" name="nis">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('nis'); ?>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="id_santri" id="id_santri">
                                                            <div class="form-group">
                                                                <label for="nama_lengkap">Nama Santri</label>
                                                                <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" readonly>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('nama_lengkap'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" name="keterangan" id="keterangan" rows="3"><?= old('keterangan'); ?></textarea>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('keterangan'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-6">
                                                                    <label for="tanggal_izin">Tanggal Izin</label>
                                                                    <input id="tanggal_izin" type="datetime-local" class="form-control <?= ($validation->hasError('tanggal_izin')) ? 'is-invalid' : ''; ?>" name="tanggal_izin" value="<?= old('tanggal_izin'); ?>">
                                                                    <div class="invalid-feedback">
                                                                        <?= $validation->getError('tanggal_izin'); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <label for="tanggal_estimasi">Tanggal Estimasi Kembali</label>
                                                                    <input id="tanggal_estimasi" type="datetime-local" class="form-control <?= ($validation->hasError('tanggal_estimasi')) ? 'is-invalid' : ''; ?>" name="tanggal_estimasi" value="<?= old('tanggal_estimasi'); ?>">
                                                                    <div class="invalid-feedback">
                                                                        <?= $validation->getError('tanggal_estimasi'); ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                                <!-- End Bootstrap modal -->

                                <!-- Modal Terlambat -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="terlambat<?= $z['id_izin']; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Peringatan</h5>
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/terlambat/<?= $z['id_izin']; ?>" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <p>Tambah Keterangan Terlambat</p>
                                                    <div class="form-group">
                                                        <label>Keterangan Terlambat</label>
                                                        <input type="text" class="form-control <?= ($validation->hasError('ket_terlambat')) ? 'is-invalid' : ''; ?>" id="ket_terlambat" name="ket_terlambat">
                                                        <div class=" invalid-feedback">
                                                            <?= $validation->getError('ket_terlambat'); ?>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
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
</section>`
<script>
    $(document).ready(function() {
        var save_method;
        var table;
        $('#nis').autocomplete({
            source: "<?php echo site_url('perizinan/get_autofill/?')  ?>",
            select: function(event, ui) {
                $('[name="nis"]').val(ui.item.label);
                $('[name="nama_lengkap"]').val(ui.item.nama_lengkap);
                $('[name="id_santri"]').val(ui.item.id_santri);
            }
        })
    });

    function add_perizinan() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_tambah').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person');
    };

    function save() {
        var url;
        if (save_method = 'add') {
            url = "<?php echo site_url('perizinan/perizinan_add') ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {
                //if success close modal and reload ajax table
                $('#modal_tambah').modal('hide');
                location.reload(); // for reload a page
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }
</script>
<?= $this->endSection(); ?>