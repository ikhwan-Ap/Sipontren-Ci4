<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/tagihan/tagihan_add" class="btn btn-primary">
                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                    Tambah
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
    <?php endif; ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pembayaran</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $hariIni = new DateTime();
                                    foreach ($tagihan as $k) :
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $k['nama_pembayaran']; ?></td>
                                            <td><?= $k['jumlah_pembayaran']; ?></td>
                                            <td>
                                                <?php if ($k['nama_pembayaran'] == 'uang daftar ulang' || $k['nama_pembayaran'] == 'uang pendaftaran') : ?>
                                                <?php elseif ($k['nama_pembayaran'] == 'uang laptop' || $k['nama_pembayaran'] == 'uang makan') : ?>
                                                <?php else :  ?>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $k['id_tagihan']; ?>">
                                                        <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                                    </button>
                                                <?php endif; ?>
                                                <?php if ($k['nama_pembayaran'] == 'uang daftar ulang') : ?>
                                                    <a href="/tagihan/edit_regis/<?= $k['nama_pembayaran']; ?>" class="btn btn-light">
                                                        <spanion class="ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                                                    </a>
                                                <?php elseif ($k['nama_pembayaran'] == 'uang pendaftaran') : ?>
                                                    <a href="/tagihan/edit_regis/<?= $k['nama_pembayaran']; ?>" class="btn btn-light">
                                                        <spanion class="ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                                                    </a>
                                                <?php else : ?>
                                                    <?php if ($k['jumlah_pembayaran'] == null) : ?>
                                                        <a href="/tagihan/edit/<?= $k['nama_pembayaran']; ?>" class="btn btn-light">
                                                            <spanion class="ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                                                        </a>
                                                    <?php elseif ($k['jumlah_pembayaran'] != null) : ?>
                                                        <a href="/tagihan/edit_rutin/<?= $k['nama_pembayaran']; ?>" class="btn btn-light">
                                                            <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $k['id_tagihan']; ?>">
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
                                                        <form action="/pembayaran/tagihan<?= $k['id_tagihan']; ?>" method="POST">
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
</section>
<?= $this->endSection(); ?>