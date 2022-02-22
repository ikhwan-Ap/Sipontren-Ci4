<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Admin</h4>
                        </div>
                        <div class="card-body">
                            <?= $totalAdmin; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Santri</h4>
                        </div>
                        <div class="card-body">
                            <?= $totalSantri; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Asatidz</h4>
                        </div>
                        <div class="card-body">
                            <?= $totalAsatidz; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-light">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Program</h4>
                        </div>
                        <div class="card-body">
                            <?= $totalProgram; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Santri Aktif</h4>
                        </div>
                        <div class="card-body">
                            <?= $totalSantriAktif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-dark">
                        <i class="fas fa-user-alt-slash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Santri Non Aktif</h4>
                        </div>
                        <div class="card-body">
                            <?= $totalSantriNonAktif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
                        <i class="fas fa-user-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Santri Baru</h4>
                        </div>
                        <div class="card-body">
                            <?= $totalSantriBaru; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Alumni </h4>
                        </div>
                        <div class="card-body">
                            <?= $totalSantriAlumni; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-statistic-1">
            <div class="row">
                <div class="col-lg-6">
                    <canvas id="myChart" style="width:100%;max-width:600px">
                        <script>
                            var xValues = ["SPP", "Pendaftaran", "Daftar Ulang", "Rutin", "Lain"];
                            var yValues = [
                                <?php
                                foreach ($totalPembayaranSPP as $SPP) :  ?>
                                    <?= $SPP['jumlah_bayar']; ?>
                                <?php endforeach; ?>,

                                <?php
                                foreach ($totalPembayaranSPP as $pendaftaran) :  ?>
                                    <?= $pendaftaran['jumlah_bayar']; ?>
                                <?php endforeach; ?>,

                                <?php
                                foreach ($totalDaftar as $daftar) :  ?>
                                    <?= $daftar['jumlah_bayar']; ?>
                                <?php endforeach; ?>,

                                <?php
                                foreach ($totalRutin as $rutin) :  ?>
                                    <?= $rutin['jumlah_bayar']; ?>
                                <?php endforeach; ?>,

                                <?php
                                foreach ($lain as $rutin) :  ?>
                                    <?= $rutin['jumlah_bayar']; ?>
                                <?php endforeach; ?>,

                            ];


                            var barColors = [
                                "red", "#ADFF2F", "#00FFFF", "#FFD700", "#FF7F50"
                            ];

                            new Chart("myChart", {
                                type: "pie",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        backgroundColor: barColors,
                                        data: yValues
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Total Pemasukan"
                                    }
                                }
                            });
                        </script>
                    </canvas>
                </div>

                <div class="col-lg-6">
                    <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
                    <script>
                        var xValues = ["Kegiatan A", "Kegiatan B", "Kegiatan C", "Kegiatan D", "Kegiatan Lain"];
                        var yValues = [

                            <?php foreach ($kegiatanA as $A) :  ?>
                                <?= $A['jumlah_pengeluaran']; ?>
                            <?php endforeach; ?>,

                            <?php foreach ($kegiatanB as $B) :  ?>
                                <?= $B['jumlah_pengeluaran']; ?>
                            <?php endforeach; ?>,

                            <?php foreach ($kegiatanC as $C) :  ?>
                                <?= $C['jumlah_pengeluaran']; ?>
                            <?php endforeach; ?>,

                            <?php foreach ($kegiatanD as $D) :  ?>
                                <?= $D['jumlah_pengeluaran']; ?>
                            <?php endforeach; ?>,

                            <?php foreach ($kegiatanLain as $lain) :  ?>
                                <?= $lain['jumlah_pengeluaran']; ?>
                            <?php endforeach; ?>,
                            0
                        ];
                        var barColors = ["red", "#ADFF2F", "#00FFFF", "#FFD700", "#FF7F50"];

                        new Chart("myChart1", {
                            type: "bar",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues,
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: "Jumlah Pengeluaran Berdasarkan Kegiatan"
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>




</section>
<?= $this->endSection(); ?>