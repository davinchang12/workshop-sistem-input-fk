<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                    href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

            {{-- Mahasiswa --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/nilai*') ? 'active' : '' }}" href="/dashboard/nilai">
                    <span data-feather="file-text"></span>
                    Lihat Nilai
                </a>
            </li>
            
            {{-- Mahasiswa --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/kritiksaran*') ? 'active' : '' }}" href="/dashboard/kritiksaran">
                    <span data-feather="file-text"></span>
                    Kritik dan Saran
                </a>
            </li>

            @can('dosen')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/nilai*') ? 'active' : '' }}" href="/dashboard/nilai">
                    <span data-feather="file-text"></span>
                    Nilai
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/feedback*') ? 'active' : '' }}" href="/dashboard/feedback">
                    <span data-feather="file-text"></span>
                    Feedback
                </a>
            </li>
            @endcan

            @can('admin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/feedback*') ? 'active' : '' }}" href="/dashboard/akses">
                    <span data-feather="file-text"></span>
                    Beri Akses ke Dosen
                </a>
            </li>
            @endcan
            
            @can('superadmin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/feedback*') ? 'active' : '' }}" href="/dashboard/role">
                    <span data-feather="file-text"></span>
                    Set Role User
                </a>
            </li>
            @endcan

            <li class="nav-item">
                <form action="/logout" method="post">
                    @csrf
    
                    <button type="submit" class="btn btn-link shadow-none nav-link">Logout <span
                            data-feather="log-out"></span></button>
                </form>
            </li>    
        </ul>
    </div>
</nav>
