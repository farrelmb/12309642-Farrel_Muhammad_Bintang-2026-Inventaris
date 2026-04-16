<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-size: 14px;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            background: #144fa7;
            padding: 20px 15px;
            color: white;
        }

        .sidebar h4 {
            font-weight: 500;
        }

        .section-title {
            font-size: 12px;
            text-transform: uppercase;
            opacity: 0.7;
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .sidebar .nav-link {
            color: white;
            padding: 8px 10px;
            border-radius: 6px;
            margin-bottom: 5px;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* ACTIVE MENU */
        .sidebar .active {
            font-weight: bold;
            background: rgba(255, 255, 255, 0.35);
        }

        .sidebar .collapse .nav-link {
            font-size: 13px;
            padding-left: 20px;
        }

        /* CONTENT */
        .content {
            margin-left: 240px;
            padding: 25px;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .logout-btn {
            margin-top: auto;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar d-flex flex-column">

        <h4 class="mb-4">Inventaris</h4>

        <!-- MENU -->
        <div class="section-title">Menu</div>
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="/admin">
                    Dashboard
                </a>
            </li>
            <hr>

            <div class="section-title">Items Data</div>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}"
                    href="{{ route('categories.index') }}">
                    Categories
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('items') ? 'active' : '' }}" href="{{ route('items.index') }}">
                    Items
                </a>
            </li>

            <hr>
        </ul>

        <!-- ACCOUNT -->
        <div class="section-title">Accounts</div>
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center 
                {{ request()->is('users/*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" href="#userMenu">
                    User
                    <span>▼</span>
                </a>

                <div class="collapse {{ request()->is('users/*') ? 'show' : '' }}" id="userMenu">
                    <a href="{{ url('/users/admin') }}"
                        class="nav-link {{ request()->is('users/admin') ? 'active' : '' }}">
                        Admin
                    </a>

                    <a href="{{ url('/users/operator') }}"
                        class="nav-link {{ request()->is('users/operator') ? 'active' : '' }}">
                        Operator
                    </a>
                </div>
            </li>

        </ul>

        <!-- LOGOUT -->
        <form method="POST" action="/logout" class="logout-btn">
            @csrf
            <button class="btn btn-danger w-100">Logout</button>
        </form>

    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
