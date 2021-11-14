<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="" class="btn btn-primary">Tambah</a>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="text-dark">Data Admin</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            <?php $i = 1;

                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>