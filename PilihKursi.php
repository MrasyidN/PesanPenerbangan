<?php
    session_start();

    include "koneksi.php";

    if(isset($_POST['kursi'])){

        $result_customer = mysqli_query($koneksi, "INSERT INTO `customer` (`nama_customer`, `alamat`, `usia`, `jenis_kelamin`, `nik`, `no_ponsel`, `id_user`) VALUES ('$_POST[nama]', '$_POST[alamat]', '$_POST[usia]', '$_POST[jenis_kelamin]', '$_POST[nik]', '$_POST[noPonsel]', '$_SESSION[id]')");
        $id_customer = mysqli_insert_id($koneksi);

        $id_jadwal = $_POST['pilihJadwal'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket</title>
    <style>
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

        header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

        .seat-map {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 8px;
            margin-top: 16px;
        }

        .kursi-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .seat {
            position: relative;
        }

        .seat input {
            opacity: 0;
            position: absolute;
            height: 100%;
            width: 100%;
            cursor: pointer;
        }

        .seat-label {
            width: 30px;
            height: 30px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s; /* Transisi warna untuk efek perubahan warna */
        }

        .seat input:checked + .seat-label {
            background-color: #3498db;
            color: white;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
</head>
<body>

    <header>
        <h1>Pesan Tiket</h1>
    </header>

    <div class="container">
        <!-- Formulir Pemesanan Tiket -->
        <?php
            $result = mysqli_query($koneksi, "SELECT jadwal.id, jadwal.waktu_penerbangan, jadwal.status, pesawat.kode_pesawat, maskapai.nama_maskapai, bandara_asal.nama_bandara as nama_bandara_asal, bandara_tujuan.nama_bandara as nama_bandara_tujuan, harga FROM jadwal JOIN pesawat ON jadwal.id_pesawat = pesawat.id JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id where jadwal.id = '$id_jadwal'");
            $data_jadwal = mysqli_fetch_assoc($result);
            $pesawat = $data_jadwal['kode_pesawat'];
            
            $result_pesawat = mysqli_query($koneksi, "SELECT * from pesawat where kode_pesawat = '$pesawat'");
            $data_pesawat = mysqli_fetch_assoc($result_pesawat);
            $id_pesawat = $data_pesawat['id'];

        ?>
        <h2>Pilih Kursi</h2><br>
        <p>Penerbangan        : <?= $data_jadwal['nama_bandara_asal']?> --> <?= $data_jadwal['nama_bandara_tujuan']?></p>
        <p>Kode Pesawat       : <?= $data_jadwal['kode_pesawat']?></p>
        <p>Maskapai           : <?= $data_jadwal['nama_maskapai']?></p>
        <p>Waktu Penerbangan  : <?= $data_jadwal['waktu_penerbangan']?></p>
        <form method="POST" action="Pesan_post.php">
            <div class="input-group">
                <input type="hidden" value="<?= $id_customer?>" name="customer">
                <input type="hidden" value="<?= $id_jadwal?>" name="jadwal">
                <label for="kursi">Pilih Kursi</label>

                <div class="seat-map">
                    <?php
                    $kursi = mysqli_query($koneksi, "SELECT * FROM kursi WHERE 
                    id_pesawat = '$id_pesawat' AND status_kursi = 'tersedia'");
                    
                    if ($kursi && mysqli_num_rows($kursi) > 0) {
                        while ($data = mysqli_fetch_assoc($kursi)) :
                    ?>
                    <!-- <div class="seat available" data-seat="' . $i . '">' . $i . '</div> -->
                        <div class="seat">
                            <input type="radio" id="kursi<?= $data['id'] ?>" name="pilihKursi" value="<?= $data['id'] ?>">
                            <label for="kursi<?= $data['id'] ?>" class="seat-label"><?= $data['no_kursi'] ?></label>
                        </div>
                    <?php
                        endwhile;
                    } else {
                        echo "Tidak ada kursi tersedia.";
                    }
                    ?>
                </div>
            </div>
            <p>Total Harga    : <?= $data_jadwal['harga'] ?></p>
            <label for="hargaTiket">Metode Pembayaran</label>
            <input type="text" id="hargaTiket" name="bayar">
            <button type="submit" name="pesan">Pesan Sekarang</button>
        </form>
        
    </div>

    

</body>
</html>
