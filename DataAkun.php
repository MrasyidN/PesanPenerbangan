<?php
    session_start();

  include("koneksi.php");

  if (!isset($_SESSION['id'])) {
    header("location: Home.php");
    exit();
}

  if(isset($_POST['edit'])){
    $terima = mysqli_query($koneksi, "UPDATE user SET username = '$_POST[username]', email = '$_POST[email]', role = '$_POST[role]' WHERE id = '$_POST[id]';");
    if($terima){
      echo "<script>
      alert('Data Akun Telah Diubah');
      document.location = 'DataAkun.php';
      </script>";
    }
  }else if(isset($_POST['hapus'])){
    $terima = mysqli_query($koneksi, "DELETE FROM user WHERE `user`.`id` = '$_POST[id]'");
    if($terima){
      echo "<script>
      alert('Akun Telah Dihapus');
      document.location = 'DataAkun.php';
      </script>";
    }
  }else if(isset($_POST['tambah'])){
    $terima = mysqli_query($koneksi, "INSERT INTO `user` (`username`, `password`, `email`, `role`) VALUES ('$_POST[username]', '$_POST[password]', '$_POST[email]', '$_POST[role]')");
    if($terima){
      echo "<script>
      alert('Berhasil Membuat Akun');
      document.location = 'DataAkun.php';
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
                <a class="nav-link" aria-current="page" href="HomeAdmin.php">Data Jadwal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="DataAkun.php">Data Akun</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Komponen.php">Tambah Komponen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="mt-3">
      <h3 class="text-center">Data Seluruh Akun</h3>
      </div>

        <div class="card mt-3">
          <div class="card-header bg-primary text-white">
            Seluruh Akun Aktif
          </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                  <tr>
                    <th style="text-align: center;">No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                  </tr>


                  <?php
                  $no = 1;
                  $tampil = mysqli_query($koneksi, "SELECT * from user");
                  while($data = mysqli_fetch_array($tampil)) : 
                    $pass = $data['password'];
                    $passEnc = base64_encode($pass);
                  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no?></td>
                    <td><?= $data['username']?></td>
                    <td><?= $passEnc?></td>
                    <td><?= $data['email']?></td>
                    <td><?= $data['role']?></td>
                    <td>
                      <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $data['id']?>">Edit</a>
                      <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id']?>">Hapus</a>
                    </td>
                  </tr> 

                  <div class="modal fade modal-lg" id="modalUbah<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Akun</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">

                      <input type="hidden" name="id" value="<?= $data['id']?>">

                        <div class="mb-3">
                          <label class="form-label">Username</label>
                          <input type="text" class="form-control" name="username" value="<?= $data['username']?>" >
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label">Password</label>
                          <input type="text" class="form-control disabled" name="pass" value="<?= $passEnc?>" readonly>
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label">Username</label>
                          <input type="text" class="form-control" name="email" value="<?= $data['email']?>">
                        </div>

                        <div class= "mb-3">
                        <label class="form-label">Role</label>
                          <select class="form-select" name="role">
                            <?php
                              if($data['role']=='admin'){
                                echo '
                                <option value="admin" selected>Admin</option>
                                <option value="penjual">Penjual</option>
                                <option value="pembeli">Pembeli</option>
                                ';
                              }else if($data['role']=='penjual'){
                                echo '
                                <option value="admin">Admin</option>
                                <option value="penjual" selected>Penjual</option>
                                <option value="pembeli">Pembeli</option>
                                ';
                              }else if($data['role'] == 'pembeli'){
                                echo '
                                <option value="admin">Admin</option>
                                <option value="penjual">Penjual</option>
                                <option value="pembeli" selected>Pembeli</option>
                                ';
                              }
                            ?>
                          </select>
                        </div>


                      </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="edit" >Ubah</button> 
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                  <div class="modal fade modal-lg" id="modalHapus<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Akun</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus AKun?</p>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                  Tambah Akun
                </button>

                <?php
                  $tampil = mysqli_query($koneksi, "SELECT jadwal.id, jadwal.waktu_penerbangan, jadwal.status, 
                            pesawat.kode_pesawat, maskapai.nama_maskapai, bandara_asal.nama_bandara as nama_bandara_asal, 
                            bandara_tujuan.nama_bandara as nama_bandara_tujuan 
                            FROM jadwal 
                            JOIN pesawat ON jadwal.id_pesawat = pesawat.id 
                            JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id 
                            JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id 
                            JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id;");
                  while($data = mysqli_fetch_array($tampil)) : 

                  ?>


                <!-- Awal Modal -->
                <div class="modal fade modal-lg" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Akun</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">
                      <div class="modal-body">

                        <div class="mb-3">
                          <label class="form-label">Username</label>
                          <input type="text" class="form-control" name="username">
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label">Password</label>
                          <input type="text" class="form-control" name="password">
                        </div>
                        
                        <div class= "mb-3">
                          <label class="form-label">Email</label>
                          <input type="text" class="form-control" name="email">
                        </div>

                        <div class= "mb-3">
                        <label class="form-label">Role</label>
                          <select class="form-select" name="role">
                            <option value="admin">Admin</option>
                            <option value="penjual">Penjual</option>
                            <option value="pembeli">Pembeli</option>
                          </select>
                        </div>

                      </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" name="tambah" >Buat</button> 
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                
                <!-- Akhir Modal -->

                <?php endwhile; ?>

            </div>
        </div>
        <div class="card mt-3">
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>