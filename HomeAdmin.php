<?php
  session_start();

  include ("koneksi.php");

  if (!isset($_SESSION['id'])) {
      header("location: Home.php");
      exit();
  }
  

  if(isset($_POST['terima'])){
    $terima = mysqli_query($koneksi, "UPDATE `jadwal` SET `status` = 'tersedia' WHERE `jadwal`.`id` = '$_POST[id]';");

    $select = mysqli_query($koneksi, "SELECT * from `jadwal` WHERE `id` = '$_POST[id]'");
    $jadwal = mysqli_fetch_assoc($select);
    $id = $jadwal['id_pesawat'];

    $kursi = mysqli_query($koneksi, "SELECT jumlah_kursi from pesawat where id = '$id'");
    $jumlah_kursi = mysqli_fetch_assoc($kursi);
    $data_kursi = $jumlah_kursi['jumlah_kursi'];

    for ($i = 1; $i <= $data_kursi; $i++) {
      $dummy = mysqli_query($koneksi, "INSERT INTO kursi (id_pesawat, status_kursi, no_kursi, id_jadwal) values ('$id', 'tersedia', '$i', '$_POST[id]')");
  }

    if($terima){
      echo "<script>
      alert('Status Jadwal Telah Berubah Menjadi Tersedia');
      document.location = 'HomeAdmin.php';
      </script>";
    }
  }else if(isset($_POST['tolak'])){
    $terima = mysqli_query($koneksi, "UPDATE `jadwal` SET `status` = 'ditolak' WHERE `jadwal`.`id` = '$_POST[id]';");
    if($terima){
      echo "<script>
      alert('Status Jadwal Telah Berubah Menjadi Ditolak');
      document.location = 'HomeAdmin.php';
      </script>";
    }
  }else if(isset($_POST['hapus'])){
    $terima = mysqli_query($koneksi, "DELETE FROM jadwal WHERE `jadwal`.`id` = '$_POST[id]'");
    $hapus_dummy = mysqli_query($koneksi, "DELETE FROM kursi WHERE id_jadwal = '$_POST[id]'");
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
 <style>

body {
    font-family: 'Poppins', sans-serif;
    background-image: url('img/Gambar_Pesawat8.jpg');
    background-size :cover;
    margin-bottom: 70px;
    color: white;
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

 </style>

    
  </head>

  <body>
    
    <div class="container">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Data Jadwal</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="DataAkun.php">Data Akun</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="Komponen.php">Tambah Komponen</a>
                </li>
                <ul class="navbar-nav ms-auto"> <!-- Tambahkan kelas ms-auto untuk menyusun item ke kanan -->
  <li class="nav-item">
    
    <a class="nav-link" href="Logout.php">Logout</a>
  </li>
</ul>

            </div>
          </div>
        </nav>
      <div class="mt-3">
      <h3 class="text-center">Data Seluruh Jadwal</h3>
      </div>

        <div class="card mt-3">
          <div class="card-header bg-primary text-white">
            Seluruh Jadwal Penerbangan
          </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                  <tr>
                    <th>No</th>
                    <th>Waktu Penerbangan</th>
                    <th>Status</th>
                    <th>Kode Pesawat</th>
                    <th>Nama Maskapai</th>
                    <th>Bandara asal</th>
                    <th>Bandara Tujuan</th>
                    <th>Aksi</th>
                  </tr>


                  <?php
                  $no = 1;
                  $tampil = mysqli_query($koneksi, "SELECT jadwal.id, jadwal.waktu_penerbangan, jadwal.status, 
                            pesawat.kode_pesawat, maskapai.nama_maskapai, bandara_asal.nama_bandara as nama_bandara_asal, 
                            bandara_tujuan.nama_bandara as nama_bandara_tujuan, jadwal.id_user 
                            FROM jadwal 
                            JOIN pesawat ON jadwal.id_pesawat = pesawat.id 
                            JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id 
                            JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id 
                            JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id");
                  while($data = mysqli_fetch_array($tampil)) : 
                  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no?></td>
                    <td><?= $data['waktu_penerbangan']?></td>
                    <td><?= $data['status']?></td>
                    <td><?= $data['kode_pesawat']?></td>
                    <td><?= $data['nama_maskapai']?></td>
                    <td><?= $data['nama_bandara_asal']?></td>
                    <td><?= $data['nama_bandara_tujuan']?></td>
                    <td>
                      <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id']?>">Hapus</a>
                    </td>
                  </tr> 
                  <div class="modal fade modal-lg" id="modalHapus<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus jadwal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus Pengajuan Jadwal?</p>
                      </div>
                        <div class="modal-footer">
                          <input type="hidden" value="<?= $data['id']?>" name="id">
                          <button type="submit" class="btn btn-danger" name="hapus" >Iya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                  <?php $no++; endwhile; ?>
                </table>

            </div>
        </div>
        <div class="card mt-3">
          <div class="card-header bg-primary text-white">
            Pengajuan Tambah atau Edit Jadwal Oleh Penjual
          </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                  <tr>
                    <th>No</th>
                    <th>Waktu Penerbangan</th>
                    <th>Status</th>
                    <th>Kode Pesawat</th>
                    <th>Nama Maskapai</th>
                    <th>Bandara asal</th>
                    <th>Bandara Tujuan</th>
                    <th>Pengajuan</th>
                  </tr>


                  <?php
                  $no = 1;
                  $tampil = mysqli_query($koneksi, "SELECT jadwal.id, jadwal.waktu_penerbangan, jadwal.status, 
                            pesawat.kode_pesawat, maskapai.nama_maskapai, bandara_asal.nama_bandara as nama_bandara_asal, 
                            bandara_tujuan.nama_bandara as nama_bandara_tujuan 
                            FROM jadwal 
                            JOIN pesawat ON jadwal.id_pesawat = pesawat.id 
                            JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id 
                            JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id 
                            JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id
                            where status = 'menunggu persetujuan' or status = 'diedit';");
                  while($data = mysqli_fetch_array($tampil)) : 
                  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no?></td>
                    <td><?= $data['waktu_penerbangan']?></td>
                    <td><?= $data['status']?></td>
                    <td><?= $data['kode_pesawat']?></td>
                    <td><?= $data['nama_maskapai']?></td>
                    <td><?= $data['nama_bandara_asal']?></td>
                    <td><?= $data['nama_bandara_tujuan']?></td>
                    <td>
                      <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTerima<?= $data['id']?>">Terima</a>
                      <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak<?= $data['id']?>">Tolak</a>
                    </td>
                  </tr> 

                <div class="modal fade modal-lg" id="modalTerima<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Terima Pengajuan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Menerima Pengajuan Jadwal?</p>
                      </div>
                        <div class="modal-footer">
                          <input type="hidden" value="<?= $data['id']?>" name="id">
                          <button type="submit" class="btn btn-success" name="terima" >Iya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="modal fade modal-lg" id="modalTolak<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tolak Pengajuan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Menolak Pengajuan Jadwal?</p>
                      </div>
                        <div class="modal-footer">
                          <input type="hidden" value="<?= $data['id']?>" name="id">
                          <button type="submit" class="btn btn-danger" name="tolak" >Iya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Akhir Modal -->


                  <?php $no++; endwhile; ?>
                </table>

            </div>
        </div>
        <div class="card mt-3">
          <div class="card-header bg-primary text-white">
            Pengajuan Penghapusan Jadwal Oleh Penjual
          </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                  <tr>
                    <th>No</th>
                    <th>Waktu Penerbangan</th>
                    <th>Status</th>
                    <th>Kode Pesawat</th>
                    <th>Nama Maskapai</th>
                    <th>Bandara asal</th>
                    <th>Bandara Tujuan</th>
                    <th>Aksi</th>
                  </tr>


                  <?php
                  $no = 1;
                  $tampil = mysqli_query($koneksi, "SELECT jadwal.id, jadwal.waktu_penerbangan, jadwal.status, 
                            pesawat.kode_pesawat, maskapai.nama_maskapai, bandara_asal.nama_bandara as nama_bandara_asal, 
                            bandara_tujuan.nama_bandara as nama_bandara_tujuan 
                            FROM jadwal 
                            JOIN pesawat ON jadwal.id_pesawat = pesawat.id 
                            JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id 
                            JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id 
                            JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id
                            where status = 'hapus';");
                  while($data = mysqli_fetch_array($tampil)) : 
                  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no?></td>
                    <td><?= $data['waktu_penerbangan']?></td>
                    <td><?= $data['status']?></td>
                    <td><?= $data['kode_pesawat']?></td>
                    <td><?= $data['nama_maskapai']?></td>
                    <td><?= $data['nama_bandara_asal']?></td>
                    <td><?= $data['nama_bandara_tujuan']?></td>
                    <td>
                      <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id']?>">Hapus</a>
                    </td>
                  </tr> 

                  
                <!-- Awal Modal tombol ubah -->
                <div class="modal fade modal-lg" id="modalHapus<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus jadwal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus Pengajuan Jadwal?</p>
                      </div>
                        <div class="modal-footer">
                          <input type="hidden" value="<?= $data['id']?>" name="id">
                          <button type="submit" class="btn btn-danger" name="hapus" >Iya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Akhir Modal -->


                  <?php $no++; endwhile; ?>
                </table>
                


            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>