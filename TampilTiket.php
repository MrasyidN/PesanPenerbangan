<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Pemesanan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: normal;
            transition: font-weight 0.3s;
        }

        nav a:hover {
            text-decoration: underline;
            font-weight: bold;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: left;
            color: #333;
            overflow-x: auto;
        }

        .additional-info {
            margin-bottom: 20px;
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        th, td {
            border: 1px solid #3498db;
            padding: 12px;
            text-align: left;
            color: #333;
            position: relative;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        .cancel-button {
            background-color: #e74c3c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            top: 540px; /* Sesuaikan nilai top sesuai kebutuhan */
            right: 28%;
            transform: translateX(50%);
        }

        .cancel-button:hover {
            background-color: #c0392b;
        }

        .order-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .harga-tiket {
            font-family: 'Arial', sans-serif;
            text-align: left;
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
</head>
<body>

    <header>
        <h1>Tiket Pemesanan</h1>
    </header>

    <nav>
        <div>
            <a href="#"> Kembali keberanda</a>
        </div>
    </nav>
    
    <div class="container">
        <!-- Tambahkan judul pesanan -->
        <h2 class="order-title">Pesanan Saya</h2>
        
        <!-- Informasi Tambahan -->
        <div class="additional-info">
            <p><strong>Nama     :</strong> John Doe</p>
            <p><strong>Alamat:</strong> Jl. Sudirman No. 123</p>
            <p><strong>Usia:</strong> 25</p>
            <p><strong>Jenis Kelamin:</strong> Laki-laki</p>
            <p><strong>Nomor Kursi:</strong> Kursi 2A</p>
        </div>
        
        <!-- Tabel Tiket Pemesanan -->
        <table>
            <thead>
                <tr>
                    <th>Bandara Asal</th>
                    <th>Bandara Tujuan</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Maskapai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Jakarta</td>
                    <td>Balikpapan</td>
                    <td>2023-01-01 08:00</td>
                    <td>Garuda Indonesia</td>
                    <td>On Time</td>
                </tr>
                <!-- Tambahkan baris sesuai kebutuhan -->
            </tbody>
        </table>
        
        <!-- Harga Tiket -->
        <div class="harga-tiket">
            <p><strong>Harga Tiket:</strong> Rp 500,000</p>
        </div>

        <!-- Tombol Batalkan Pesanan -->
        <button class="cancel-button">Batalkan Pesanan</button>
    </div>

</body>
</html>
