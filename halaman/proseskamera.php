<?php
// Koneksi ke database (sesuaikan dengan informasi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "absensaciba";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data NIS dari request
$data = json_decode(file_get_contents('php://input'), true);
$nis = $data['nis'];

// Simpan NIS ke dalam tabel database absen
$sql = "INSERT INTO absen (nis) VALUES ('$nis')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
