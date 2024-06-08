<?php
    session_start();

  include("koneksi.php");

  if (!isset($_SESSION['id'])) {
    header("location: Home.php");
    exit();
}

  if(isset($_POST['edit'])){
    $terima = mysqli_query($koneksi, "UPDATE bandara SET nama_bandara = '$_POST[nama]', alamat = '$_POST[alamat]'WHERE id = '$_POST[id]';");
    if($terima){
      echo "<script>
      alert('Data Bandara Telah Diubah');
      document.location = 'Komponen.php';
      </script>";
    }else{
      echo "<script>
      alert('Gagal Mengubah Data Bandara');
      document.location = 'Komponen.php';
      </script>";
    }
  }else if(isset($_POST['hapus'])){
    $terima = mysqli_query($koneksi, "DELETE FROM bandara WHERE `id` = '$_POST[id]'");
    if($terima){
      echo "<script>
      alert('Data Bandara Telah Dihapus');
      document.location = 'Komponen.php';
      </script>";
    }else{
      echo "<script>
      alert('Gagal Menghapus Data Bandara');
      document.location = 'Komponen.php';
      </script>";
    }
  }else if(isset($_POST['tambah'])){
    $terima = mysqli_query($koneksi, "INSERT INTO `bandara` (`nama_bandara`, `alamat`) VALUES ('$_POST[nama]', '$_POST[alamat]')");
    if($terima){
      echo "<script>
      alert('Berhasil Membuat Data Bandara');
      document.location = 'Komponen.php';
      </script>";
    }else{
      echo "<script>
      alert('Gagal Membuat Data Bandara');
      document.location = 'Komponen.php';
      </script>";
    }
  }else if(isset($_POST['editMaskapai'])){
    $terima = mysqli_query($koneksi, "UPDATE maskapai set nama_maskapai = '$_POST[nama]' where id = '$_POST[id]'");
    if($terima){
      echo "<script>
      alert('Berhasil Mengubah Data Maskapai');
      document.location = 'Komponen.php';
      </script>";
    }else{
      echo "<script>
      alert('Gagal Mengubah Data Maskapai');
      document.location = 'Komponen.php';
      </script>";
    }
  }else if(isset($_POST['hapusMaskapai'])){
    $terima = mysqli_query($koneksi, "DELETE FROM maskapai WHERE `id` = '$_POST[id]'");
    if($terima){
      echo "<script>
      alert('Data Maskapai Telah Dihapus');
      document.location = 'Komponen.php';
      </script>";
    }else{
      echo "<script>
      alert('Gagal Menghapus Data Maskapai');
      document.location = 'Komponen.php';
      </script>";
    }
  }else if(isset($_POST['tambahMaskapai'])){
    $terima = mysqli_query($koneksi, "INSERT INTO `Maskapai` (`nama_maskapai`) VALUES ('$_POST[nama]')");
    if($terima){
      echo "<script>
      alert('Berhasil Membuat Data Maskapai');
      document.location = 'Komponen.php';
      </script>";
    }else{
      echo "<script>
      alert('Gagal Membuat Data Maskapai');
      document.location = 'Komponen.php';
      </script>";
    }
  }else if(isset($_POST['editPesawat'])){
    $terima = mysqli_query($koneksi, "UPDATE pesawat set kode_pesawat = '$_POST[kode]', nama_pesawat = '$_POST[nama]', nomor_pesawat = '$_POST[nomor]', kelas = '$_POST[kelas]', jumlah_kursi = '$_POST[kursi]', id_maskapai = '$_POST[maskapai]' where id = '$_POST[id]'");
    if($terima){
      echo "<script>
      alert('Berhasil Mengubah Data Pesawat');
      document.location = 'Komponen.php';
      </script>";
    }else{
      echo "<script>
      alert('Gagal Mengubah Data Pesawat');
      document.location = 'Komponen.php';
      </script>";
    }
  }else if(isset($_POST['hapusPesawat'])){
    $terima = mysqli_query($koneksi, "DELETE FROM Pesawat WHERE `id` = '$_POST[id]'");
    if($terima){
      echo "<script>
      alert('Data Pesawat Telah Dihapus');
      document.location = 'Komponen.php';
      </script>";
    }else{
      echo "<script>
      alert('Gagal Menghapus Data Pesawat');
      document.location = 'Komponen.php';
      </script>";
    }
  }else if(isset($_POST['tambahPesawat'])){
    $terima = mysqli_query($koneksi, "INSERT INTO `Pesawat` (`kode_pesawat`, `nama_pesawat`, `nomor_pesawat`, `kelas`, `jumlah_kursi`, `id_maskapai`) VALUES ('$_POST[kode]', '$_POST[nama]', '$_POST[nomor]', '$_POST[kelas]', '$_POST[kursi]', '$_POST[maskapai]')");
    if($terima){
      echo "<script>
      alert('Berhasil Membuat Data Maskapai');
      document.location = 'Komponen.php';
      </script>";
    }else{
      echo "<script>
      alert('Gagal Membuat Data Maskapai');
      document.location = 'Komponen.php';
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
                <a class="nav-link" aria-current="page" href="#">Data Jadwal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="DataAkun.php">Data Akun</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="Komponen.php">Tambah Komponen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="mt-3">
      <h3 class="text-center">Komponen Penerbangan</h3>
      </div>

        <div class="card mt-3">
          <div class="card-header bg-primary text-white">
            Data Bandara
          </div>
            <div class="card-body" >
                <table class="table table-bordered table-striped table-hover" style="text-align: center;">
                  <tr >
                    <th>No</th>
                    <th>Nama Bandara</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                  </tr>
                  
                  <?php
                  $no = 1;
                  $tampil = mysqli_query($koneksi, "SELECT * from bandara");
                  while($data = mysqli_fetch_array($tampil)) : 
                  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no?></td>
                    <td><?= $data['nama_bandara']?></td>
                    <td><?= $data['alamat']?></td>
                    <td>
                      <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $data['id'], $data['alamat']?>">Edit</a>
                      <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id'], $data['alamat']?>">Hapus</a>
                    </td>
                  </tr> 

                  <div class="modal fade modal-lg" id="modalUbah<?= $data['id'], $data['alamat']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Bandara</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">

                      <input type="hidden" name="id" value="<?= $data['id']?>">

                        <div class="mb-3">
                          <label class="form-label">Nama Bandara</label>
                          <input type="text" class="form-control" name="nama" value="<?= $data['nama_bandara']?>" >
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label">Alamat</label>
                          <input type="text" class="form-control disabled" name="alamat" value="<?= $data['alamat']?>">
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

                  <div class="modal fade modal-lg" id="modalHapus<?= $data['id'], $data['alamat']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Akun</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus Data Bandara?</p>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAkun">
                  Tambah Bandara
                </button>

                <?php
                  $tampil = mysqli_query($koneksi, "select * from bandara");
                  while($data = mysqli_fetch_array($tampil)) : 

                  ?>


                <!-- Awal Modal -->
                <div class="modal fade modal-lg" id="tambahAkun" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data bandara</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">
                      <div class="modal-body">

                        <div class="mb-3">
                          <label class="form-label">Nama Bandara</label>
                          <input type="text" class="form-control" name="nama">
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label">Alamat</label>
                          <input type="text" class="form-control" name="alamat">
                        </div>

                      </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="tambah" >Tambahkan</button> 
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
          <div class="card-header bg-primary text-white">
            Data Maskapai
          </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" style="text-align: center;">
                  <tr>
                    <th>No</th>
                    <th>Nama Maskapai</th>
                    <th>Aksi</th>
                  </tr>

                  <?php
                  $no = 1;
                  $tampil = mysqli_query($koneksi, "SELECT * from maskapai");
                  while($data = mysqli_fetch_array($tampil)) : 
                  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no?></td>
                    <td><?= $data['nama_maskapai']?></td>
                    <td>
                      <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $data['id']?>">Edit</a>
                      <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id']?>">Hapus</a>
                    </td>
                  </tr> 

                  <div class="modal fade modal-lg" id="modalUbah<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Maskapai</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">

                      <input type="hidden" name="id" value="<?= $data['id']?>">

                        <div class="mb-3">
                          <label class="form-label">Nama Maskapai</label>
                          <input type="text" class="form-control" name="nama" value="<?= $data['nama_maskapai']?>" >
                        </div>
                      </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="editMaskapai" >Ubah</button> 
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data Maskapai</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus Data Maskapai?</p>
                      </div>
                        <div class="modal-footer">
                          <input type="hidden" value="<?= $data['id']?>" name="id">
                          <button type="submit" class="btn btn-danger" name="hapusMaskapai" >Iya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                  <?php $no++; endwhile; ?>
                
                </table>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                  Tambah Maskapai
                </button>

                <?php
                  $tampil = mysqli_query($koneksi, "select * from bandara");
                  while($data = mysqli_fetch_array($tampil)) : 

                  ?>


                <!-- Awal Modal -->
                <div class="modal fade modal-lg" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Maskapai</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">
                      <div class="modal-body">

                        <div class="mb-3">
                          <label class="form-label">Nama Maskapai</label>
                          <input type="text" class="form-control" name="nama">
                        </div>

                      </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="tambahMaskapai" >Tambahkan</button> 
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
          <div class="card-header bg-primary text-white">
            Data Pesawat
          </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" style="text-align: center;">
                  <tr>
                    <th>No</th>
                    <th>Kode Pesawat</th>
                    <th>Nama Pesawat</th>
                    <th>Nomor Pesawat</th>
                    <th>Kelas</th>
                    <th>Jumlah Kursi</th>
                    <th>Maskapai</th>
                    <th>Aksi</th>
                  </tr>

                  <?php
                  $no = 1;
                  $tampil = mysqli_query($koneksi, "SELECT pesawat.id, kode_pesawat, nama_pesawat, nomor_pesawat, kelas, jumlah_kursi, maskapai.nama_maskapai, maskapai.id as id_maskapai from pesawat JOIN maskapai ON pesawat.id_maskapai = maskapai.id");
                  while($data = mysqli_fetch_array($tampil)) : 
                  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no?></td>
                    <td><?= $data['kode_pesawat']?></td>
                    <td><?= $data['nama_pesawat']?></td>
                    <td><?= $data['nomor_pesawat']?></td>
                    <td><?= $data['kelas']?></td>
                    <td><?= $data['jumlah_kursi']?></td>
                    <td><?= $data['nama_maskapai']?></td>
                    <td>
                      <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUbahPesawat<?= $data['id']?>">Edit</a>
                      <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusPesawat<?= $data['id']?>">Hapus</a>
                    </td>
                  </tr> 

                  <div class="modal fade modal-lg" id="modalUbahPesawat<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Pesawat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">

                      <input type="hidden" name="id" value="<?= $data['id']?>">
                        <div class="mb-3">
                          <label class="form-label">Kode Pesawat</label>
                          <input type="text" class="form-control" name="kode" value="<?= $data['kode_pesawat']?>" >
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Nama Pesawat</label>
                          <input type="text" class="form-control" name="nama" value="<?= $data['nama_pesawat']?>" >
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Nomor Pesawat</label>
                          <input type="text" class="form-control" name="nomor" value="<?= $data['nomor_pesawat']?>" >
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Kelas</label>
                          <input type="text" class="form-control" name="kelas" value="<?= $data['kelas']?>" >
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Jumlah Kursi</label>
                          <input type="text" class="form-control" name="kursi" value="<?= $data['jumlah_kursi']?>" >
                        </div>
                        <div class= "mb-3">
                          <label class="form-label">Maskapai</label>
                            <select class="form-select" name="maskapai">
                            <?php
                              $tampil_bandara = mysqli_query($koneksi, "SELECT * FROM maskapai");
                              while($data_bandara = mysqli_fetch_array($tampil_bandara)) :
                                if($data_bandara['id'] == $data['id_maskapai']){
                            ?>
                              <option value="<?= $data_bandara['id']?>" selected><?= $data_bandara['nama_maskapai']?></option>
                              <?php }else{; ?>
                                <option value="<?= $data_bandara['id']?>"><?= $data_bandara['nama_maskapai']?></option>
                              <?php }endwhile; ?>
                            </select>
                          </div>
                      </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="editPesawat" >Ubah</button> 
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                  <div class="modal fade modal-lg" id="modalHapusPesawat<?= $data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data Pesawat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Menghapus Data Pesawat?</p>
                      </div>
                        <div class="modal-footer">
                          <input type="hidden" value="<?= $data['id']?>" name="id">
                          <button type="submit" class="btn btn-danger" name="hapusPesawat" >Iya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                  <?php $no++; endwhile; ?>
                
                </table>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPesawat">
                  Tambah Pesawat
                </button>

                <!-- Awal Modal -->
                <div class="modal fade modal-lg" id="modalTambahPesawat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Pesawat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="#">
                      <div class="modal-body">

                        <div class="mb-3">
                          <label class="form-label">Kode Pesawat</label>
                          <input type="text" class="form-control" name="kode">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Nama Pesawat</label>
                          <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Nomor Pesawat</label>
                          <input type="text" class="form-control" name="nomor">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Kelas</label>
                          <input type="text" class="form-control" name="kelas">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Jumlah Kursi</label>
                          <input type="text" class="form-control" name="kursi">
                        </div>
                        <div class= "mb-3">
                          <label class="form-label">Maskapai</label>
                            <select class="form-select" name="maskapai">
                            <?php
                              $tampil_bandara = mysqli_query($koneksi, "SELECT * FROM maskapai");
                              while($data_bandara = mysqli_fetch_array($tampil_bandara)) :
                            ?>
                              <option value="<?= $data_bandara['id']?>"><?= $data_bandara['nama_maskapai']?></option>
                              <?php endwhile; ?>
                            </select>
                          </div>

                      </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="tambahPesawat" >Tambahkan</button> 
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                
                <!-- Akhir Modal -->

            </div>
        </div>
        
        <div class="card mt-3">
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>