<?php
    include "koneksi.php";
    if (isset($_POST['lihat'])){

    }
?>

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
            background-image: url('img/Gambar_Pesawat7.jpg');
            background-size: cover;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        header {
            background-color: white;
            color: black;
            padding: 10px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            margin-top: 60px;
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
        <h1>Tiket Penerbangan</h1>
    </header>
    
    <div class="container">
        <!-- Tambahkan judul pesanan -->
        <h2 class="order-title">Pesanan Saya</h2>
        <?php
            $select = mysqli_query($koneksi, "SELECT
            Tiket.no_tiket, pesawat.kode_pesawat,
            Customer.nama_customer, bandaraAsal.alamat AS 'KotaAsal',
            bandaraTujuan.alamat AS 'KotaTujuan', kursi.no_kursi,
            pembayaran.status AS status_pembayaran, maskapai.nama_maskapai
            FROM tiket
            JOIN pesawat ON tiket.id_pesawat = pesawat.id
            JOIN customer ON tiket.id_customer = customer.id
            JOIN jadwal ON tiket.id_jadwal=jadwal.id
            JOIN kursi ON tiket.id_kursi = kursi.id
            JOIN pembayaran ON tiket.id_pembayaran = pembayaran.id
            JOIN bandara AS bandaraAsal ON jadwal.id_bandara_asal = bandaraAsal.id
            JOIN bandara AS bandaraTujuan ON jadwal.id_bandara_tujuan = bandaraTujuan.id
            JOIN maskapai ON pesawat.id_maskapai = maskapai.id
            WHERE tiket.id = $_POST[id]");
            $data = mysqli_fetch_array($select)
        ?>
        <!-- Informasi Tambahan -->
        <div class="additional-info">
            <p><strong>No Tiket          :</strong> <?= $data['no_tiket']?></p>
            <p><strong>Nama Customer     :</strong> <?= $data['nama_customer'] ?></p>
            <p><strong>Status Pembayaran :</strong> <?= $data['status_pembayaran']?></p>
        </div>
        
        <!-- Tabel Tiket Pemesanan -->
        <table>
            <thead>
                <tr>
                    <th>Kode Pesawat</th>
                    <th>Maskapai</th>
                    <th>Kota Asal</th>
                    <th>Kota Tujuan</th>
                    <th>Nomor Kursi</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td><?= $data['kode_pesawat']?></td>
                    <td><?= $data['nama_maskapai']?></td>
                    <td><?= $data['KotaAsal']?></td>
                    <td><?= $data['KotaTujuan']?></td>
                    <td><?= $data['no_kursi']?></td>
                </tr>
                <!-- Tambahkan baris sesuai kebutuhan -->
            </tbody>
        </table>
        
        <!-- Harga Tiket -->

        <!-- Tombol Batalkan Pesanan -->
        <a href="PesananSaya.php"><button class="cancel-button" style="background-color: #3498db; margin: center;">Kembali ke Pesanan Saya</button></a>
    </div>

</body>
</html>
