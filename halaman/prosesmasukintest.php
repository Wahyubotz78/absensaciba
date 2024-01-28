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
        $row = $result_select->fetch_assoc();
        date_default_timezone_set('Asia/Jakarta');
        $nama_lengkap = $row['namalengkap'];
        $kelas = $row['kelas'];
        $jurusan = $row['jurusan'];
        $foto_murid = $row['fotomurid'];

        // Jika data ditemukan, masukkan ke tabel absen
        $tanggal_absen = date("Y-m-d"); // Tanggal hari ini
        $jam_absen = date("H:i:s"); // Jam saat ini

        // Set waktu rentang absen masuk dan absen keluar
        $waktu_masuk_start = '';
        $waktu_masuk_end = '';
        $waktu_keluar_start = '';
        $waktu_keluar_end = '';

        // Cek apakah sudah ada absensi untuk NIS pada tanggal yang sama
        $sql_check_absensi = "SELECT * FROM absen WHERE nis = '$nis' AND tanggalabsen = '$tanggal_absen'";
        $result_check_absensi = $koneksi->query($sql_check_absensi);

        // Check if the student has already absented for the day
if ($result_check_absensi->num_rows > 0) {
    $row_absen = $result_check_absensi->fetch_assoc();

    // If the student has already absented masuk
    if ($row_absen['masuk'] == 1) {
        // If the student has already absented keluar
        if ($row_absen['keluar'] == 1) {
            // Both absen masuk and keluar are recorded
            $keterangan = 'Hadir';
            echo '<center>
            <br>
            <h3>Anda Sudah Absen Masuk dan Keluar Hari Ini <span class="text-warning font-weight-bolder"><i class="fas fa-exclamation-triangle opacity-10"></i></span></h3>
            <div class="col-12 col-lg-6">
                <div class="card-baru h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Data Murid</h6>
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
            // Only absen masuk is recorded, check if it's time to absen keluar
            if ($row_absen['keluar'] == 0) {
                $sql_jam_keluar = "SELECT mulai, selesai FROM jamabsen WHERE keterangan = 'Keluar'";
                $result_jam_keluar = $koneksi->query($sql_jam_keluar);

                if ($result_jam_keluar->num_rows > 0) {
                    $row_jam_keluar = $result_jam_keluar->fetch_assoc();
                    $waktu_keluar_start = $row_jam_keluar['mulai'];
                    $waktu_keluar_end = $row_jam_keluar['selesai'];

                    if (isWithinTimeRange($jam_absen, $waktu_keluar_start, $waktu_keluar_end)) {
                        // It's time to absen keluar
                        $keterangan = 'Hadir';
                        $masuk = 1;
                        $keluar = 1;

                        // Update absensi for keluar
                        $sql_update = "UPDATE absen SET keterangan = '$keterangan', masuk = $masuk, keluar = $keluar WHERE nis = '$nis' AND tanggalabsen = '$tanggal_absen'";
                        $koneksi->query($sql_update);

                        echo '<center>
                        <br>
                        <h3>Berhasil Absen Keluar <span class="text-success font-weight-bolder"><i class="fas fa-check opacity-10"></i></span></h3>
                        <div class="col-12 col-lg-6">
                            <div class="card-baru h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Data Murid</h6>
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
                    // masuk            
                    }
                }
            }
        }
    } else {
        // Student hasn't absented masuk yet, display appropriate message
        echo '<center>
            <br>
            <h3>Tidak Sesuai Waktu Absen Masuk <span class="text-danger font-weight-bolder"><i class="fas fa-times opacity-10"></i></span></h3>
            <!-- Rest of the HTML code for displaying student information -->
            </center>';
    }
} else {
    // Belum absen, lanjutkan proses absen masuk atau keluar
    $sql_jam_masuk = "SELECT mulai, selesai FROM jamabsen WHERE keterangan = 'Masuk'";
            $result_jam_masuk = $koneksi->query($sql_jam_masuk);

            if ($result_jam_masuk->num_rows > 0) {
                $row_jam_masuk = $result_jam_masuk->fetch_assoc();
                $waktu_masuk_start = $row_jam_masuk['mulai'];
                $waktu_masuk_end = $row_jam_masuk['selesai'];

                if (isWithinTimeRange($jam_absen, $waktu_masuk_start, $waktu_masuk_end)) {
                    // Waktu absen masuk
                    $keterangan = '0.5';
                    $masuk = 1;
                    $keluar = 0;

                    // Insert data into the database
                    $sql_insert = "INSERT INTO absen (tanggalabsen, jamabsen, nis, namalengkap, kelas, jurusan, fotomurid, keterangan, masuk, keluar) 
                               VALUES ('$tanggal_absen', '$jam_absen', '$nis', '$nama_lengkap', '$kelas', '$jurusan', '$foto_murid', '$keterangan', $masuk, $keluar)";

                    if ($koneksi->query($sql_insert) === TRUE) {
                        echo '<center>
                        <br>
                        <h3>Berhasil Absen Masuk <span class="text-success font-weight-bolder"><i class="fas fa-check opacity-10"></i></span></h3>
                        <div class="col-12 col-lg-6">
                            <div class="card-baru h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Data Murid</h6>
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

            $sql_jam_keluar = "SELECT mulai, selesai FROM jamabsen WHERE keterangan = 'Keluar'";
            $result_jam_keluar = $koneksi->query($sql_jam_keluar);

            if ($result_jam_keluar->num_rows > 0) {
                $row_jam_keluar = $result_jam_keluar->fetch_assoc();
                $waktu_keluar_start = $row_jam_keluar['mulai'];
                $waktu_keluar_end = $row_jam_keluar['selesai'];

                if (isWithinTimeRange($jam_absen, $waktu_keluar_start, $waktu_keluar_end)) {
                    // Waktu absen keluar
                    $keterangan = '0.5';
                    $masuk = 0;
                    $keluar = 1;

                    // Insert data into the database
                    $sql_insert = "INSERT INTO absen (tanggalabsen, jamabsen, nis, namalengkap, kelas, jurusan, fotomurid, keterangan, masuk, keluar) 
                               VALUES ('$tanggal_absen', '$jam_absen', '$nis', '$nama_lengkap', '$kelas', '$jurusan', '$foto_murid', '$keterangan', $masuk, $keluar)";

                    if ($koneksi->query($sql_insert) === TRUE) {
                        echo '<center>
                        <br>
                        <h3>Berhasil Absen Keluar <span class="text-success font-weight-bolder"><i class="fas fa-check opacity-10"></i></span></h3>
                        <div class="col-12 col-lg-6">
                            <div class="card-baru h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Data Murid</h6>
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

            // Diluar waktu absen
            elseif ($keterangan != 'Tidak Sesuai Waktu Absen') {
                echo '<center>
                        <br>
                        <h3>' . $keterangan . ' <span class="text-danger font-weight-bolder"><i class="fas fa-times opacity-10"></i></span></h3>
                        <div class="col-12 col-lg-6">
                            <div class="card-baru h-100">
                                <!-- Tampilkan data murid -->
                            </div>
                        </div>
                    </center>';
            }
        }
    } else {
        echo "<div class='error'>Data yang diperlukan tidak lengkap.</div>";
    }
}

$koneksi->close();

function isWithinTimeRange($time, $start, $end)
{
    $time = strtotime($time);
    $start = strtotime($start);
    $end = strtotime($end);

    return ($time >= $start && $time <= $end);
}
?>
