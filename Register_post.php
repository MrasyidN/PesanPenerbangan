<?php
    include "koneksi.php";

    if(isset($_POST['register'])){
        $verify = mysqli_query($koneksi, "select email from user where email = '$_POST[email]'");

        if(mysqli_num_rows($verify) != 0){
            echo "<script>alert('This email is already taken. Please try another email');</script>";
            echo '<script>window.location.href = "Register.php";</script>';
        }else{
            $simpan = mysqli_query($koneksi, "insert into user (username, password, email, role) values ('$_POST[username]', '$_POST[password]', '$_POST[email]', 'pembeli')");
            echo "<script>alert('Berhasil Mendaftar');</script>";
            echo '<script>window.location.href = "Login.php";</script>';
        }
    }
?>