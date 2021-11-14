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

            <li class="nav-item dropdown <?= ($title == "Admin") ? 'active' : ''; ?>">
                <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <?php if (session()->get('role') == 1) : ?>
                        <li class="<?= ($title == "Admin") ? 'active' : ''; ?>"><a class="nav-link" href="/admin">Admin</a></li>
                    <?php endif; ?>
                    <li><a class="nav-link" href="">Santri</a></li>
                    <li><a class="nav-link" href="">Level Diniyah</a></li>
                    <li><a class="nav-link" href="">Program</a></li>
                    <li><a class="nav-link" href="">Asatidz</a></li>
                    <li><a class="nav-link" href="">Kamar</a></li>
                    <li><a class="nav-link" href="">Gedung</a></li>
                    <li><a class="nav-link" href="">Alumni</a></li>
                </ul>
            </li>
        </ul>

    </aside>
</div>