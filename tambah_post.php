<?php

    include "koneksi.php";

    if(isset($_POST['tambah'])){
        $simpan = mysqli_query($koneksi, "INSERT INTO jadwal (id_pesawat, id_pesawat_maskapai, id_bandara_asal, id_bandara_tujuan, waktu_penerbangan, status, harga, id_user) VALUES ('$_POST[pesawat]', (SELECT id_maskapai FROM pesawat WHERE id = '$_POST[pesawat]'), '$_POST[asal]', '$_POST[tujuan]', '$_POST[waktu]', 'menunggu persetujuan', '$_POST[harga]', 2) ");

        if($simpan){
            echo "<script>
                alert('Tambah jadwal sukses');
                </script>";
            echo '<script>window.location.href = "HomePenjual.php";</script>';
        }else{
            echo "<script>
                alert('Tambah jadwal gagal');
                document.location = 'home.php';
                </script>";
        }
    }

?>