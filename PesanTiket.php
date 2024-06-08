<?php
    session_start();

    include ("koneksi.php");

    if (!isset($_SESSION['id'])) {
        header("location: Home.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
               body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("IMG/Gambar_Pesawat2.jpg") ;
            background-size: cover;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }


         nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: white;
            color: black;
            padding: 20px;
            text-align: left;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: Arial, sans-serif;
            z-index: 1000; /* Z-index untuk menempatkan navbar di atas konten lain */
        }


nav.scrolled {
    background-color: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

        nav a {
            color: black;
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
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: left;
    color: #333;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    overflow-y: auto; /* Menambahkan properti overflow-y untuk scroll vertikal */
}

        .flight-card {
            width: 300px;
            margin: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s;
            position: relative;
        }

        .flight-card:hover {
            transform: scale(1.05);
        }

        .flight-card .plane-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #3498db;
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
        }

        th {
            background-color: #3498db;
            color: white;
        }

       
        body {
    margin: 0;
    padding: 0;
}

footer {
    background-color: #00558e;
    color: white;
    text-align: center;
    padding: 1em;
    bottom: 0;
    width: 100%;
}

        h2 {
            font-family: 'Montserrat', sans-serif;
        }

        .profile-icon {
            font-size: 24px;
            cursor: pointer;
        }

        .auth-links {
            display: flex;
            align-items: center;
        }

        .auth-links a {
            margin-right: 15px;
        }

        .auth-links a:last-child {
            margin-right: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        

        .container {
            max-width: 800px;
            margin: 20px auto;
            margin-top: 100px;
            margin-bottom: 100px;
            margin-right: 50px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: left;
            color: #333;
            display: flex;
            flex-direction: column;
        }

        form {
            display: grid;
            gap: 16px;
        }

        

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: calc(100% - 16px);
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        select {
            margin-bottom: 16px;
        }

        .input-group {
            display: flex;
            gap: 16px;
            align-items: baseline;
        }

        .input-group label {
            flex: 1;
        }

        .input-group input,
        .input-group select {
            flex: 2;
        }

        .info-table {
            display: table;
            width: 100%;
            margin-bottom: 16px;
        }

        .info-row {
            display: table-row;
        }

        .info-cell {
            display: table-cell;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
</head>
<body>

   
    <nav>
        <div>
            <a href="HomeSetelahLogin.php">Jadwal Penerbangan</a>
            <a href="PesanTiket.php">Pesan Tiket</a>
            <a href="PesananSaya.php">Pesanan Saya</a>
        </div>
        <div class="auth-links">
            <?php
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id = $id");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_username = $result['username'];
                    $res_email = $result['email'];
                    $res_id = $result['id'];
                    $res_password = $result['password'];
                }

                echo "<a href='Profile.php?id=$res_id'>Hallo $res_username</a> ";
            }else{
                header("location: Home.php");
            }
            ?>
            <i class="fas fa-user-circle"></i>
            
            <a href="Logout.php">Log Out</a>
        </div>
    </nav>

    <div class="container">
        <!-- Formulir Pemesanan Tiket -->
        <form method="POST" action="PilihKursi.php" class= "mb-3">

           <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>

            <div class="mb-3">
                <label for="usia" class="form-label">Usia:</label>
                <input type="text" class="form-control" id="usia" name="usia" required>
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="laki-laki">Laki - Laki</option>
                <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label">NIK:</label>
                <input type="text" class="form-control" id="nik" name="nik" required>
            </div>

            <div class="mb-3">
                <label for="noPonsel" class="form-label">No. Ponsel:</label>
                <input type="text" class="form-control" id="noPonsel" name="noPonsel" required>
            </div>
            

            <div class="mb-3">
                <label for="pilihJadwal">Pilih Jadwal:</label>
                <select id="pilihJadwal" name="pilihJadwal" required>
                    <?php
                        $result = mysqli_query($koneksi, 'SELECT jadwal.id, jadwal.waktu_penerbangan, jadwal.status, pesawat.kode_pesawat, maskapai.nama_maskapai, bandara_asal.nama_bandara as nama_bandara_asal, bandara_tujuan.nama_bandara as nama_bandara_tujuan, harga FROM jadwal JOIN pesawat ON jadwal.id_pesawat = pesawat.id JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id where status = "tersedia"');
                        while ($data = mysqli_fetch_assoc($result)) :
                    ?>
                    <option value='<?= $data['id']?>'><?= $data['waktu_penerbangan']?> &ensp; &ensp; <?= $data['nama_bandara_asal']?> - <?= $data['nama_bandara_tujuan']?> &ensp; &ensp; Rp.<?= $data['harga']?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- <div class="input-group">
                <label for="pilihKursi">Pilih Kursi:</label>
                <select id="pilihKursi" name="pilihKursi" required>
                    <option value="1">Kursi 1</option>
                    <option value="2">Kursi 2</option>
                    <option value="3">Kursi 3</option>
                </select>
            </div> -->

            <!-- <label for="hargaTiket">Metode Pembayaran</label>
            <input type="text" id="hargaTiket" name="bayar" > -->

            <button type="submit" name="kursi">Lanjut Tahap Berikutnya</button>
        </form>
    </div>

    <footer>
    &copy; UPI.Com Layanan Penerbangan
</footer>


</body>
</html>
