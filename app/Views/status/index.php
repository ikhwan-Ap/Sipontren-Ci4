<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/pembayaran/add" class="btn btn-primary">Tambah Data </a>
        </div>
        <div class="section-header-button">
            <a href="/status_cek" class="btn btn-primary">Cek Santri</a>
        </div>
    </div>
    <form action="<?= base_url(); ?>/status_pembayaran" method="POST" class="inline">
        <?= csrf_field(); ?>
        <div class="row">
            <div class="form-group">
                <div class="col">
                    <label for="tgl_mulai">Pilih Santri</label>
                    <select name="id_santri" id="id_santri" class="form-control">
                        <option value="" hidden></option>
                        <?php foreach ($santri as $s) :  ?>
                            <option value="<?= $s['id_santri']; ?>"><?= $s['nama_lengkap']; ?></option>
                        <?php endforeach;  ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col">
                    <label for="">Pilih</label>
                    <button type="submit" name="hasil" value="Hasil" class="form-control btn btn-info">Cek Data</button>
                </div>
            </div>
        </div>
    </form>
    <?= session()->getFlashdata('message'); ?>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembayaran</h4>
                    </div>
                    <div class=" card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Bulan Pembayaran</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($hasil as $p) :
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $p['tagihan']; ?></td>
                                            <td><?= $p['bulan']; ?></td>
                                            <td><?= $p['pembayaran']; ?></td>
                                            <td>
                                                <?php if ($p['status'] == 'Lunas') : ?>
                                                    <a href="" class="badge badge-success"><?= $p['status']; ?></a>
                                                <?php elseif ($p['status'] == 'Belum Lunas') : ?>
                                                    <a href="" class="badge badge-danger"><?= $p['status']; ?></a>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <?php if ($p['status'] == 'Lunas') {
                                                echo '';
                                            } elseif ($p['status'] == 'Belum Lunas') { ?>
                                                <!-- <a href="/spp/bayar/<?= $p['id_santri']; ?>" class="btn btn-primary">Bayar</a> -->
                                                <form action="/spp/bayar/<?= $p['id_santri']; ?>" method="GET">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id_santri" value="<?= $p['id_santri']; ?>">
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