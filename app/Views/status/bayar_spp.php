<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/status_pembayaran" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/status_pembayaran">Pembayaran</a></div>
            <div class="breadcrumb-item">Pembayaran</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="<?php base_url() ?>/status_pembayaran/bayar_spp/<?= $santri['id_santri'] ?>" method="POST" enctype="multipart/form-data">
            <div class="card-header">
                <h4 class="text-dark">Pembayaran SPP</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id_santri" value="<?= $santri['id_santri'] ?>" id="id_santri">
                <input type="hidden" name="id_kelas" value="<?= $santri['id_kelas'] ?>" id="id_kelas">
                <input type="hidden" name="id_tagihan" value="<?= $tagih['id_tagihan'] ?>" id="id_tagihan">
                <div class="row">
                    <div class="form-group col-md">
                        <input id="jumlah_bayar" type="hidden" class="form-control <?= ($validation->hasError('jumlah_bayar')) ? 'is-invalid' : ''; ?>" name="jumlah_bayar" value="<?= $tagihan['jumlah_pembayaran']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah_bayar'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label for="waktu">Tanggal Bayar</label>
                        <input id="waktu" type="date" class="form-control <?= ($validation->hasError('waktu')) ? 'is-invalid' : ''; ?>" name="waktu" value="<?= old('waktu'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('waktu'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="ket_bayar">Keterangan Bayar</label>
                        <select id="ket_bayar" class="form-control <?= ($validation->hasError('ket_bayar')) ? 'is-invalid' : ''; ?>" name="ket_bayar">
                            <option value="" hidden></option>
                            <option value="transfer<?= (old('ket_bayar') == 'transfer') ? 'selected' : ''; ?>">Transfer</option>
                            <option value="langsung<?= (old('ket_bayar') == 'langsung') ? 'selected' : ''; ?>">Pembayaran Langsung</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('ket_bayar'); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Bayar</button>
                    <a href="/status_pembayaran" class="btn btn-light ml-2">Batal</a>
                </div>
        </form>
    </div>


</section>
<!-- <div class="row" id="ket_transfer">
                    <div class="form-group col-6">
                        <label for="bukti transfer">Upload Bukti Transfer</label>
                        <input type="file" class="form-control-file <?= ($validation->hasError('bukti')) ? 'is-invalid' : ''; ?>" id="bukti" name="bukti">
                    </div>
                    <div class="invalid-feedback">
                     
                    </div>
                </div>
                <div class="row" id="ket_langsung">
                    <div class="form-group col-6">
                        <label for="bukti transfer">Upload Bukti Pembayaran Langsung</label>
                        <input type="file" class="form-control-file <?= ($validation->hasError('bukti')) ? 'is-invalid' : ''; ?>" id="bukti" name="bukti">
                    </div>
                    <div class="invalid-feedback">
                     
                    </div>
                </div> -->

<?= $this->endSection(); ?>