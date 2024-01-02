<?php
include 'koneksi.php';
session_start();
 
if (isset($_SESSION['nis'])) {
    header("Location: halaman/beranda");
    exit();
}
 
if (isset($_POST['submit'])) {
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
 
    $sql = "SELECT * FROM datamurid WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $sql);
 
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['nis'] = $row['nis'];
        $_SESSION['jurusan'] = $row['jurusan'];
        header("Location: halaman/beranda");
        exit();
    } else {
        echo "<script>alert('NIS Anda Salah Mohon Coba Lagi!!')</script>";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Absen Saciba</title>
</head>
<body>
    <center>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="masukkan nis" name="nis" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Masuk</button>
            </div>
        </form>
    </div></center>
</body>
</html>