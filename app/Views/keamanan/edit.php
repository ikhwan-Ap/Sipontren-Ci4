<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/keamanan" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/keamanan">Keamanan</a></div>
            <div class="breadcrumb-item">Edit Keamanan</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-6">
        <form action="/keamanan/<?= $admin['id']; ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Form Ubah Data Keamanan</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= (old('name')) ? old('name') : $admin['name']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= (old('username')) ? old('username') : $admin['username']; ?>" readonly>
                    <div class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= (old('email')) ? old('email') : $admin['email']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Ubah Data</button>
                <a href="/keamanan" class="btn btn-light ml-2">Batal</a>
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