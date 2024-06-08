<?php
    session_start();

    include ("koneksi.php");

    if (!isset($_SESSION['id'])) {
        header("location: Home.php");
        exit();
    }

    // Inisialisasi variabel pencarian
    $cari = isset($_GET['cari']) ? $_GET['cari'] : '';

    // Inisialisasi variabel filter
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

    // Query SQL dengan kondisi pencarian dan filter
    $query = "SELECT jadwal.id, jadwal.waktu_penerbangan, jadwal.status, pesawat.kode_pesawat, 
        maskapai.nama_maskapai, bandara_asal.nama_bandara as nama_bandara_asal, 
        bandara_tujuan.nama_bandara as nama_bandara_tujuan 
        FROM jadwal 
        JOIN pesawat ON jadwal.id_pesawat = pesawat.id 
        JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id 
        JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id 
        JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id
        ";

    if (!empty($cari)) :
        $query .= " WHERE jadwal.waktu_penerbangan LIKE '%$cari%' OR 
        pesawat.kode_pesawat LIKE '%$cari%' OR 
        maskapai.nama_maskapai LIKE '%$cari%' OR 
        bandara_asal.nama_bandara LIKE '%$cari%' OR 
        bandara_tujuan.nama_bandara LIKE '%$cari%'
        ";
    endif;

    // Tambahkan kondisi filter jika nilai $filter tidak kosong
    if (!empty($filter)) :
        $query .= " AND jadwal.status = '$filter'";
    endif;

    $result_jadwal = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Penerbangan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       body {
    font-family: 'Poppins', sans-serif;
    background-image: url('img/Gambar_Pesawat5.jpg');
    background-size :cover;
    margin-bottom: 70px;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-top: 70px; /* Margin atas setara dengan tinggi navbar */
}


       

        h1 {
            font-family: 'Expletus Sans'; 
        }

        h2 {
            font-family: 'sans-serif'; 
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

        header {
    margin: 30px;
    color: white;
    font-size: 40px;
    margin-top: 100px;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

        .container {
    max-width: 1100px;
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
    margin-bottom: 100px; /* Sesuaikan dengan tinggi footer */
}

         .filter-container {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 800px;
        margin: 10px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s;
    }

    .filter-container:hover {
        background-color: #3498db;
    }

    .filter-container label,
    .filter-container select {
        margin-right: 10px;
    }

    .filter-container select {
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #00558e;
        transition: border-color 0.s;
    }

    .filter-container select:hover,
    .filter-container select:focus {
        border-color: #3498db;
    }


        .flight-card {
            width: 300px;
            margin: 5px;
            padding: 2px;
            border: 3px solid #ddd;
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
            padding: 10px;
            text-align: left;
            color: #333;
        }

        th {
            background-color: #3498db;
            color: white;
        }

       


        h2 {
            font-family: 'Montserrat', sans-serif;
        }

        .profile-icon {
            font-size: 24px;
            cursor: pointer;
            color: black;
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

    </style>
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
<header>
Selamat Datang Di Pelayanan Penerbangan Pesawat
UPI.Com
</header>
<div class="container">
    <!-- Isi konten halaman Anda di sini -->

    <!-- Tampilan Tabel Jadwal Penerbangan -->
    <h2>Jadwal Penerbangan</h2><br>

    <div class="filter-container">
            <label for="negara-filter">Negara:</label>
            <select id="negara-filter" onchange="filterJadwal()">
                <option value="all">Semua Negara</option>
                <option value="indonesia">Indonesia</option>
                <!-- Tambahkan opsi negara lainnya -->
            </select>

            <label for="pulau-filter">Pulau:</label>
            <select id="pulau-filter" onchange="filterJadwal()">
                <option value="all">Semua Pulau</option>
                <option value="jawa">Jawa</option>
                <!-- Tambahkan opsi pulau lainnya -->
            </select>

            <label for="kota-filter">Kota:</label>
            <select id="kota-filter" onchange="filterJadwal()">
                <option value="all">Semua Kota</option>
                <option value="jakarta">Jakarta</option>
                <!-- Tambahkan opsi kota lainnya -->
            </select>
    </div>
    <?php
        if(isset($_GET["cari"])){
    ?>
        <form action="#" method="GET">
            <input type="text" name="cari" placeholder="Cari Sesuatu Nih???" class="search" value="<?= $cari?>">
            <button class="flight-card" type="submit" name="cari_ok">Cari</button>
        </form>
    <?php } ?>

    <table>
        <thead>
        <tr>
                    <th>ID</th>
                    <th>Waktu Penerbangan</th>
                    <th>Status</th>
                    <th>Kode Pesawat</th>
                    <th>Nama Maskapai</th>
                    <th>Bandara Asal</th>
                    <th>Bandara Tujuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $tampil = mysqli_query($koneksi, "SELECT jadwal.id, jadwal.waktu_penerbangan, jadwal.status, pesawat.kode_pesawat, maskapai.nama_maskapai, bandara_asal.nama_bandara as nama_bandara_asal, bandara_tujuan.nama_bandara as nama_bandara_tujuan FROM jadwal JOIN pesawat ON jadwal.id_pesawat = pesawat.id JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id;");
                    while($data = mysqli_fetch_array($result_jadwal)) :
                ?>
                <tr>
                    <td><?= $data['id']?></td>
                    <td><?= $data['waktu_penerbangan'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td><?= $data['kode_pesawat'] ?></td>
                    <td><?= $data['nama_maskapai'] ?></td>
                    <td><?= $data['nama_bandara_asal'] ?></td>
                    <td><?= $data['nama_bandara_tujuan'] ?></td>
                </tr>
                <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Gambar Animasi Pesawat pada Kartu Penerbangan -->
    <a href="PesanTiket.php">
        <div class="flight-card" onclick="showColorOnHover(this)">
            <i class="fas fa-plane plane-icon"></i>
            <p class="cta-text">Pesan Sekarang</p>
        </div>
    </a>

    <style>
        .search{
            align-self: center;
        }

        .flight-card {
            position: relative;
            cursor: pointer;
        }

        .cta-text {
            text-align: center;
            font-weight: bold;
            transition: color 0.3s;
        }

        .flight-card:hover .cta-text {
            color: #3498db;
        }

        @keyframes pulseAnimation {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes rotationAnimation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .plane-icon {
            animation: pulseAnimation 1s infinite alternate, rotationAnimation 2s linear infinite;
        }
    </style>

    <script>
        function showColorOnHover(element) {
            element.querySelector('.cta-text').style.color = '#3498db';
        }

        function toggleProfileMenu() {
            // Gantilah dengan logika untuk menampilkan menu profil atau navigasi ke halaman profil
            alert('Klik ikon profil!');
        }
    </script>

</div>
</div>

<footer>
    &copy; 2023 Layanan Penerbangan
</footer>

</body>
</html>
