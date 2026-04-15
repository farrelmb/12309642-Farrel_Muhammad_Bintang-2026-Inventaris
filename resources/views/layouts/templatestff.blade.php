<!DOCTYPE html>
<html>

<head>
    <title>Staff Dashboard</title>

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
            background: #0d6efd;
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

        .sidebar .active {
            font-weight: bold;
            background: rgba(255, 255, 255, 0.35);
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

        <div class="section-title">Menu</div>
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link {{ request()->is('staff') ? 'active' : '' }}" href="/staff">
                    Dashboard
                </a>
            </li>
            <hr>
            <div class="section-title">Items Data</div>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lendingstff.*') ? 'active' : '' }}"
                    href="{{ route('lendingstff.index') }}">
                    Lending
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('itemstff.*') ? 'active' : '' }}"
                    href="{{ route('itemstff.index') }}">
                    Items
                </a>
            </li>

            <hr>
            <div class="section-title">Accounts</div>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center 
                    {{ request()->is('profile/*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" href="#profileMenu">
                    Profile
                    <span>▼</span>
                </a>

                <div class="collapse {{ request()->is('profile/*') ? 'show' : '' }}" id="profileMenu">
                    <a href="/profile/edit" class="nav-link {{ request()->is('profile/edit') ? 'active' : '' }}">
                        Edit Profile
                    </a>
                </div>
            </li>

        </ul>

        <!-- LOGOUT -->
        <form method="POST" action="/logout" class="logout-btn mt-auto">
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
