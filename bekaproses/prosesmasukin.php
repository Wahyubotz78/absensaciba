<?php
include '../koneksi.php';

if(isset($_GET['nis']) && isset($_GET['namalengkap']) && isset($_GET['kelas']) && isset($_GET['jurusan'])) {
    $nis = $_GET['nis'];
    $nama = $_GET['namalengkap'];
    $kelas = $_GET['kelas'];
    $jurusan = $_GET['jurusan'];

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
                echo "Murid dengan NIS $nis sudah melakukan absensi hari ini.";
            } else {

            // Query untuk memasukkan data ke dalam tabel absen
            $sql_insert = "INSERT INTO absen (tanggalabsen, jamabsen, nis, namalengkap, kelas, jurusan, keterangan, masuk, keluar) 
                           VALUES ('$tanggal_absen', '$jam_absen', '$nis', '$nama_lengkap', '$kelas', '$jurusan', '$keterangan', 1, 0)";

            if ($koneksi->query($sql_insert) === TRUE) {
                echo "Data absensi berhasil dimasukkan.";
            } else {
                echo "Error: " . $sql_insert . "<br>" . $koneksi->error;
            }
        }
    }
    } else {
        echo "Data tidak ditemukan untuk NIS: " . $nis;
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}

$koneksi->close();
?>
