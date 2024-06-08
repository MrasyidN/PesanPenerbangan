<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kursi - Pesan Tiket</title>
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
            flex-wrap: wrap;
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

        .seat-map {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 8px;
            margin-top: 16px;
        }

        .seat {
            width: 30px;
            height: 30px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .seat:not(.available) {
            background-color: #ddd;
            cursor: not-allowed;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
</head>
<body>

    <header>
        <h1>Pilih Kursi - Pesan Tiket</h1>
    </header>

    <div class="container">
        <form method="POST" action="Pesan_post.php">
            <div class="input-group">
                <!-- Informasi Pemesanan -->
                <div>
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div>
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" required>
                </div>
                <div>
                    <label for="usia">Usia:</label>
                    <input type="number" id="usia" name="usia" required>
                </div>
                <div>
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>
                </div>
                <div>
                    <label for="noPonsel">Nomor Ponsel:</label>
                    <input type="tel" id="noPonsel" name="noPonsel" required>
                </div>
            </div>

            <!-- Pilih Kursi -->
            <h2>Pilih Kursi</h2>
            <div class="seat-map">
                <?php
                    // Simulasi 100 kursi
                    for ($i = 1; $i <= 100; $i++) {
                        echo '<div class="seat available" data-seat="' . $i . '">' . $i . '</div>';
                    }
                ?>
            </div>

            <!-- Total Harga dan Metode Pembayaran -->
            <p>Total Harga: $200</p>
            <label for="hargaTiket">Metode Pembayaran</label>
            <input type="text" id="hargaTiket" name="bayar" required>

            <button type="submit" name="pesan">Pesan Sekarang</button>
        </form>
    </div>

</body>
</html>
