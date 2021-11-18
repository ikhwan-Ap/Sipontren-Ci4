<?= $this->extend('layout/template_login') ?>

<?= $this->section('content_login'); ?>
<section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
            <div class="p-4 m-3">
                <img src="/img/logo-sipontren.jpeg" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                <h4 class="text-dark font-weight-normal"><span class="font-weight-bold">Login</span></h4>
                <p class="text-muted">Selamat datang diwebsite Pondok Pesantren Darussalam Dukuhwaluh Purwokerto.</p>
                <form method="POST" action="#" class="needs-validation" novalidate="">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input id="nis" type="text" class="form-control" name="nis" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            NIS harus diisi!
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                        <div class="invalid-feedback">
                            Password harus diisi!
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="showpass" class="custom-control-input" tabindex="3" id="showpass">
                            <label class="custom-control-label" for="showpass">Show Password</label>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success btn-lg btn-icon icon-right" tabindex="4">
                            Login
                        </button>
                    </div>

                </form>

                <div class="text-center mt-5 text-small">
                    Copyright &copy; <?= date('Y'); ?> | SIPONTREN`
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 position-relative overlay-gradient-bottom" data-background="/img/masjid.jpg">
            <div class="absolute-bottom-left index-2">
                <div class="text-light p-5 pb-2">
                    <div class="mb-5 pb-3">
                        <h1 class="mb-2 display-4 font-weight-bold">Selamat Datang</h1>
                        <h3 class="font-weight-normal text-muted-transparent">Pondok Pesantren Darussalam Dukuhwaluh Purwokerto</h3>
                    </div>
                    Dukuwaluh, Jawa Tengah, Indonesia. Photo by. @dimaschronicles
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>