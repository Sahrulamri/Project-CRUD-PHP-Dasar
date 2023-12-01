<?php
session_start();
require 'functions.php';
//Cek Cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // Ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // Cek username dan cookie
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}


if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}



if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek apakah username ada di database
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            // Set Session
            $_SESSION["login"] = true;
            // Cek Remember me
            if (isset($_POST['remember'])) {
                // Buat cookie
                setcookie('id', $row['id'], time() + 120);
                setcookie('key', hash('sha256', $row['username']), time() + 120);
            }


            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>

<body>
    <h1>Form Login</h1>
    <?php if (isset($error)) : ?>
        <p style="color: red; font-style:italic;">Username / Password Anda Salah !</p>
    <?php endif; ?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" id="username" name="username" autocomplete="off">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" id="password" name="password">
            </li>
            <li>
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </li>
            <button type="submit" name="login">Login</button>
        </ul>
    </form>
</body>

</html>