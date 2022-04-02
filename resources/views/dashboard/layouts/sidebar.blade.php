
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

            @can('admin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/rancangjadwalkinerja*') ? 'active' : '' }}" href="/dashboard/rancangjadwalkinerja">
                    <span data-feather="file-plus"></span>
                    Rancang Jadwal/Kinerja
                </a>
            </li>
            @endcan 

            @can('dosen')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/jadwalkinerja*') ? 'active' : '' }}" href="/dashboard/jadwalkinerja">
                    <span data-feather="calendar"></span>
                    Jadwal/Kinerja
                </a>
            </li>
            @endcan 
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/nilai*') ? 'active' : '' }}" href="/dashboard/nilai">
                    <span data-feather="file-text"></span>
                    Nilai
                </a>
            </li>

            @can('mahasiswa')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/kritikdansaran*') ? 'active' : '' }}" href="/dashboard/kritikdansaran">
                    <span data-feather="thumbs-up"></span><span data-feather="thumbs-down"></span>
                    Beri Kritik/Saran
                </a>
            </li>
            @endcan     

            @can('superadmin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/superadmin/*') ? 'active' : '' }}" href="/dashboard/superadmin/">
                    <span data-feather="users"></span>
                    Edit Role User
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
<script>
    feather.replace()
  </script>