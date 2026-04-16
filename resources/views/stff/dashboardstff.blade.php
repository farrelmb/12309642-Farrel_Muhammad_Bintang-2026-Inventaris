@extends('layouts.templatestff')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Staff</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        .navbar {
            background: #007bff;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
        }

        .container {
            padding: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
        }

        .card {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0;
            font-size: 18px;
            color: #555;
        }

        .card p {
            font-size: 24px;
            margin-top: 10px;
        }

        .logout {
            background: red;
            border: none;
            padding: 8px 15px;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div>Dashboard Staff</div>
    </div>

    <!-- Content -->
    <div class="container">
        <h3>Selamat Datang</h3>
    </div>

</body>
</html>
@endsection