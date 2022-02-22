<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
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
                                    <td><?= date_format(date_create($z['tanggal_izin']), "Y-m-d h:i:s"); ?></td>
                                    <td><?= date_format(date_create($z['tanggal_estimasi']), "Y-m-d h:i:s"); ?></td>
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
                                    <?php if (session()->get('role') == 3) : ?>
                                        <td>


                                            <?php if (date('Y-m-d H:i:s') <= $z['tanggal_estimasi']) : ?>
                                                <a href="/perizinan/pulang_keamanan/<?= $z['id_izin']; ?>" class="btn btn-info">Pulang</a>
                                            <?php elseif (date('Y-m-d H:i:s') > $z['tanggal_estimasi']) : ?>
                                                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#terlambat<?= $z['id_izin']; ?>">
                                                    Terlambat
                                                </button>
                                            <?php else : ?>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal<?= $z['id_izin']; ?>">
                                                Detail
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                </tr>

                                <!-- Modal Terlambat -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="terlambat<?= $z['id_izin']; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Peringatan</h5>
                                                <button type="button" class="close" data-dismiss="modal">
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

                                <!-- Modal detail -->
                                <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $z['id_izin']; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Keterangan Perizinan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
</section>`
<?= $this->endSection(); ?>