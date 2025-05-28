<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Endless Edits</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <style>
        /* Basic styles for side menu and overlay */
        .side-menu {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: #fdfdfc;
            box-shadow: 2px 0 5px rgba(0,0,0,0.3);
            transition: left 0.3s ease;
            z-index: 1000;
            padding: 1rem;
        }
        .side-menu.open {
            left: 0;
        }
        .side-menu a {
            display: block;
            margin: 0.5rem 0;
            color: #1b1b18;
            text-decoration: none;
            font-weight: 500;
        }
        .side-menu a:hover {
            text-decoration: underline;
        }
        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
            z-index: 900;
        }
        .menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .menu-icon {
            font-size: 1.5rem;
            cursor: pointer;
            user-select: none;
            padding: 0.5rem;
            border: 1px solid #1b1b18;
            border-radius: 4px;
            display: inline-block;
            margin-right: 1rem;
        }
        header {
            display: flex;
            align-items: center;
            padding: 1rem;
            background-color: #fdfdfc;
            border-bottom: 1px solid #ddd;
            position: sticky;
            top: 0;
            z-index: 1100;
        }
        header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: #1b1b18;
        }
        .create-button {
            margin-left: auto;
            padding: 0.5rem 1rem;
            background-color: #f53003;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }
        .create-button:hover {
            background-color: #d42a02;
        }
    </style>
</head>
<body>
    <header>
        <div class="menu-icon" id="menuIcon" tabindex="0" role="button" aria-label="Toggle menu">&#9776;</div>
        <h1>The Endless Edits</h1>
        <a href="{{ route('posts.create') }}" class="create-button">Create</a>
    </header>

    <nav class="side-menu" id="sideMenu" aria-label="Side menu">
        @guest
            <a href="{{ route('login') }}">Sign In</a>
            <a href="{{ route('register') }}">Sign Up</a>
            <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">Follow us on Twitter</a>
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">Follow us on Instagram</a>
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer">Follow us on Facebook</a>
        @else
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('posts.index') }}">My Posts</a>
            <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">Follow us on Twitter</a>
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">Follow us on Instagram</a>
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer">Follow us on Facebook</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        @endguest
    </nav>
    <div class="menu-overlay" id="menuOverlay"></div>

    <div class="container">
        @yield('content')
    </div>

    <script>
        const menuIcon = document.getElementById('menuIcon');
        const sideMenu = document.getElementById('sideMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        function toggleMenu() {
            sideMenu.classList.toggle('open');
            menuOverlay.classList.toggle('active');
        }

        menuIcon.addEventListener('click', toggleMenu);
        menuOverlay.addEventListener('click', toggleMenu);

        // Accessibility: toggle menu with keyboard (Enter or Space)
        menuIcon.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMenu();
            }
        });
    </script>
</body>
</html>
