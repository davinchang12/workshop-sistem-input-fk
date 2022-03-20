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
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
                    <span data-feather="file-text"></span>
                    My Posts
                </a>
            </li>
            
            <div class="nav-item text-nowrap">
                <li class="nav-item">
                    <form action="/logout" method="post">
                        @csrf
        
                        <button type="submit" class="nav-link">Logout <span
                                data-feather="log-out"></span></button>
                    </form>
                </li>
            </div>
            
        </ul>
    </div>
</nav>
