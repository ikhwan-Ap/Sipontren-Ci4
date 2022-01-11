<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/pembayaran/lainnya_add" class="btn btn-primary">Tambah Data Pembayaran Rutin </a>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembayaran Lain</h4>
                    </div>
                    <div class="col">
                        <form action="<?= base_url(); ?>/lainnya" method="POST" class="inline">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col">
                                        <label for="id_tagihan">Pilih Pembayaran</label>
                                        <select name="id_tagihan" id="id_tagihan" class="form-control">
                                            <option value="" hidden></option>
                                            <option value="1">uang makan</option>
                                            <option value="2">uang laptop</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="bulan">Pilih Bulan</label>
                                        <input type="month" name="bulan" class="form-control" id="bulan">
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
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>nis</th>
                                            <th>nama santri</th>
                                            <th>Pembayaran</th>
                                            <th>Jumlah Pembayaran</th>
                                            <th>Jumlah Tagihan</th>
                                            <th>tggl bayar</th>
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
                                                <td><?= $k['nama_pembayaran']; ?></td>
                                                <td><?= $k['jumlah_bayar']; ?></td>
                                                <td><?= $k['jumlah_tagihan']; ?></td>
                                                <td> <?= $k['waktu']; ?></td>
                                                <?php if ($k['status'] == 'Lunas') {
                                                ?> <td class="badge badge-success"><?= $k['status']; ?></td>
                                                <?php  } else {
                                                ?> <td class="badge badge-danger"><?= $k['status'];
                                                                                } ?>


                                                    <td>
                                                        <?php if ($k['status'] == 'Lunas') {
                                                            echo '';
                                                        } else { ?>
                                                            <a href="/pembayaran/bayar_lainnya/<?= $k['id_keuangan']; ?>" class="btn btn-primary">Bayar</a>
                                                        <?php } ?>
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
    </div>
</section>
<?= $this->endSection(); ?>