<?php

require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo
        "<script>
            alert('user baru berhasil ditambahkan');
        </script>";
    } else {
        mysqli_error($conn);
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
</head>

<body>
    <h1>Form Registrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" id="username" name="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" id="password" name="password">
            </li>
            <li>
                <label for="password2">Konfirmasi Password :</label>
                <input type="text" id="password2" name="password2">
            </li>
            <button type="submit" name="register">Daftar</button>
        </ul>
    </form>
</body>

</html>