<?php
  session_start();

  include("koneksi.php");

  if(isset($_POST['terima'])){
    $kursi = mysqli_query($koneksi, "UPDATE `kursi` SET `status_kursi` = 'tersedia' WHERE `id` = '$_POST[id_kursi]'");
    $hitung_kursi = "SELECT COUNT(*) AS jumlah_tersedia FROM kursi WHERE id_jadwal = '$_POST[id_jadwal]' AND status = 'Tersedia'";
    if($hitung_kursi>0){
        $hapus_kursi = "UPDATE jadwal status = 'tersedia' where id = '$_POST[jadwal]'";
    }
    $terima = mysqli_query($koneksi, "DELETE FROM tiket WHERE `tiket`.`id` = '$_POST[id]'");
    if($terima){
      echo "<script>
      alert('Pembatalan Pesanan Disetujui');
      document.location = 'KotakMasukPenjual.php';
      </script>";
    }
  }else if(isset($_POST['tolak'])){
    $terima = mysqli_query($koneksi, "UPDATE `pembayaran` SET `status` = 'pembatalan ditolak' WHERE `id` = '$_POST[id_pembayaran]'");
    $terima_tiket = mysqli_query($koneksi, "UPDATE `tiket` SET `pembatalan` = null WHERE `id` = '$_POST[id]'");
    
    if($terima && $terima_tiket){
      echo "<script>
      alert('Status Jadwal Telah Berubah Menjadi Ditolak');
      document.location = 'KotakMasukPenjual.php';
      </script>";
    }
  }else if(isset($_POST['hapus'])){
    $terima = mysqli_query($koneksi, "DELETE FROM jadwal WHERE `jadwal`.`id` = '$_POST[id]'");
    if($terima){
      echo "<script>
      alert('Jadwal Telah Dihapus');
      document.location = 'HomeAdmin.php';
      </script>";
    }

  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="HomePenjual.php">Jadwal Penerbangan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Kotak Masuk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="Logout.php">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <div class="mt-3">
      <h3 class="text-center">Kotak Masuk</h3>
      </div>

        <div class="card mt-3">
          <div class="card-header bg-primary text-white">
            Pengajuan Pembatalan Pesanan
          </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                  <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Waktu Penerbangan</th>
                    <th>Penerbangan</th>
                    <th>Kode Pesawat - Maskapai</th>
                    <th>No Kursi</th>
                    <th>Alasan Pembatalan</th>
                    <th>Aksi</th>
                  </tr>

                  <?php
                  $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT tiket.id,
                    tiket.no_tiket, pesawat.kode_pesawat, customer.nama_customer,
                    bandaraAsal.nama_bandara AS asal,
                    bandaraTujuan.nama_bandara AS tujuan,
                    kursi.no_kursi, pembayaran.status, pembayaran.id as id_pembayaran, 
                    maskapai.nama_maskapai, jadwal.waktu_penerbangan, kursi.id as id_kursi, pembatalan, jadwal.id_user, jadwal.id as id_jadwal
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
                    WHERE pembatalan is not null and jadwal.id_user = '$_SESSION[id]'");
                    while($data = mysqli_fetch_array($tampil)) :
                  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no?></td>
                    <td><?= $data['nama_customer']?></td>
                    <td><?= $data['waktu_penerbangan']?></td>
                    <td><?= $data['asal']?> - <?= $data['tujuan']?></td>
                    <td><?= $data['kode_pesawat']?> - <?= $data['nama_maskapai']?></td>
                    <td><?= $data['no_kursi']?></td>
                    <td><?= $data['pembatalan']?></td>
                    <td>
                      <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTerima<?= $data['id']?>">Terima</a>
                      <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak<?= $data['id']?>">Tolak</a>
                    </td>
                  </tr> 
                  <div class="modal fade modal-lg" id="modalTerima<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Terima Pembatalan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Menerima Pengajuan Pembatalan Pesanan?</p>
                      </div>
                        <div class="modal-footer">
                          <input type="hidden" value="<?= $data['id']?>" name="id">
                          <input type="hidden" value="<?= $data['id_kursi']?>" name="id_kursi">
                          <input type="hidden" value="<?= $data['id_jadwal']?>" name="id_jadwal">
                          <button type="submit" class="btn btn-danger" name="terima" >Iya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                
                <div class="modal fade modal-lg" id="modalTolak<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Tolak Pembatalan</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form method="POST" action="#">

                    <div class="modal-body">
                      <p>Apakah Anda Yakin Menolak Pengajuan Pembatalan Pesanan?</p>
                    </div>
                      <div class="modal-footer">
                        <input type="hidden" value="<?= $data['id']?>" name="id">
                        <input type="hidden" value="<?= $data['id_pembayaran']?>" name="id_pembayaran">
                        <button type="submit" class="btn btn-danger" name="tolak" >Iya</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

                  <?php $no++; endwhile; ?>
                </table>

            </div>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>