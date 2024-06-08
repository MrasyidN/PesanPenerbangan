<?php
    session_start();
    include("koneksi.php");

    if(isset($_POST['login'])){
        // $username = $_POST['username'];
        // $password = $_POST['password'];
        
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);

        $result = mysqli_query($koneksi, "SELECT * from user WHERE username = '$username' AND password = '$password'");
        $row = mysqli_fetch_assoc($result);

        if(is_array($row) && !empty($row)){
            $result_user = mysqli_query($koneksi, "SELECT id FROM user WHERE username = '$username' AND password = '$password'");
            $data_user = mysqli_fetch_assoc($result_user);
            $id_user = $data_user['id'];

            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['id'] = $row['id'];

            if($row['role'] == 'pembeli'){
                echo "<script>alert('Berhasil Masuk');</script>";
                echo '<script>window.location.href = "HomeSetelahLogin.php";</script>';
            }else if($row['role'] == 'admin'){
                echo "<script>alert('Selamat Datang Kembali Tuan');</script>";
                echo '<script>window.location.href = "HomeAdmin.php";</script>';
            }else if($row['role'] == 'penjual'){
                echo "<script>alert('Berhasil Masuk');</script>";
                echo '<script>window.location.href = "HomePenjual.php";</script>';
            }

        }else{
            echo "<script>alert('Username atau Password Yang Dimasukan Salah!');</script>";
            echo '<script>window.location.href = "login.php";</script>';
        }
    }
?>