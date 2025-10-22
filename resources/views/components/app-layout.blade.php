@props(["header" => null])
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'INUA_POINT') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">{{ config('app.name') }}</div>
            <div class="list-group list-group-flush">
                <a href="{{ url('/dashboard') }}" class="list-group-item list-group-item-action list-group-item-light p-3">Dashboard</a>
                <a href="{{ route('loans.index') }}" class="list-group-item list-group-item-action list-group-item-light p-3">Loans</a>
                <a href="{{ route('payments.index') }}" class="list-group-item list-group-item-action list-group-item-light p-3">Payments</a>
                <a href="{{ route('verifications.index') }}" class="list-group-item list-group-item-action list-group-item-light p-3">Verifications</a>
                <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action list-group-item-light p-3">Roles</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page content wrapper--> 
        <div id="page-content-wrapper" class="w-100">
            <!-- Top navigation--> 
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown">{{ auth()->user()->name }}</a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button class="dropdown-item" type="submit">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page content-->
            <div class="container-fluid p-4">
                @if(isset($header))
                    <div class="mb-4">
                        {{ $header }}
                    </div>
                @endif

                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                @if (session('error'))
                    <x-alert type="danger" :message="session('error')" />
                @endif

                {{ $slot }}
            </div>
        </div>
    </div>

<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function () {
        document.getElementById('wrapper').classList.toggle('toggled');
    });
</script>
</body>
</html>