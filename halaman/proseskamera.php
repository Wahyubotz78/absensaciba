<?php
// Pastikan untuk mengatur informasi koneksi database Anda
include '../koneksi.php';

// Mendapatkan data dari NIS yang di-scan (misalnya, disimpan dalam variabel $_GET atau $_POST)
if(isset($_GET['nis'])) {
    $nis = $_GET['nis'];

    // Membuat query untuk mengambil data dari tabel datamurid berdasarkan NIS
    $sql = "SELECT * FROM datamurid WHERE nis = '$nis'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        // Output data dari setiap baris
        while($row = $result->fetch_assoc()) {
            echo "";
        }
    } else {
        echo "Data yang di Scan Tidak Valid";
    }
} else {
    echo "NIS tidak tersedia.";
}

$koneksi->close();
?>