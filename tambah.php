<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";

// Apakah Tombol submit sudah dipencet atau belum
if (isset($_POST["submit"])) {
    // Cek apakah ada data dalam dolar post
    //var_dump($_POST);



    //Cek apakah data berhasil ditambahkan
    //var_dump(mysqli_affected_rows($conn));
    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center">Tambah Data Mahasiswa</h1>
    <div class="container">
        <div class="form-group" style="text-align:right;">
            <button class="btn btn-success btn-md float-right">
                <a class="text-decoration-none text-white" href="index.php">Kembali Ke Beranda</a>
            </button>
        </div>



        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nrp" class="form-label">NRP :</label>
                <input type="text" class="form-control" id="nrp" name="nrp" required>

            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama :</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan :</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar :</label>
                <input type="file" class="form-control" id="gambar" name="gambar" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

</body>

</html>