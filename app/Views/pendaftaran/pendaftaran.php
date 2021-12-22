<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/pembayaran/pendaftaran_add" class="btn btn-primary">Tambah Data Pendaftaran</a>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pembayaran Pendaftaran</h4>
                    </div>

                    <form action="<?= base_url(); ?>/pembayaran/filter_pendaftaran" method="POST" class="inline">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col">
                                    <label for="tgl_mulai">Tanggal Awal</label>
                                    <input type="date" name="tgl_mulai" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="tgl_akhir">Tanggal Akhir</label>
                                    <input type="date" name="tgl_selesai" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="tgl_akhir">Pilih Status</label>
                                    <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                                        <option value="" hidden></option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="">Pilih</label>
                                    <button type="submit" name="filter" value="Filter" class="form-control btn btn-info">Filter Data</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>nis</th>
                                        <th>nama santri</th>
                                        <th>Kelas</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $hariIni = new DateTime();
                                    foreach ($hasil as $k) :
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $k['nis']; ?></td>
                                            <td><?= $k['nama_lengkap']; ?></td>
                                            <td><?= $k['nama_kelas']; ?></td>
                                            <td><?= $k['tagihan']; ?></td>
                                            <td><?= $k['status']; ?></td>
                                            <td>
                                                <?php if ($k['status'] == 'Lunas') {
                                                    echo '';
                                                } elseif ($k['status'] == 'Belum Lunas') { ?>
                                                    <!-- <a href="/spp/bayar/<?= $k['id_santri']; ?>" class="btn btn-primary">Bayar</a> -->
                                                    <form action="/spp/bayar/<?= $k['id_santri']; ?>" method="GET">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id_santri" value="<?= $k['id_santri']; ?>">
                                                        <button type="submit" class="btn btn-primary">Bayar</button>
                                                    </form>
                                                <?php } else {
                                                    echo '';
                                                } ?>
                                            </td>
                                        </tr>

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