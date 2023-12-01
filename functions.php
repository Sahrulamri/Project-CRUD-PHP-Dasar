<?php
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $row = [];
    while ($mhs = mysqli_fetch_assoc($result)) {
        $row[] = $mhs;
    }
    return $row;
}

function tambah($post)
{
    global $conn;
    // Ambil data dan simpan di variabel
    htmlspecialchars($nrp = $post["nrp"]);
    htmlspecialchars($nama = $post["nama"]);
    htmlspecialchars($email = $post["email"]);
    htmlspecialchars($jurusan = $post["jurusan"]);

    // Upload Gambar
    $gambar = upload();

    // Cek kalau yang dikirimkan fungsi upload itu gagal
    if (!$gambar) {
        return false;
    }
    //Inisialisasi Variabel query yang berisi insert query
    $query = "INSERT INTO mahasiswa VALUES (
            '',
            '$nrp',
            '$nama',
            '$email',
            '$jurusan',
            '$gambar'
        )";

    // Query insert data
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{
    // ambil data dari superglobal $_FILES
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apaakh tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu');
             </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // Cek apakah ekstensi gambar yang diupload ada di sini
    // Jika ekstensi yang diupload tidk ada di ekstensi gambar
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Maaf, yang Ada upload bukan gambar');
             </script>";
        return false;
    }

    // Cek Jika ukuran gambar yag diupload terlalu besar
    if ($ukuranFile > 5000000) {
        echo "<script>
                alert('Maaf, gambar yang Anda upload terlalu besar');
             </script>";
        return false;
    }

    // Lolos pengecekan maka gambar siap diupload
    // Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}


function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function update($post)
{
    global $conn;
    // Ambil data dan simpan di variabel
    $id = $post["id"];
    $nrp = htmlspecialchars($post["nrp"]);
    $nama = htmlspecialchars($post["nama"]);
    $email = htmlspecialchars($post["email"]);
    $jurusan = htmlspecialchars($post["jurusan"]);
    $gambarLama = htmlspecialchars($post["gambarLama"]);

    // Cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    //Inisialisasi Variabel query yang berisi insert query
    $query = "UPDATE mahasiswa SET
            nrp ='$nrp',
            nama ='$nama',
            email ='$email',
            jurusan ='$jurusan',
            gambar = '$gambar'
            WHERE id = $id;
        ";

    // Query insert data
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa WHERE 
        nama LIKE '%$keyword%' OR
        nrp LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'
    ";
    return query($query);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek username sudah ada atau belum

    // Queryterlebih dahulu untuk mengecek dan mengambil data dari database
    $hasil = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($hasil)) {
        echo "
        <script>
            alert('username sudah ada');
        </script>
        ";
        return false;
    }

    // Cek kofirmasi Password
    if ($password !== $password2) {
        echo "
        <script>
            alert('Kofirmasi password salah');
        </script>
        ";
        return false;
    }

    // Enkripsi password
    // password hash
    $password = password_hash($password, PASSWORD_DEFAULT);

    // md5
    //$password = md5($password);

    // Tambahkan User abru ke dadtabase

    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
