<?php

session_start();

include("koneksi.php");
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
                  <a class="nav-link active" aria-current="page" href="#">Jadwal Penerbangan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="KotakMasukPenjual.php">Kotak Masuk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="Logout.php">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <div class="mt-3">
      <div class="mt-3">
      <h3 class="text-center">selamat datang di pelayanan upi.com</h3>
      </div>

        <div class="card mt-3">
          <div class="card-header bg-primary text-white">
            Jadwal Yang Telah Dibuat
          </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                  <tr>
                    <th>No</th>
                    <th>Waktu Penerbangan</th>
                    <th>Kode Pesawat - Nama Maskapai</th>
                    <th>Kota Asal - Kota Tujuan</th>
                    <th>Harga Tiket</th>
                    <th>Status</th>
                    <th>Pengajuan</th>
                  </tr>

                  <?php
                  $no = 1;
                  $tampil_all = mysqli_query($koneksi, "SELECT jadwal.id, jadwal.waktu_penerbangan, jadwal.status, 
                            pesawat.kode_pesawat, maskapai.nama_maskapai, bandara_asal.alamat as nama_bandara_asal, 
                            bandara_tujuan.alamat as nama_bandara_tujuan, pesawat.id as id_pesawat, harga
                            FROM jadwal 
                            JOIN pesawat ON jadwal.id_pesawat = pesawat.id 
                            JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id 
                            JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id 
                            JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id where jadwal.id_user = $_SESSION[id]");
                  while($data_all = mysqli_fetch_array($tampil_all)) : 
                  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no?></td>
                    <td><?= $data_all['waktu_penerbangan']?></td>
                    <td><?= $data_all['kode_pesawat']?> - <?= $data_all['nama_maskapai']?></td>
                    <td><?= $data_all['nama_bandara_asal']?> - <?= $data_all['nama_bandara_tujuan']?></td>
                    <td><?= $data_all['harga']?></td>
                    <td><?= $data_all['status']?></td>
                    <td>
                      <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $data_all['id']?>">Edit</a>
                      <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                  </tr> 
                  <?php
                    $tampil_edit = mysqli_query($koneksi, "SELECT jadwal.id, jadwal.      waktu_penerbangan, jadwal.status,id_bandara_asal, id_bandara_tujuan,
                              pesawat.kode_pesawat, maskapai.nama_maskapai, bandara_asal.nama_bandara as nama_bandara_asal, 
                              bandara_tujuan.nama_bandara as nama_bandara_tujuan, pesawat.id as id_pesawat, harga
                              FROM jadwal 
                              JOIN pesawat ON jadwal.id_pesawat = pesawat.id 
                              JOIN maskapai ON jadwal.id_pesawat_maskapai = maskapai.id 
                              JOIN bandara AS bandara_asal ON jadwal.id_bandara_asal = bandara_asal.id 
                              JOIN bandara AS bandara_tujuan ON jadwal.id_bandara_tujuan = bandara_tujuan.id;");

                    while($data_edit = mysqli_fetch_array($tampil_edit)) : 
  
                    ?>
  
                  <!-- Awal Modal -->
                  <div class="modal fade modal-lg" id="modalEdit<?= $data_edit['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Jadwal</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <form method="POST" action="#">
                        <div class="modal-body">
  
                          <div class="mb-3">
                            <label class="form-label">Waktu Penerbangan</label>
                            <input type="datetime-local" class="form-control" name="waktu" value="<?= $data_edit['waktu_penerbangan']?>">
                          </div>
  
                          <div class="mb-3">
                            <label class="form-label">Kode Pesawat - Maskapai</label>
                            <select class="form-select" name="pesawat">
                              <?php
                                // $tampil = mysqli_query($koneksi, "SELECT id, kode_pesawat, id_maskapai FROM pesawat");
                                // while($data = mysqli_fetch_array($tampil)) : 
                                $tampil_maskapai = mysqli_query($koneksi, "SELECT id, nama_maskapai FROM maskapai");
                                while($maskapai = mysqli_fetch_array($tampil_maskapai)) :
                              ?>
                                <?php 
                                  $tampil_pesawat = mysqli_query($koneksi, "SELECT id, kode_pesawat, id_maskapai FROM pesawat") ;
                                  while($pesawat = mysqli_fetch_array($tampil_pesawat)) :
                                    if($pesawat['id_maskapai'] == $maskapai['id']){
                                      if($pesawat['id'] == $data_edit['id_pesawat']){
                                ?>
                                  <option value="<?= $pesawat['id']?>" selected><?= $pesawat['kode_pesawat']?> - <?= $maskapai['nama_maskapai']?></option>
                                  <?php }else{?>
                                  <option value="<?= $pesawat['id']?>"><?= $pesawat['kode_pesawat']?> - <?= $maskapai['nama_maskapai']?></option>
                                <?php }}endwhile;?>
                              <?php endwhile; ?>
                            </select>
                            <input type="hidden" value="<?= $pesawat['id_maskapai']?>" name="maskapai">        
                          </div>
  
                          <div class= "mb-3">
                          <label class="form-label">Bandara Asal</label>
                            <select class="form-select" name="asal">
                              
                            <?php
                              $tampil_bandara = mysqli_query($koneksi, "SELECT * FROM bandara");
                              while($data_bandara = mysqli_fetch_array($tampil_bandara)) : 
                                if($data_bandara['id'] == $data_edit['id_bandara_asal']){
                            ?>
                              <option value="<?= $data_bandara['id']?>" selected><?= $data_bandara['nama_bandara']?> &ensp;|&ensp; <?= $data_bandara['alamat']?></option>
                              <?php }else{ ?>
                              <option value="<?= $data_bandara['id']?>"><?= $data_bandara['nama_bandara']?> &ensp;|&ensp; <?= $data_bandara['alamat']?></option>
                              <?php } endwhile; ?>
                            </select>
                          </div>
  
                          <div class= "mb-3">
                          <label class="form-label">Bandara tujuan</label>
                            <select class="form-select" name="tujuan">
                              <?php
                              $tampil = mysqli_query($koneksi, "SELECT * FROM bandara");
                              while($data_bandara = mysqli_fetch_array($tampil)) : 
                                if($data_bandara['id'] == $data_edit['id_bandara_tujuan']){
                                  ?>
                                    <option value="<?= $data_bandara['id']?>" selected><?= $data_bandara['nama_bandara']?> &ensp;|&ensp; <?= $data_bandara['alamat']?></option>
                                    <?php }else{ ?>
                              
                              <option value="<?= $data_bandara['id']?>"><?= $data_bandara['nama_bandara']?> &ensp;|&ensp; <?= $data_bandara['alamat']?></option>
                              <?php }endwhile; ?>
                            </select>
                          </div>
                          
                          <div class="mb-3">
                            <label class="form-label">Harga Tiket</label>
                            <input class="form-control" type="text" name="harga" value="<?= $data_edit['harga']?>">
                          </div>
  
                        </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="tambah" >Tambah</button> 
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  

                  <?php endwhile; ?>

                  <!-- Akhir Modal -->
  
                  <?php $no++; endwhile; ?>
                </table>
                
                
                <!-- Button trigger modal tambah jadwal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                  Tambah Jadwal
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah jadwal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form method="POST" action="tambah_post.php">
                      <div class="modal-body">

                        <div class="mb-3">
                          <label class="form-label">jadwal penerbangan</label>
                          <input type="datetime-local" class="form-control" name="waktu" placeholder="jadwal penerabngan">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Kode Pesawat - Maskapai</label>
                          <select class="form-select" name="pesawat">
                            <?php
                              // $tampil = mysqli_query($koneksi, "SELECT id, kode_pesawat, id_maskapai FROM pesawat");
                              // while($data = mysqli_fetch_array($tampil)) : 
                              $tampil_maskapai = mysqli_query($koneksi, "SELECT id, nama_maskapai FROM maskapai");
                              while($maskapai = mysqli_fetch_array($tampil_maskapai)) :
                            ?>
                              <?php 
                                $tampil_pesawat = mysqli_query($koneksi, "SELECT id, kode_pesawat, id_maskapai FROM pesawat") ;
                                while($pesawat = mysqli_fetch_array($tampil_pesawat)) :
                                  if($pesawat['id_maskapai'] == $maskapai['id']){
                              ?>
                                <option value="<?= $pesawat['id']?>"><?= $pesawat['kode_pesawat']?> - <?= $maskapai['nama_maskapai']?></option>
                              <?php }endwhile;?>
                            <?php endwhile; ?>
                          </select>
                          <input type="hidden" value="<?= $pesawat['id_maskapai']?>" name="maskapai">        
                        </div>

                        <div class= "mb-3">
                        <label class="form-label">Bandara Asal</label>
                          <select class="form-select" name="asal">
                            
                          <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM bandara");
                            while($data = mysqli_fetch_array($tampil)) : 
                          ?>
                            <option value="<?= $data['id']?>"><?= $data['nama_bandara']?> &ensp;|&ensp; <?= $data['alamat']?></option>
                            <?php endwhile; ?>
                          </select>
                        </div>

                        <div class= "mb-3">
                        <label class="form-label">Bandara tujuan</label>
                          <select class="form-select" name="tujuan">
                            <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM bandara");
                            while($data = mysqli_fetch_array($tampil)) : 
                          ?>
                            <option value="<?= $data['id']?>"><?= $data['nama_bandara']?> &ensp;|&ensp; <?= $data['alamat']?></option>
                            <?php endwhile; ?>
                          </select>
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label">Harga Tiket</label>
                          <input class="form-control" type="text" name="harga">
                        </div>

                      </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" name="tambah" >Tambah</button> 
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
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>