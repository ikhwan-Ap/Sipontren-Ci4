<?= $this->extend('layout/template_asatidz'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/admin/add" class="btn btn-primary">Tambah</a>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Admin</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $a['id']; ?>">
                                        Hapus
                                    </button>
                                    <a href="/admin/edit/<?= $a['username']; ?>" class="btn btn-warning">Edit</a>
                                    <a href="/admin/detail/<?= $a['id']; ?>" class="btn btn-secondary">Detail</a>
                                </td>
                            </tr>

                            <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $a['id']; ?>">
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
                                            <form action="/admin/<?= $a['id']; ?>" method="POST">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger">Ya</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>