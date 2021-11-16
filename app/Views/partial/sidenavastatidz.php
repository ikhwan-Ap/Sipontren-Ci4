<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SIPONTREN</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">SP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Astatidz</li>
            <li class="nav-item <?= ($title == "Dashboard") ? 'active' : ''; ?>">
                <a href="/dashboard/asatidz" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>

            <li class="nav-item dropdown <?= ($title == "Astatidz") ? 'active' : ''; ?>">
                <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="/asatidz/profil">Profil</a></li>
                    <li><a class="nav-link" href="">Kelas</a></li>
                </ul>
            </li>
        </ul>

    </aside>
</div>