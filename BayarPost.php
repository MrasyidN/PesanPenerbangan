<?php

include "koneksi.php";

if (isset($_POST['bayar'])) {
    $result_jadwal = mysqli_query($koneksi, "SELECT id_pembayaran FROM tiket WHERE id = '$_POST[id_tiket]'");
    $data_jadwal = mysqli_fetch_assoc($result_jadwal);
    $id_pembayaran = $data_jadwal['id_pembayaran'];

    $set_status_bayar = mysqli_query($koneksi, "UPDATE pembayaran SET status = 'terbayar' WHERE id = $id_pembayaran");

    if($set_status_bayar){
        echo "<script>
        alert('Pembayaran Berhasil');
        document.location = 'PesananSaya.php';
        </script>";
    }

    // Cek apakah ada file yang diunggah
    // if (isset($_FILES["gambar"])) {
    //     echo "<script>
    //             alert('Coba');
    //             document.location = 'home.php';
    //             </script>";
    //     $targetDir = "Bukti_Pembayaran/";  // Direktori tempat menyimpan file
    //     $targetFile = $targetDir . basename($_FILES["gambar"]["name"]);
    //     $uploadOk = 1;
    //     $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    //     // Cek apakah file adalah gambar
    //     if (getimagesize($_FILES["gambar"]["tmp_name"]) === false) {
    //         echo "File bukan gambar.";
    //         $uploadOk = 0;
    //     }

    //     // Cek apakah file sudah ada
    //     if (file_exists($targetFile)) {
    //         echo "Maaf, file tersebut sudah ada.";
    //         $uploadOk = 0;
    //     }

    //     // Cek ukuran file
    //     if ($_FILES["gambar"]["size"] > 500000) {
    //         echo "Maaf, ukuran file terlalu besar.";
    //         $uploadOk = 0;
    //     }

    //     // Izinkan hanya beberapa format gambar tertentu
    //     $allowedFormats = array("jpg", "jpeg", "png", "gif");
    //     if (!in_array($imageFileType, $allowedFormats)) {
    //         echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
    //         $uploadOk = 0;
    //     }

    //     // Cek apakah uploadOk tetap bernilai 1
    //     if ($uploadOk == 1) {
    //         // Pindahkan file ke direktori yang ditentukan
    //         if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
    //             echo "File berhasil diunggah.";
    //         } else {
    //             echo "Terjadi kesalahan saat mengunggah file.";
    //         }
    //     }
    // }
}
?>
