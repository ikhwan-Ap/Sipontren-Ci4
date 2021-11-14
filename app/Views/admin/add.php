<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/admin" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/admin">Admin</a></div>
            <div class="breadcrumb-item">Tambah Admin</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-6">
        <form action="/admin" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Tambah Data Admin</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password_conf')) ? 'is-invalid' : ''; ?>" id="password_conf" name="password_conf">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password_conf'); ?>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="show_password" onclick="myFunction()">
                        <label class="form-check-label" for="show_password">
                            Show Password
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Tambah Data</button>
                <a href="/admin" class="btn btn-light ml-2">Batal</a>
            </div>
        </form>
    </div>

</section>

<script>
    function myFunction() {
        var x = document.getElementById("password");
        var y = document.getElementById("password_conf");
        if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }
</script>
<?= $this->endSection(); ?>