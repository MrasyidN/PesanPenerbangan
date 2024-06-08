<?php
    session_start();

    include ("koneksi.php");

    if (!isset($_SESSION['id'])) {
        header("location: Home.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Penerbangan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Profil</title>
    <style>
              body {
    font-family: 'Poppins', sans-serif;
    background-color: white;
    background-image: url('img/Gambar_Pesawat6.jpg');
    background-size: cover;
    margin: 0;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-top: 100px; /* Sesuaikan margin-top sesuai kebutuhan Anda */
}

.container {
    background-color: rgba(255, 255, 255, 0.2); /* Warna putih dengan tingkat transparansi */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    padding: 20px;
    margin-bottom:100px;
    width: 300px;
    text-align: center;
    position: relative;
    backdrop-filter: blur(10px); /* Efek blur dengan nilai piksel */
        }

/* Tambahan */
.profile-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    margin-bottom: 20px;
}

.password-container {
    margin-top: 10px; /* Sesuaikan margin-top sesuai kebutuhan Anda */
}

.logout-button {
    margin-top: 10px; /* Sesuaikan margin-top sesuai kebutuhan Anda */
}


        h1 {
            font-family: 'Expletus Sans'; 
        }

        h2 {
            font-family: 'sans-serif'; 
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


        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 4px solid #3498db;
        }

        form {
    display: relatie;
    flex-direction: column;
    align-items: flex-start;
}

label {
    margin-bottom: 5px; /* Sesuaikan margin-bottom sesuai kebutuhan Anda */
}


        .profile-details {
            text-align: center;
            max-width: 300px;
        }

        .profile-details h2 {
            margin-bottom: 8px;
            color: #3498db;
        }

        .profile-details p {
            margin-bottom: 20px;
            color: #777;
        }

        .status-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .status-box {
            flex: 1;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 0 10px;
            text-align: center;
        }

        .status-icon {
            font-size: 32px;
            margin-bottom: 10px;
            color: #3498db;
        }

        .status-box h3 {
            margin-bottom: 8px;
            color: #3498db;
        }

        .status-box p {
            color: #777;
        }

        .logout-button {
            background-color: #e74c3c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .logout-button:hover {
            background-color: #c0392b;
        }

        footer {
            background-color: #00558e;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
</head>

<body>

   

    <nav>
        <div>
            <a href="HomeSetelahLogin.php">Jadwal Penerbangan</a>
            <a href="PesanTiket.php">Pesan Tiket</a>
            <a href="PesananSaya.php">Pesanan Saya</a>
        </div>
        <div class="auth-links" style="display: flex; align-items:center">
            <?php
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id = $id");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_username = $result['username'];
                    $res_email = $result['email'];
                    $res_id = $result['id'];
                    $res_password = $result['password'];
                }

                echo "<a href='Profile.php?id=$res_id'>Hallo $res_username</a> ";
            }else{
                header("location: Home.php");
            }
            ?>
            <i class="fas fa-user-circle"></i>
            
            <a href="Logout.php">Log Out</a>
        </div>
    </nav>

    <div class="container">
        <h1>Ubah Profile</h1>
        <?php
            if(isset($_POST['ubah'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $id =$_SESSION['id'];

                $edit = mysqli_query($koneksi, "update user set username='$username', email = '$email', password = '$password' where id = '$id'");

                if($edit){
                    echo "<script>alert('Profile Diubah');</script>";
                    echo '<script>window.location.href = "Profile.php";</script>';
                }
            }else{
                $id =$_SESSION['id'];
                $query = mysqli_query($koneksi, "select * from user where id = '$id'");

                while ($result = mysqli_fetch_assoc($query)){
                    $res_username = $result['username'];
                    $res_email = $result['email'];
                    $res_password = $result['password'];
                }
            
        ?>
        <!-- Profil -->
        <div class="profile-container">
            <img class="profile-image" src="IMG/user.png" alt="Profile Image">
            <div class="profile-details">
            </div>
        </div>

        <!-- Status -->
        <form method="POST" action="" style="text-align: center;">
    <label for="email">Email:</label><br/>
    <input type="email" id="email" name="email" value="<?php echo $res_email; ?>">
    <br>
    <label for="username">Username:</label><br/>
    <input type="text" id="username" name="username" value="<?php echo $res_username; ?>">
    <br>
    <div class="password-container" style="margin: auto; width: fit-content;">
        <label for="password">Password:</label><br/>
        
        <input type="password" id="password" name="password" value="<?php echo $res_password; ?>">
        <br>
    </div>
    <br>

    <button type="submit" name="ubah" class="logout-button" style="background-color: #3498db;">Ubah</button>
</form>



    </div>
        <?php } ?>

        <footer>
    &copy; UPI.Com Layanan Penerbangan
</footer>
</body>

</html>
