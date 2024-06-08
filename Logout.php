<?php
    session_start();
    session_destroy();
    echo "<script>alert('Anda Telah Keluar, Sampai Jumpa Nanti :)');</script>";
    header("Location: Home.php")
?>