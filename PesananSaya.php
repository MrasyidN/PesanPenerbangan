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
    <title>Layanan Penerbangan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
         body {
    font-family: 'Poppins', sans-serif;
    background-image: url('img/Gambar_Pesawat3.jpg');
    background-size :cover;
    margin-bottom: 70px;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-top: 70px; /* Margin atas setara dengan tinggi navbar */
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
            max-width: 1000px;
            margin: 20px auto;
            padding: 10px;
            margin-top: 150px;
            margin-bottom: 100px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: left;
            color: #333;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
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
        <a href="Logout.php">LogOut</a>
        </div>
    </div>
</nav>

<div class="container">
    <!-- Isi konten halaman Anda di sini -->

    <!-- Tampilan Tabel Jadwal Penerbangan -->
    <h2>Pesanan Saya</h2>
    <table>
        <thead>
            <tr>
                <th>Nomor Tiket</th>
                <th>Nama Pemesan</th>
                <th>Kode Pesawat</th>
                <th>Waktu Penerbangan</th>
                <th>Kota Asal</th>
                <th>Kota Tujuan</th>
                <th>No Kursi</th>
                <th>Status Tiket</th>
                <th>Pengajuan</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $tampil = mysqli_query($koneksi, "SELECT tiket.id,
                    tiket.no_tiket, pesawat.kode_pesawat, customer.nama_customer,
                    bandaraAsal.nama_bandara AS asal,
                    bandaraTujuan.nama_bandara AS tujuan,
                    kursi.no_kursi, pembayaran.status,
                    maskapai.nama_maskapai, jadwal.waktu_penerbangan
                    FROM tiket
                    JOIN pesawat ON tiket.id_pesawat = pesawat.id
                    JOIN customer ON tiket.id_customer = customer.id
                    JOIN jadwal ON tiket.id_jadwal = jadwal.id
                    JOIN kursi ON tiket.id_kursi = kursi.id
                    JOIN pembayaran ON tiket.id_pembayaran = pembayaran.id
                    JOIN bandara AS bandaraAsal ON jadwal.id_bandara_asal = bandaraAsal.id
                    JOIN bandara AS bandaraTujuan ON jadwal.id_bandara_tujuan = bandaraTujuan.id
                    JOIN maskapai ON pesawat.id_maskapai = maskapai.id
                    JOIN user ON customer.id_user = user.id
                    WHERE user.id = $_SESSION[id]");
                    while($data = mysqli_fetch_array($tampil)) :
                ?>
                <tr>
                    <td><?= $data['no_tiket']?></td>
                    <td><?= $data['nama_customer'] ?></td>
                    <td><?= $data['kode_pesawat'] ?></td>
                    <td><?= $data['waktu_penerbangan'] ?></td>
                    <td><?= $data['asal'] ?></td>
                    <td><?= $data['tujuan'] ?></td>
                    <td><?= $data['no_kursi'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td>
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBayar<?= $data['id']?>">Bayar</a>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBatal<?= $data['id']?>">Batalkan</a>
                        <?php
                            if($data['status'] === 'terbayar'){
                        ?>
                        <form method="POST" action="LihatTiket.php" >
                                <!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal">Lihat Tiket</a> -->
                                <input type="hidden" value="<?= $data['id'] ?>" name="id">
                                <button type="submit" class="btn btn-primary" name="lihat" >Lihat Tiket</button>
                        </form>
                        <?php } ?>
                    </td>
                </tr> 

                <!-- Awal Modal tombol ubah -->
                <div class="modal fade modal-lg" id="modalBayar<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah jadwal</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                    
                            <form method="POST" action="BayarPost.php">

                                <div class="modal-body">
                                    <!-- <label for="gambar">Pilih Gambar:</label>
                                    <input type="file" name="gambar" id="gambar"><br><br> -->
                                    <!-- <input type="submit" class="btn btn-primary" value="Upload"> -->
                                    <label class="form-label">Apakah anda yakin sudah membayar?</label>
                                    <input type="hidden" value="<?= $data['id']?>" name="id_tiket">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="bayar" value="Upload">Ya</button> 
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Belum</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade modal-lg" id="modalBatal<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah jadwal</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="BatalPost.php">
                                
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Alasan Pembatalan</label>
                                        <textarea name="alasan" class="form-control" cols="30" rows="10"></textarea><br>
                                        <label class="form-label">Ketik Kembali "Saya membatalkan pesanan ini karena suatu alasan yang jelas"   </label>
                                        <input type="text" name="validasi" class="form-control">
                                        <input type="hidden" value="<?= $data['id']?>" name="id_tiket">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" name="batal">Batalkan</button> 
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>

        </tbody>
    </table>

    <style>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</div>
</div>

<footer>
    &copy; 2023 Layanan Penerbangan
</footer>

</body>
</html>
