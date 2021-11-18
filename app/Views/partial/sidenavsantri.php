<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <div class="coliner">
                <div class="col-sm-7">
                    <img src="/img/logo-sipontren.jpeg" class="img-thumbnail img-preview">
                </div>
            </div>
        </div>
        <div class=" sidebar-brand sidebar-brand-sm">
            <img src="/img/logo-sipontren.jpeg" class="img-thumbnail img-preview">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Santri</li>
            <li class="nav-item <?= ($title == "Dashboard") ? 'active' : ''; ?>">
                <a href="/dashboard/asatidz" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item ">
                <a href="/asatidz/profil" class="nav-link"><i class="fas fa-user"></i><span>Profil</span></a>
            </li>
            <li class="nav-item ">
                <a href="/asatidz/kelas" class="nav-link"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a>
            </li>
            <li class="nav-item ">
                <a href="/asatidz/kelas" class="nav-link"><i class="fas fa-credit-card  "></i><span>Pembayaran</span></a>
            </li>
            <li class="nav-item ">
                <a href="/asatidz/kelas" class="nav-link"><i class="fas fa-clipboard"></i><span>Biodata</span></a>
            </li>
        </ul>

    </aside>
</div>