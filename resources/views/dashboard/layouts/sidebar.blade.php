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
                <a class="nav-link {{ Request::is('dashboard/kritiksaran*') ? 'active' : '' }}" href="/dashboard/nilai">
                    <span data-feather="file-text"></span>
                    Kritik dan Saran
                </a>
            </li>

            {{-- Dosen  --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/nilai*') ? 'active' : '' }}" href="/dashboard/nilai">
                    <span data-feather="file-text"></span>
                    Nilai
                </a>
            </li>

            {{-- Dosen --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/feedback*') ? 'active' : '' }}" href="/dashboard/nilai">
                    <span data-feather="file-text"></span>
                    Feedback
                </a>
            </li>

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
