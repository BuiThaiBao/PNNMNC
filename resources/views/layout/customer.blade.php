<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Shop Online')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            color: #1a1a2e;
            min-height: 100vh;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.5px;
        }

        .navbar-brand i {
            font-size: 1.3rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 10px;
            border-radius: 10px;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .navbar-links a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .navbar-links a:hover {
            color: #fff;
        }

        /* ===== MAIN ===== */
        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #1a1a2e;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
            font-size: 0.9rem;
        }

        .footer a {
            color: #667eea;
            text-decoration: none;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="navbar-brand">
            <i class="fas fa-store"></i>
            ShopOnline
        </a>
        <ul class="navbar-links">
            <li><a href="/"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li><a href="{{ route('customer.product') }}"><i class="fas fa-box-open"></i> Sản phẩm</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2026 ShopOnline. All rights reserved.</p>
    </footer>

    @stack('scripts')
</body>

</html>