<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Library Management</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->fullname }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
                <li class="nav-item">
                    <a href="{{ route('books.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                        Books
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('authors.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-pen"></i>
                        <p>
                        Authors
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shelves.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                        Shelves
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('genres.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-recycle"></i>
                        <p>
                        Genres
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
    </div>
</aside>
<!-- /.sidebar-menu -->