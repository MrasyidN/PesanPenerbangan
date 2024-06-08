<?php
    include "koneksi.php";

    if(isset($_POST['pesan'])){
        // $result_customer = mysqli_query($koneksi, "INSERT INTO `customer` (`nama_customer`, `alamat`, `usia`, `jenis_kelamin`, `nik`, `no_ponsel`, `id_user`) VALUES ('$_POST[nama]', '$_POST[alamat]', '$_POST[usia]', '$_POST[jenis_kelamin]', '$_POST[nik]', '$_POST[noPonsel]', '$_SESSION[id]')");
        // $id_customer = mysqli_insert_id($koneksi);

        // $id_jadwal = $_POST['pilihJadwal'];

        // $query_jadwal = "SELECT id_pesawat FROM jadwal WHERE id_jadwal = '$id_jadwal'";
        $result_jadwal = mysqli_query($koneksi, "SELECT id_pesawat, harga FROM jadwal WHERE id = '$_POST[jadwal]'");
        $data_jadwal = mysqli_fetch_assoc($result_jadwal);
        $id_pesawat = $data_jadwal['id_pesawat'];
        $harga = $data_jadwal['harga'];

        $result_pembayaran = mysqli_query($koneksi, "INSERT INTO pembayaran (`id_jadwal`, `status`, `metode_pembayaran`, `total_harga`) VALUES ('$_POST[jadwal]', 'belum dibayar', '$_POST[bayar]', '$harga')");
        $id_pembayaran = mysqli_insert_id($koneksi);

        $ubah_status = mysqli_query($koneksi, "UPDATE kursi SET status_kursi = 'terpesan' WHERE id = '$_POST[pilihKursi]'");

        $simpan = mysqli_query($koneksi, "INSERT INTO `tiket` (`id_pesawat`, `id_customer`, `id_jadwal`, `id_kursi`,`nominal_pembayaran`, `id_pembayaran`) VALUES ('$id_pesawat', '$_POST[customer]', '$_POST[jadwal]', '$_POST[pilihKursi]', '$id_pembayaran', '$id_pembayaran')");

        $hitung = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_tersedia FROM kursi WHERE id_jadwal = '$_POST[jadwal]' AND status_kursi = 'tersedia'");
        $hitung_kursi = mysqli_fetch_assoc($hitung);
        if($hitung_kursi['jumlah_tersedia'] == 0){
            $update_status = mysqli_query($koneksi, "UPDATE jadwal set status = 'penuh' where id = '$_POST[jadwal]'");
        }

        if($simpan){
            echo "<script>alert('Berhasil Memesan');</script>";
            $deleteCustomer = mysqli_query($koneksi, "DELETE FROM customer WHERE id NOT IN (SELECT id_customer FROM tiket)");
            echo '<script>window.location.href = "PesananSaya.php";</script>';
        }else{
            echo "<script>alert('Gagal Memesan');</script>";
            echo '<script>window.location.href = "HomeSetelahLogin.php";</script>';
        }
        

    }
?>
