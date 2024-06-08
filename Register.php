<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Layanan Penerbangan</title>
    <style>
         body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('img/Gambar_Pesawat2.jpg'); /* Tambahkan URL gambar sesuai lokasi file */
            background-size: cover;
            background-position: center;
        }


        .register-container {
    background-color: rgba(255, 255, 255, 0.2); /* Warna putih dengan tingkat transparansi */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 300px;
    text-align: center;
    position: relative;
    backdrop-filter: blur(10px); /* Efek blur dengan nilai piksel */
}

.register-container h2 {
    color: #333; /* Warna teks */
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    text-align: left;
    color: #333; /* Warna teks label */
}


        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .password-container, .confirm-password-container {
            position: relative;
        }

        .password-icon, .confirm-password-icon {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 16px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

            .sign-in-button {
    position: absolute;
    top: 10px;
    right: -120px;
    background-color: transparent;
    color: white; /* Ubah warna teks menjadi putih */
    border: none;
    cursor: pointer;
}

   
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
</head>
<body>

    <div class="register-container">
        <h2>Register</h2>
        <form method="POST" action="Register_post.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username">

            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" id="password" name="password">
                <img class="password-icon" src="https://img.icons8.com/ios-filled/20/000000/visible.png" alt="Toggle Password Visibility">
            </div>

            <label for="confirm-password">Confirm Password:</label>
            <div class="confirm-password-container">
                <input type="password" id="confirm-password" name="confirm-password">
                <img class="confirm-password-icon" src="https://img.icons8.com/ios-filled/20/000000/visible.png" alt="Toggle Password Visibility">
            </div>

            <button type="submit" name="register">Register</button>

            <!-- Tombol Sign In -->
        </form>
        <a href="Login.php"><button class="sign-in-button" onclick="redirectToSignIn()">Login</button></a>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm-password');
        const passwordIcon = document.querySelector('.password-icon');
        const confirmPasswordIcon = document.querySelector('.confirm-password-icon');

        passwordIcon.addEventListener('click', togglePasswordVisibility.bind(null, passwordInput, passwordIcon));
        confirmPasswordIcon.addEventListener('click', togglePasswordVisibility.bind(null, confirmPasswordInput, confirmPasswordIcon));

        function togglePasswordVisibility(input, icon) {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);

            // Toggle icon based on password visibility
            if (type === 'password') {
                icon.src = 'https://img.icons8.com/ios-filled/20/000000/visible.png';
            } else {
                icon.src = 'https://img.icons8.com/ios-filled/20/000000/invisible.png';
            }
        }

    </script>

</body>
</html>
