<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>
    <div class="col">
        <div class="row">
            <form action="<?= base_url(); ?>/status_pembayaran" method="POST" class="inline">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="form-group">
                        <div class="col">
                            <label for="nama_lengkap">Nama Santri</label>
                            <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>">
                        </div>
                    </div>
                    <input id="id_santri" type="hidden" name="id_santri">
                    <div class="form-group">
                        <div class="col">
                            <label for="tahun">Pilih Bulan</label>
                            <input type="month" name="tahun" class="form-control" id="tahun">
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
            <form action="<?= base_url(); ?>/status_pembayaran/filter" method="POST" class="inline">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="form-group">
                        <div class="col">
                            <label for="tgl_akhir">Pilih Kelas</label>
                            <select name="id_kelas" id="id_kelas" class="form-control">
                                <option value="" hidden></option>
                                <?php foreach ($filter as $s) :  ?>
                                    <option value="<?= $s['id_kelas']; ?>"><?= $s['nama_kelas']; ?></option>
                                <?php endforeach;  ?>
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
                            <button type="submit" name="filter" value="Filter" class="form-control btn btn-info">Filter Kelas</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                                        <th>Tagihan</th>
                                        <th>Kelas</th>
                                        <th>Nama Santri</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Pembayaran</th>
                                        <th>Periode Pembayaran</th>
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
                                            <td><?= $p['nama_kelas']; ?></td>
                                            <td><?= $p['nama_lengkap']; ?></td>
                                            <td><?= $p['bulan']; ?></td>
                                            <td><?= $p['pembayaran']; ?></td>
                                            <td><?= $p['periode']; ?></td>
                                            <td>
                                                <?php if ($p['status'] == 'Lunas') : ?>
                                                    <a href="" class="badge badge-success"><?= $p['status']; ?></a>
                                                <?php elseif ($p['status'] == 'Belum Lunas') : ?>
                                                    <a href="" class="badge badge-danger"><?= $p['status']; ?></a>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <?php if ($p['pembayaran'] != null) {
                                                if ($p['status'] == 'Lunas') {
                                                    echo '';
                                                } elseif ($p['status'] == 'Belum Lunas') { ?>
                                                    <form action="/spp/bayar_kekurangan/<?= $p['id_keuangan']; ?>" method="GET">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id_keuangan" value="<?= $p['id_keuangan']; ?>">
                                                        <button type="submit" class="btn btn-primary">Bayar Kekurangan</button>
                                                    </form>
                                                <?php }
                                                ?>
                                            <?php
                                            } else { ?>
                                                <form action="/spp/bayar/<?= $p['id_santri']; ?>" method="GET">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id_santri" value="<?= $p['id_santri']; ?>">
                                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                                </form>
                                            <?php  } ?>
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
<script>
    $(document).ready(function() {
        $('#nama_lengkap').autocomplete({
            source: "<?php echo site_url('status_pembayaran/get_autofill/?')  ?>",
            select: function(event, ui) {
                $('[name="nama_lengkap"]').val(ui.item.label);
                $('[name="nis"]').val(ui.item.nis);
                $('[name="id_santri"]').val(ui.item.id_santri);

            }
        })
    });
</script>
<?= $this->endSection(); ?>