<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/keamanan/add" class="btn btn-primary">
                <span class="ion ion-android-add-circle" data-pack="android" data-tags="plus, include, invite">
                    Tambah
                </span>
            </a>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Keamanan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
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
                            foreach ($admin as $a) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $a['name']; ?></td>
                                    <td><?= $a['username']; ?></td>
                                    <td><?= $a['email']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $a['id']; ?>">
                                            <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                                        </button>
                                        <a href="/keamanan/edit/<?= $a['username']; ?>" class="btn btn-light">
                                            <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                                        </a>
                                        <a href="/keamanan/detail/<?= $a['id']; ?>" class="btn btn-light" target="_blank">
                                            <span class="ion ion-android-open" data-pack="android" data-tags="">
                                        </a>
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
                                                <form action="/keamanan/<?= $a['id']; ?>" method="POST">
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
</section>
<?= $this->endSection(); ?>