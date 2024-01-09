<style>
  .success {
    color: green;
    animation: fadeIn 2s ease-out;
  }

  .error {
    color: red;
    animation: fadeIn 2s ease-out;
  }

  .info {
    color: yellow;
    animation: fadeIn 2s ease-out;
  }

  /* Style untuk ikon centang */
  .success::before {
    content: '\2713'; /* kode karakter unicode untuk centang */
    font-family: 'Arial', sans-serif;
    margin-right: 5px;
  }

  /* Style untuk ikon silang */
  .error::before {
    content: '\2717'; /* kode karakter unicode untuk silang */
    font-family: 'Arial', sans-serif;
    margin-right: 5px;
  }

  /* Style untuk ikon segitiga kuning */
  .info::before {
    content: '\25B6'; /* kode karakter unicode untuk segitiga */
    font-family: 'Arial', sans-serif;
    margin-right: 5px;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
</style>



<?php

include '../koneksi.php';

// Add content type and encoding header
header('Content-Type: text/html; charset=utf-8');

if(isset($_GET['nis']) && isset($_GET['namalengkap']) && isset($_GET['kelas']) && isset($_GET['jurusan'])) {
    $nis = $_GET['nis'];

    // Validate NIS length
    if(strlen($nis) !== 8 || !is_numeric($nis)) {
        echo "Data yang di Scan Tidak Valid";
        exit; // Stop execution if NIS is not valid
    }

    $nama = $_GET['namalengkap'];
    $kelas = $_GET['kelas'];
    $jurusan = $_GET['jurusan'];

    // Set database connection character set to utf8
    $koneksi->set_charset("utf8");


    // Mendapatkan data murid dari tabel datamurid berdasarkan NIS
    $sql_select = "SELECT * FROM datamurid WHERE nis = ?";
    $stmt = $koneksi->prepare($sql_select);
    $stmt->bind_param("s", $nis); // Assuming nis is a string, adjust the type accordingly
    $stmt->execute();
    $result_select = $stmt->get_result();

    if ($result_select->num_rows > 0) {
        while($row = $result_select->fetch_assoc()) {
            date_default_timezone_set('Asia/Jakarta');
            $nama_lengkap = $row['namalengkap'];
            $kelas = $row['kelas'];
            $jurusan = $row['jurusan'];
            // Jika data ditemukan, masukkan ke tabel absen
            $tanggal_absen = date("Y-m-d"); // Tanggal hari ini
            $jam_absen = date("H:i:s"); // Jam saat ini

            $keterangan = 'H'; // Isi sesuai dengan kondisi (izin, sakit, dll)

            // Cek apakah sudah ada absensi untuk NIS pada tanggal yang sama
            $sql_check_absensi = "SELECT * FROM absen WHERE nis = '$nis' AND tanggalabsen = '$tanggal_absen'";
            $result_check_absensi = $koneksi->query($sql_check_absensi);

            if ($result_check_absensi->num_rows > 0) {
                echo "<div class='info'>Murid dengan NIS $nis sudah melakukan absensi hari ini.</div>";
            } else {

            // Query untuk memasukkan data ke dalam tabel absen
            $sql_insert = "INSERT INTO absen (tanggalabsen, jamabsen, nis, namalengkap, kelas, jurusan, keterangan, masuk, keluar) 
                           VALUES ('$tanggal_absen', '$jam_absen', '$nis', '$nama_lengkap', '$kelas', '$jurusan', '$keterangan', 1, 0)";

            if ($koneksi->query($sql_insert) === TRUE) {
                echo "<div class='success'>Data absensi berhasil dimasukkan.</div>";
            } else {
                echo "<div class='error'>Error: " . $sql_insert . "<br>" . $koneksi->error . "</div>";
            }
        }
    }
    } else {
        echo "<div class='error'>Data tidak ditemukan untuk NIS: " . $nis . "</div>";
    }
} else {
    echo "<div class='error'>Data yang diperlukan tidak lengkap.</div>";
}

$koneksi->close();
?>
