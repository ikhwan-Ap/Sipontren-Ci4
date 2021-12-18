<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <div class="section-header-button">
            <a href="/pengeluaran_add" class="btn btn-primary">Tambah Pengeluaran Baru</a>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pengeluaran</h4>
                    </div>
                    <form action="<?= base_url(); ?>/pembayaran/filter_pengeluaran" method="POST" class="inline">
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
                                    <label for="tgl_akhir">Pilih Jenis Pengeluaran</label>
                                    <select name="nama_pengeluaran" id="nama_pengeluaran" class="form-control">
                                        <?php foreach ($keluar as $p) : ?>
                                            <option value="" hidden></option>
                                            <option value="<?= $p['nama_pengeluaran']; ?>"><?= $p['nama_pengeluaran']; ?></option>
                                        <?php endforeach;  ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="">Pilih</label>
                                    <button type="submit" name="filter" value="Filter" class="form-control btn btn-info">Filter Data</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-danger">
                                    </div>
                                    <div class="card-header-primary">
                                        <h3>Total Pengeluaran
                                            <?php foreach ($pengeluaran as $p) :  ?>
                                                <?= $p['jumlah_pengeluaran']; ?>
                                        </h3>
                                    </div>
                                <?php endforeach;  ?>
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
                                        <th>Nama Pengeluaran</th>
                                        <th>Jumlah Pengeluaran</th>
                                        <th>Bulan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($data as $k) :

                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $k['nama_pengeluaran']; ?></td>
                                            <td><?= $k['jumlah_pengeluaran']; ?></td>
                                            <td><?= date('d-M-Y', strtotime($k["waktu_pengeluaran"]));; ?></td>

                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $k['id_pengeluaran']; ?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" id="exampleModal<?= $k['id_pengeluaran']; ?>">
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
                                                        <form action="/pengeluaran/<?= $k['id_pengeluaran']; ?>" method="POST">
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