<?php
    include "koneksi.php";

    if(isset($_POST['batal'])) {
        if(isset($_POST['validasi']) && $_POST['validasi']=== "Saya membatalkan pesanan ini karena suatu alasan yang jelas") {
            $simpan = mysqli_query($koneksi, "UPDATE `tiket` SET `pembatalan` = '$_POST[alasan]' WHERE `tiket`.`id` = '$_POST[id_tiket]';");

            $result_jadwal = mysqli_query($koneksi, "SELECT id_pembayaran FROM tiket WHERE id = '$_POST[id_tiket]'");
            $data_jadwal = mysqli_fetch_assoc($result_jadwal);
            $id_pembayaran = $data_jadwal['id_pembayaran'];

            $set_status_bayar = mysqli_query($koneksi, "UPDATE pembayaran SET status = 'pembatalan' WHERE id = $id_pembayaran");

            if($set_status_bayar){
                echo "<script>
                alert('Mengajukan Pembatalan Pesanan Berhasil');
                document.location = 'PesananSaya.php';
                </script>";
            }
        }else{
            echo "<script>
            alert('Kalimat yang dimasukan belum sama');
            document.location = 'PesananSaya.php';
            </script>";
        }
    }

?>