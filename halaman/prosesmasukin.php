<?php
include '../koneksi.php';

if(isset($_GET['nis']) && isset($_GET['namalengkap']) && isset($_GET['kelas']) && isset($_GET['jurusan']) && isset($_GET['fotomurid'])) {
    $nis = $_GET['nis'];
    $nama = $_GET['namalengkap'];
    $kelas = $_GET['kelas'];
    $jurusan = $_GET['jurusan'];
    $foto = $_GET['fotomurid'];

    // Mendapatkan data murid dari tabel datamurid berdasarkan NIS
    $sql_select = "SELECT * FROM datamurid WHERE nis = $nis";
    $result_select = $koneksi->query($sql_select);

    if ($result_select->num_rows > 0) {
        while($row = $result_select->fetch_assoc()) {
            date_default_timezone_set('Asia/Jakarta');
            $nama_lengkap = $row['namalengkap'];
            $kelas = $row['kelas'];
            $jurusan = $row['jurusan'];
            $foto_murid = $row['fotomurid'];
            // Jika data ditemukan, masukkan ke tabel absen
            $tanggal_absen = date("Y-m-d"); // Tanggal hari ini
            $jam_absen = date("H:i:s"); // Jam saat ini

            $keterangan = 'H'; // Isi sesuai dengan kondisi (izin, sakit, dll)

            // Cek apakah sudah ada absensi untuk NIS pada tanggal yang sama
            $sql_check_absensi = "SELECT * FROM absen WHERE nis = '$nis' AND tanggalabsen = '$tanggal_absen'";
            $result_check_absensi = $koneksi->query($sql_check_absensi);

            if ($result_check_absensi->num_rows > 0) {
                echo '<center>
                <br>
                <br>
                <br>
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Profile Information</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header mx-4 p-3 text-center">
                            <div class="icon icon-shape icon-xl shadow text-center border-radius-xl">
                                <img src="../fotomurid/' . $foto_murid . '" style="border-radius: 10px;" class="w-100 position-relative">
                            </div>
                        </div>
                        <div class="card-body pt-0 p-3 text-center">
                            <h6 class="text-center mb-0">' . $nis . '</h6>
                            <span class="text-xs">' . $jurusan . '</span>
                            <hr class="horizontal dark my-2">
                            <h5 class="mb-0">' . $nama_lengkap . '</h5>
                        </div>
                        <script>
                            // Ambil nilai NIS
                            var nis = "' . $nis . '";

                            // URL untuk menghasilkan QR code dari Google Charts API
                            var qrCodeUrl = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=" + encodeURIComponent(nis);

                            // Atur gambar sumber QR code
                            document.getElementById("qrCode").src = qrCodeUrl;
                        </script>
                    </div>
                </div>
            </center>';
            } else {

            // Query untuk memasukkan data ke dalam tabel absen
            $sql_insert = "INSERT INTO absen (tanggalabsen, jamabsen, nis, namalengkap, kelas, jurusan, fotomurid, keterangan, masuk, keluar) 
                           VALUES ('$tanggal_absen', '$jam_absen', '$nis', '$nama_lengkap', '$kelas', '$jurusan', '$foto_murid', '$keterangan', 1, 0)";

            if ($koneksi->query($sql_insert) === TRUE) {
                echo '<center>
                <br>
                <br>
                <br>
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Profile Information</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header mx-4 p-3 text-center">
                            <div class="icon icon-shape icon-xl shadow text-center border-radius-xl">
                                <img src="../fotomurid/' . $foto_murid . '" style="border-radius: 10px;" class="w-100 position-relative">
                            </div>
                        </div>
                        <div class="card-body pt-0 p-3 text-center">
                            <h6 class="text-center mb-0">' . $nis . '</h6>
                            <span class="text-xs">' . $jurusan . '</span>
                            <hr class="horizontal dark my-2">
                            <h5 class="mb-0">' . $nama_lengkap . '</h5>
                        </div>
                        <script>
                            // Ambil nilai NIS
                            var nis = "' . $nis . '";

                            // URL untuk menghasilkan QR code dari Google Charts API
                            var qrCodeUrl = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=" + encodeURIComponent(nis);

                            // Atur gambar sumber QR code
                            document.getElementById("qrCode").src = qrCodeUrl;
                        </script>
                    </div>
                </div>
            </center>';
            } else {
                echo "<div class='error'>Error: " . $sql_insert . "<br>" . $koneksi->error . "</div>";
            }
        }
    }
    } else {
        echo "<div class='error'>NIS tidak di temukan</div>";
    }
} else {
    echo "<div class='error'>Data yang diperlukan tidak lengkap.</div>";
}

$koneksi->close();
?>