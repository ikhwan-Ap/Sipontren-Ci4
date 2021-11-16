<?= $this->extend('layout/template_asatidz'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Program</h4>
                        </div>
                        <div class="card-body">

                            <?= $totalSantri; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Santri</h4>
                        </div>
                        <div class="card-body">
                            42
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pertemuan</h4>
                        </div>
                        <?php foreach ($asatidz as $a) :  ?>
                            <div class="card-body">
                                <?= $a['pertemuan']; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>Program</th>
                                <th>Total</th>
                                <th>Jadwal</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($asatidz as $a) :
                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td class="font-weight-600"><?= $a['program']; ?></td>
                                    <td> <?= $a['total_santri']; ?> </td>
                                    <td><?= $a['jadwal']; ?></td>
                                    <td><?= $a['kelas']; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>