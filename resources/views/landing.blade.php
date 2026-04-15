<!DOCTYPE html>
<html>
<head>
    <title>Inventaris App</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 15px 30px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .logo {
            font-weight: bold;
        }

        .btn {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .btn:hover {
            background: #0056b3;
        }

        .hero {
            text-align: center;
            padding: 80px 20px;
        }

        .hero h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .hero p {
            color: #666;
            margin-bottom: 30px;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 40px;
        }

        .card {
            background: white;
            padding: 20px;
            width: 250px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: white;
            margin-top: 40px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">Inventaris App</div>
        <a href="/login" class="btn">Login</a>
    </div>

    <!-- Hero -->
    <div class="hero">
        <h1>Sistem Inventaris</h1>
        <p>Kelola barang, stok, dan data inventaris dengan mudah</p>
        <a href="/login" class="btn">Mulai Sekarang</a>
    </div>

    <!-- Features -->
    <div class="features">
        <div class="card">
            <h3>Manajemen Barang</h3>
            <p>Tambah, edit, dan hapus data barang dengan mudah</p>
        </div>

        <div class="card">
            <h3>Tracking Stok</h3>
            <p>Pantau jumlah stok barang secara real-time</p>
        </div>

        <div class="card">
            <h3>Laporan</h3>
            <p>Lihat laporan inventaris dengan cepat dan jelas</p>
        </div>
    </div>
</body>
</html>