<script src="https://unpkg.com/feather-icons"></script>
{{-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"> --}}
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse top-0">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                    href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

            @can('dosen')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/jadwalkinerja*') ? 'active' : '' }}"
                        href="/dashboard/jadwalkinerja">
                        <span data-feather="calendar"></span>
                        Jadwal/Kinerja
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/matkul*') ? 'active' : '' }}" href="/dashboard/matkul">
                    <span data-feather="file-text"></span>
                    Nilai
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/nilailain*') ? 'active' : '' }}" href="/dashboard/nilailain">
                    <span data-feather="file-text"></span>
                    Nilai Lain
                </a>
            </li>

            @can('mahasiswa')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/kritikdansaran*') ? 'active' : '' }}"
                        href="/dashboard/kritikdansaran">
                        <span data-feather="thumbs-up"></span><span data-feather="thumbs-down"></span>
                        Beri Kritik/Saran
                    </a>
                </li>
            @endcan
            @can('dosen')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/kritikdansaran*') ? 'active' : '' }}"
                        href="/dashboard/kritikdansaran">
                        <span data-feather="thumbs-up"></span><span data-feather="thumbs-down"></span>
                        Lihat Kritik/Saran
                    </a>
                </li>
            @endcan

            @can('admin')
                <h6 class="sideba-heading d-flex justify-content-between align-items-center p-3 mt-4 mb-1 text-muted">
                    <span>Admin</span>
                </h6>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/settingjadwal*') ? 'active' : '' }}"
                        href="/dashboard/settingjadwal">
                        <span data-feather="file-plus"></span>
                        Setting Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/settingmatakuliah*') ? 'active' : '' }}"
                        href="/dashboard/settingmatakuliah">
                        <span data-feather="file-plus"></span>
                        Setting Mata Kuliah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/settingosce*') ? 'active' : '' }}"
                        href="/dashboard/settingosce">
                        <span data-feather="file-plus"></span>
                        Setting OSCE
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/settingsoca*') ? 'active' : '' }}"
                        href="/dashboard/settingsoca">
                        <span data-feather="file-plus"></span>
                        Setting SOCA
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/settingfieldlab*') ? 'active' : '' }}"
                        href="/dashboard/settingfieldlab">
                        <span data-feather="file-plus"></span>
                        Setting Field Lab
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/laporannilai*') ? 'active' : '' }}"
                        href="/dashboard/laporannilai">
                        <span data-feather="file-plus"></span>
                        Laporan Nilai
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/laporanlain*') ? 'active' : '' }}"
                        href="/dashboard/laporanlain">
                        <span data-feather="file-plus"></span>
                        Laporan Nilai Lain
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/akseseditnilai*') ? 'active' : '' }}"
                        href="/dashboard/akseseditnilai">
                        <span data-feather="file-plus"></span>
                        Akses edit Nilai
                    </a>
                </li>
            @endcan

            @can('superadmin')
                <h6 class="sideba-heading d-flex justify-content-between align-items-center p-3 mt-4 mb-1 text-muted">
                    <span>Superadmin</span>
                </h6>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/superadmin/*') ? 'active' : '' }}"
                        href="/dashboard/superadmin/">
                        <span data-feather="users"></span>
                        Edit Role User
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <form action="/logout" method="post">
                    @csrf

                    <button type="submit" class="btn btn-link shadow-none nav-link"><span data-feather="log-out"></span>
                        Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
<script>
    feather.replace()
</script>
