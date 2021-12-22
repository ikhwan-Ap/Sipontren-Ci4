<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/perizinan/add" class="btn btn-primary">Tambah</a>
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
                                <th>Tanggal Kembali</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($izin as $z) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $z['nis']; ?></td>
                                    <td><?= $z['nama_lengkap']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($z['tanggal_izin'])); ?></td>
                                    <td><?= date('d-m-Y', strtotime($z['tanggal_kembali'])); ?></td>
                                    <td><?= $z['keterangan']; ?></td>
                                    <td>
                                        <?php if ($z['status_izin'] == 'Menunggu') : ?>
                                            <a href="" class="badge badge-warning"><?= $z['status_izin']; ?></a>
                                        <?php elseif ($z['status_izin'] == 'Diterima') : ?>
                                            <a href="" class="badge badge-success"><?= $z['status_izin']; ?></a>
                                        <?php elseif ($z['status_izin'] == 'Kembali') : ?>
                                            <a href="" class="badge badge-light"><?= $z['status_izin']; ?></a>
                                        <?php elseif ($z['status_izin'] == 'Ditolak') : ?>
                                            <a href="" class="badge badge-danger"><?= $z['status_izin']; ?></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- <a href="/perizinan/persetujuan/<?= $z['id_izin']; ?>" class="btn btn-info">Pengajuan</a> -->
                                        <!-- <a href="" class="btn btn-danger">Hapus</a> -->
                                        <?php if (session()->get('role') == 1) : ?>
                                            <?php if ($z['status_izin'] == 'Menunggu') : ?>
                                                <a href="/perizinan/terima/<?= $z['id_santri']; ?>" class="btn btn-primary">Terima</a>
                                                <a href="/perizinan/ditolak/<?= $z['id_izin']; ?>" class="btn btn-danger">Tolak</a>
                                            <?php elseif ($z['status_izin'] == 'Diterima') : ?>
                                                <a href="/perizinan/kembali/<?= $z['id_izin']; ?>" class="btn btn-primary">Kembali</a>
                                            <?php elseif ($z['status_izin'] == 'Kembali') : ?>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $z['id_izin']; ?>">
                                                    Hapus
                                                </button>
                                            <?php elseif ($z['status_izin'] == 'Ditolak') : ?>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $z['id_izin']; ?>">
                                                    Hapus
                                                </button>
                                            <?php endif; ?>

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
                                                <!-- <a href="/perizinan/izin/<?= $z['id_izin']; ?>" class="btn btn-dark">Ditolak</a>
                                                <a href="/perizinan/izin/<?= $z['id_izin']; ?>" class="btn btn-primary">Diterima</a>
                                                <a href="/perizinan/izin/<?= $z['id_izin']; ?>" class="btn btn-info">Kembali</a> -->
                                            <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>