<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SIPONTREN</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Super Admin</li>
            <li class="nav-item <?= ($title == "Dashboard") ? 'active' : ''; ?>">
                <a href="/dashboard" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>

            <li class="nav-item dropdown <?= ($title == "Admin" || $title == "Pendaftaran Santri Baru" || $title == "Data Asatidz" || $title == "Data Alumni"  || $title == "Data Santri"  || $title == "Data Diniyah" || $title == "Data Program" || $title == "Data Kamar" || $title == "Data Kelas" || $title == "Data Gedung") ? 'active' : ''; ?>">
                <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <?php if (session()->get('role') == 1) : ?>
                        <li class="<?= ($title == "Admin") ? 'active' : ''; ?>"><a class="nav-link" href="/admin">Admin</a></li>
                    <?php endif; ?>
                    <li class="<?= ($title == "Pendaftaran Santri Baru") ? 'active' : ''; ?>"><a class="nav-link" href="/pendaftaran">Pendaftaran Santri Baru</a></li>
                    <li class="<?= ($title == "Data Santri") ? 'active' : ''; ?>"><a class="nav-link" href="/santri">Santri</a></li>
                    <li class="<?= ($title == "Data Asatidz") ? 'active' : ''; ?>"><a class="nav-link" href="/asatidz">Asatidz</a></li>
                    <li class="<?= ($title == "Data Alumni") ? 'active' : ''; ?>"><a class="nav-link" href="/alumni">Alumni</a></li>
                    <li class="<?= ($title == "Data Diniyah") ? 'active' : ''; ?>"><a class="nav-link" href="/diniyah">Diniyah</a></li>
                    <li class="<?= ($title == "Data Program") ? 'active' : ''; ?>"><a class="nav-link" href="/program">Program</a></li>
                    <li class="<?= ($title == "Data Kelas") ? 'active' : ''; ?>"><a class="nav-link" href="/kelas">Kelas</a></li>
                    <li class="<?= ($title == "Data Kamar") ? 'active' : ''; ?>"><a class="nav-link" href="/kamar">Kamar</a></li>
                    <li class="<?= ($title == "Data Gedung") ? 'active' : ''; ?>"><a class="nav-link" href="/gedung">Gedung</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown <?= ($title == "Pembayaran SPP" ||  $title == "Pengeluaran Baru" ||  $title == "Tagihan Baru" ||  $title == "Tagihan Kelas"  || $title == "Pembayaran Pendaftaran" || $title == "Pembayaran Daftar Ulang" || $title == "Pembayaran Rutin" || $title == "Pembayaran Lain") ? 'active' : ''; ?>">
                <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-money-check"></i> <span>Keuangan</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= ($title == "Pembayaran SPP") ? 'active' : ''; ?>"><a class="nav-link" href="/status_pembayaran">Pembayaran SPP</a></li>
                    <li class="<?= ($title == "Pembayaran Pendaftaran") ? 'active' : ''; ?>"><a class="nav-link" href="/pendaftaran/pendaftaran">Pembayaran Pendaftaran</a></li>
                    <li class="<?= ($title == "Pembayaran Daftar Ulang") ? 'active' : ''; ?>"><a class="nav-link" href="/daftar_ulang">Pembayaran Daftar Ulang</a></li>
                    <li class="<?= ($title == "Pembayaran Rutin") ? 'active' : ''; ?>"><a class="nav-link" href="/lainnya">Pembayaran Rutin</a></li>
                    <li class="<?= ($title == "Pembayaran Lain") ? 'active' : ''; ?>"><a class="nav-link" href="/lain">Pembayaran Lain</a></li>
                    <?php if (session()->get('role') == 1) : ?>
                        <li class="<?= ($title == "Tagihan Baru") ? 'active' : ''; ?>"><a class="nav-link" href="/tagihan">Tagihan Baru</a></li>
                        <li class="<?= ($title == "Tagihan Kelas") ? 'active' : ''; ?>"><a class="nav-link" href="/tagihan_kelas">Tagihan Kelas</a></li>
                        <li class="<?= ($title == "Pengeluaran Baru") ? 'active' : ''; ?>"><a class="nav-link" href="/pengeluaran_baru">Pengeluaran Baru</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="nav-item dropdown <?= ($title == "Pemasukan" ||  $title == "Print Pengeluaran" || $title == "Pengeluaran" ||  $title == "Print Pemasukan" || $title == "Print Pengeluaran") ? 'active' : ''; ?>">
                <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-alt"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= ($title == "Pemasukan") ? 'active' : ''; ?>"><a class="nav-link" href="/pemasukan">Pemasukan</a></li>
                    <li class="<?= ($title == "Pengeluaran") ? 'active' : ''; ?>"><a class="nav-link" href="/pengeluaran">Pengeluaran</a></li>
                    <li class="<?= ($title == "Print Pemasukan") ? 'active' : ''; ?>"><a class="nav-link" href="/laporan/masuk">Print Pemasukan</a></li>
                    <li class="<?= ($title == "Print Pengeluaran") ? 'active' : ''; ?>"><a class="nav-link" href="/laporan/masuk">Print Pengeluaran</a></li>
                </ul>
            </li>

            <!-- <li class="nav-item <?= ($title == "Kurikulum") ? 'active' : ''; ?>">
                <a href="/kurikulum" class="nav-link"><i class="fas fa-book-open"></i><span>Kurikulum</span></a>
            </li> -->

            <li class="nav-item dropdown <?= ($title == "Perizinan" || $title == "Riwayat Perizinan") ? 'active' : ''; ?>">
                <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-envelope"></i> <span>Perizinan</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= ($title == "Perizinan") ? 'active' : ''; ?>"><a class="nav-link" href="/perizinan">Surat Izin Keluar</a></li>
                    <li class="<?= ($title == "Riwayat Perizinan") ? 'active' : ''; ?>"><a class="nav-link" href="/perizinan/riwayat">Riwayat</a></li>
                </ul>
            </li>

        </ul>

    </aside>
</div>