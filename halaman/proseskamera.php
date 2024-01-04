<?php
// Lakukan koneksi ke database
include '../koneksi.php';;

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Tangkap hasil QR code dari permintaan POST
$hasil_qr = $_POST['hasil_qr'];

// Lakukan sanitasi data sebelum dimasukkan ke dalam database
$hasil_qr = $koneksi->real_escape_string($hasil_qr);

// Lakukan query untuk memasukkan hasil QR code ke dalam database
$query = "INSERT INTO absen (hasil_qr) VALUES ('$hasil_qr')";

if ($koneksi->query($query) === TRUE) {
    http_response_code(200); // Berhasil
} else {
    http_response_code(500); // Gagal
}

// Tutup koneksi ke database
$koneksi->close();
?>
