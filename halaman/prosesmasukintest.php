<?php
error_reporting(0);
include '../koneksi.php';

if (isset($_GET['nis']) && isset($_GET['namalengkap']) && isset($_GET['kelas']) && isset($_GET['jurusan']) && isset($_GET['fotomurid'])) {
    $nis = $_GET['nis'];
    $nama = $_GET['namalengkap'];
    $kelas = $_GET['kelas'];
    $jurusan = $_GET['jurusan'];
    $foto = $_GET['fotomurid'];

    // Mendapatkan data murid dari tabel datamurid berdasarkan NIS
    $sql_select = "SELECT * FROM datamurid WHERE nis = $nis";
    $result_select = $koneksi->query($sql_select);

    if ($result_select->num_rows > 0) {
        while ($row = $result_select->fetch_assoc()) {
            date_default_timezone_set('Asia/Jakarta');
            $nama_lengkap = $row['namalengkap'];
            $kelas = $row['kelas'];
            $jurusan = $row['jurusan'];
            $foto_murid = $row['fotomurid'];
            // Jika data ditemukan, masukkan ke tabel absen
            $tanggal_absen = date("Y-m-d"); // Tanggal hari ini
            $jam_absen = date("H:i:s"); // Jam saat ini

            // Query untuk mengambil rentang waktu dari tabel waktu_absen
            $sql_waktu_masuk = "SELECT mulai, selesai FROM jamabsen WHERE keterangan = 'Masuk'";
            $result_waktu_masuk = $koneksi->query($sql_waktu_masuk);

            $sql_waktu_keluar = "SELECT mulai, selesai FROM jamabsen WHERE keterangan = 'Keluar'";
            $result_waktu_keluar = $koneksi->query($sql_waktu_keluar);

            if ($result_waktu_masuk->num_rows > 0 && $result_waktu_keluar->num_rows > 0) {
                $row_waktu_masuk = $result_waktu_masuk->fetch_assoc();
                $waktu_mulai_masuk = strtotime($row_waktu_masuk['mulai']);
                $waktu_selesai_masuk = strtotime($row_waktu_masuk['selesai']);

                $row_waktu_keluar = $result_waktu_keluar->fetch_assoc();
                $waktu_mulai_keluar = strtotime($row_waktu_keluar['mulai']);
                $waktu_selesai_keluar = strtotime($row_waktu_keluar['selesai']);
            } else {
                // Handle jika tidak ada data rentang waktu masuk atau keluar yang ditemukan
                echo "Error: Tidak ada data rentang waktu masuk atau keluar ditemukan";
                exit();
            }

            // Jam absen dalam format timestamp
            $jam_absen_timestamp = strtotime($jam_absen);

            // Inisialisasi nilai awal masuk dan keluar
            $masuk = 0;
            $keluar = 0;

            // Tentukan apakah waktu absen berada dalam rentang waktu yang diizinkan untuk masuk atau keluar
            if ($jam_absen_timestamp >= $waktu_mulai_masuk && $jam_absen_timestamp <= $waktu_selesai_masuk) {
                $masuk = 1; // Jika absen dilakukan dalam rentang waktu masuk, set masuk ke 1
                $keluar = 0; // Set keluar ke 0
            } elseif ($jam_absen_timestamp >= $waktu_mulai_keluar && $jam_absen_timestamp <= $waktu_selesai_keluar) {
                $keluar = 1; // Jika absen dilakukan dalam rentang waktu keluar, set keluar ke 1
                $masuk = 0; // Set masuk ke 0
            } else {
                echo '<center>
                    <br>
                    <h3>Tidak ada rentang waktu <span class="text-danger font-weight-bolder"><i class="fas fa-exclamation opacity-10"></i></span></h3>
                    <!-- ... (remaining HTML code) ... -->
                </center>';
                // Opsional, Anda mungkin ingin keluar dari skrip di sini untuk mencegah eksekusi lebih lanjut.
                exit();
            }

            // Keterangan 0.5 jika hanya absen masuk atau absen keluar
            // Keterangan 'H' jika sudah absen masuk dan keluar
            $keterangan = ($masuk || $keluar) ? ($masuk && $keluar ? 'H' : 0.5) : '';

            // Cek apakah sudah ada absensi masuk atau keluar untuk NIS pada tanggal yang sama
            $sql_check_absensi_masuk = "SELECT * FROM absen WHERE nis = '$nis' AND tanggalabsen = '$tanggal_absen' AND masuk = 1";
            $result_check_absensi_masuk = $koneksi->query($sql_check_absensi_masuk);

            $sql_check_absensi_keluar = "SELECT * FROM absen WHERE nis = '$nis' AND tanggalabsen = '$tanggal_absen' AND keluar = 1";
            $result_check_absensi_keluar = $koneksi->query($sql_check_absensi_keluar);

            if ($result_check_absensi_masuk->num_rows > 0) {
                echo '<center>
                    <br>
                    <h3>Anda sudah absen masuk hari ini, tidak dapat absen keluar <span class="text-warning font-weight-bolder"><i class="fas fa-exclamation-triangle opacity-10"></i></span></h3>
                    <!-- ... (remaining HTML code) ... -->
                </center>';
            } elseif ($result_check_absensi_keluar->num_rows > 0) {
                echo '<center>
                    <br>
                    <h3>Anda sudah absen keluar hari ini, tidak dapat absen masuk <span class="text-warning font-weight-bolder"><i class="fas fa-exclamation-triangle opacity-10"></i></span></h3>
                    <!-- ... (remaining HTML code) ... -->
                </center>';
            } else {
                // Query untuk memasukkan data ke dalam tabel absen
                $sql_insert = "INSERT INTO absen (tanggalabsen, jamabsen, nis, namalengkap, kelas, jurusan, fotomurid, keterangan, masuk, keluar) 
                               VALUES ('$tanggal_absen', '$jam_absen', '$nis', '$nama_lengkap', '$kelas', '$jurusan', '$foto_murid', '$keterangan', $masuk, $keluar)";

                if ($koneksi->query($sql_insert) === TRUE) {
                    if ($masuk) {
                        echo '<center>
                            <br>
                            <h3>Berhasil Absen Masuk <span class="text-success font-weight-bolder"><i class="fas fa-check opacity-10"></i></span></h3>
                            <!-- ... (remaining HTML code) ... -->
                        </center>';
                    } elseif ($keluar) {
                        echo '<center>
                            <br>
                            <h3>Berhasil Absen Keluar <span class="text-success font-weight-bolder"><i class="fas fa-check opacity-10"></i></span></h3>
                            <!-- ... (remaining HTML code) ... -->
                        </center>';
                    }
                } else {
                    echo "<div class='error'>Error: " . $sql_insert . "<br>" . $koneksi->error . "</div>";
                }
            }
        }
    }
} else {
    echo "<div class='error'>Data yang diperlukan tidak lengkap.</div>";
}

$koneksi->close();
?>