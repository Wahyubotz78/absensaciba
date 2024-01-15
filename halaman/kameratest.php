<?php
      session_start();
      // Tempatkan baris-baris lainnya yang ingin dijalankan di sini
      // Aktifkan semua jenis kesalahan
      error_reporting(E_ALL);
      // Tampilkan pesan kesalahan ke layar
      ini_set('display_errors', 1);

// Periksa apakah sesi pengguna ada atau tidak
if (!isset($_SESSION['nis'])) {
    // Jika tidak ada sesi pengguna, alihkan ke halaman login
    header("Location: login");
    exit(); // Pastikan untuk menghentikan eksekusi skrip setelah pengalihan header
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Scan QR</title>
  <style>

    /* Menangani tampilan hp */
    @media only screen and (max-width: 600px) {
      .br-mobile {
        display: block; /* Munculkan <br> pada tampilan mobile */
      }
    }

    /* Sembunyikan <br> pada tampilan selain mobile */
    @media only screen and (min-width: 601px) {
      .br-mobile {
        display: none;
      }
    }

    #video {
      width: 100%;
      height: auto;
      border-radius: 10px;
    }
    #result {
      margin-left: 80px; /* Contoh jarak antara kamera dan hasil */
      font-weight: bold;
      font-size: 90px; /* Contoh ukuran font yang diperbesar */
    }

    .center-container {
    display: flex;
    align-items: center;
    justify-content: center;
    }

    .center-text {
      text-align: center;
    }
  </style>




  <?php include('link.php'); ?>
</head>

<body class="g-sidenav-show bg-gray-100">

  <?php
  $userAgent = $_SERVER['HTTP_USER_AGENT'];
  $isMobile = false;

  $mobileKeywords = ['Android', 'iPhone', 'iPad', 'Windows Phone', 'BlackBerry', 'Opera Mini', 'Mobile', 'Tablet'];

  foreach ($mobileKeywords as $keyword) {
    if (stripos($userAgent, $keyword) !== false) {
      $isMobile = true;
      break;
    }
  }

  if ($isMobile) {
  } else {
    include('sidebar.php');
  }
  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include('navbar.php'); ?>
    <div class="container-fluid py-4">
      <div class="row">
      <div class="col-lg-6  ">
        <div class="card h-100 p-3 video-result-container">
          <div class="video-wrapper">
            <video id="video" autoplay></video>
            <img id="replacementImage" src="../assets/wapi-clock.gif" style="display: none;" />
            <!-- Elemen untuk menampilkan countdown -->
            <br>
          <center><div id="imageCountdown"></div></center>
          <center><div id="cameraCountdown"></div></center>
          <?php
// Buat koneksi ke database
include '../koneksi.php';
// Query untuk data masuk
$sqlmasuk = "SELECT * FROM jamabsen WHERE keterangan = 'Masuk' ";
$resultmasuk = $koneksi->query($sqlmasuk);
$masuk = $resultmasuk->fetch_assoc();

// Query untuk data keluar
$sqlkeluar = "SELECT * FROM jamabsen WHERE keterangan = 'Keluar' ";
$resultkeluar = $koneksi->query($sqlkeluar);
$keluar = $resultkeluar->fetch_assoc();

// Query untuk data terlambat
$sqlterlambat = "SELECT * FROM jamabsen WHERE keterangan = 'Telat' ";
$resultterlambat = $koneksi->query($sqlterlambat);
$terlambat = $resultterlambat->fetch_assoc();

// Waktu sekarang
$jamskarang = date('H:i:s');

// Data dari hasil query
$absenmasuk = $masuk['mulai'];
$absenberakhirmasuk = $masuk['selesai'];
$absenkeluar = $keluar['mulai'];
$akhirkeluar = $keluar['selesai'];
$telatmasuk = $terlambat['selesai'];

// Tutup koneksi
$koneksi->close();
?>
                        <div id="info" class="text-center mt-2"></div>
                        <div class="informasi text-center mt-2"></div>
          </div>
          <script src="https://cdn.jsdelivr.net/npm/jsqr@1.0.0/dist/jsQR.min.js"></script>
          <script src="script.js"></script>
        </div>
      </div>

      <div class="col-lg-6">
        <br class="br-mobile">
        <div class="card h-100 p-3 video-result-container">
          <div id="resultContainer">
          <div class="center-container">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
          <h3 class="center-text">Tolong arahkan QR ke kamera <span class="text font-weight-bolder"><i class="fas fa-exclamation opacity-10"></i></span></h3>
        </div>

          </div>
        </div>
      </div>

      </div>

      <br>

      <?php
      // Deteksi user agent untuk menentukan apakah pengguna mengakses dari perangkat mobile
      $userAgent = $_SERVER['HTTP_USER_AGENT'];
      $isMobile = false;

      // Daftar kata kunci yang mungkin muncul dalam user agent untuk perangkat mobile
      $mobileKeywords = ['Android', 'iPhone', 'iPad', 'Windows Phone', 'BlackBerry', 'Opera Mini', 'Mobile', 'Tablet'];

      // Periksa apakah ada kata kunci perangkat mobile dalam user agent
      foreach ($mobileKeywords as $keyword) {
          if (stripos($userAgent, $keyword) !== false) {
              $isMobile = true;
              break;
          }
      }

      // Sertakan footer.php hanya jika pengguna mengakses melalui perangkat mobile
      if ($isMobile) {
        include('footer.php');
      }
      ?>
    </div>
    </main>

<?php include('script.php');?>

<script>
const video = document.getElementById('video');
const resultDiv = document.getElementById('result');
let isCameraVisible = false;

// Request access to the camera
navigator.mediaDevices.getUserMedia({ video: true })
  .then(function (stream) {
    video.srcObject = stream;
    video.play();
  })
  .catch(function (err) {
    console.error('Error accessing the camera:', err);
  });

// Function to scan QR codes
function scanQRCode() {
  const canvasElement = document.createElement('canvas');
  const canvas = canvasElement.getContext('2d');
  const width = video.videoWidth;
  const height = video.videoHeight;

  canvasElement.width = width;
  canvasElement.height = height;

  canvas.drawImage(video, 0, 0, width, height);
  const imageData = canvas.getImageData(0, 0, width, height);

  // Using try-catch to handle potential errors in jsQR library
  try {
    const code = jsQR(imageData.data, imageData.width, imageData.height, {
      inversionAttempts: 'dontInvert',
    });

    if (code) {
      console.log('QR Code detected:', code.data);
      sendDataToPHP(code.data);
      insertDataToAbsen(code.data);
      // Tambahkan jeda 2 detik setelah pemindaian selesai
      setTimeout(function () {
        requestAnimationFrame(scanQRCode);
      }, 2000); //dalam milidititik
      return;
    }
  } catch (error) {
    console.error('Error decoding QR code:', error);
  }

  requestAnimationFrame(scanQRCode);
}

// Function to send data to PHP script
function sendDataToPHP(nis) {
  fetch('proseskameratest.php?nis=' + nis)
    .then(response => response.text())
    .then(data => {
      resultDiv.innerHTML = data; // Menggunakan innerHTML bukan innerText
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

// Function to insert data into the database
function insertDataToAbsen(nis) {
  fetch('prosesmasukintest.php?nis=' + nis + '&namalengkap=' + 'namalengkap' + '&kelas=' + 'kelas' + '&jurusan=' + 'jurusan' + '&fotomurid=' + 'fotomurid')
    .then(response => response.text())
    .then(data => {
      console.log(data);

      // Tampilkan hasil di elemen dengan id 'resultContainer'
      const resultContainer = document.getElementById('resultContainer');
      resultContainer.innerHTML = data; // Gunakan innerHTML alih-alih innerText
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

let imageCountdownTime = 0;
let cameraCountdownTime = 0;
let isImageCountdownRunning = false;
let isCameraCountdownRunning = false;

function updateImageCountdown() {
  const imageCountdownElement = document.getElementById('imageCountdown');
  if (isImageCountdownRunning) {
    const hours = Math.floor(imageCountdownTime / 3600);
    const minutes = Math.floor((imageCountdownTime % 3600) / 60);
    const seconds = imageCountdownTime % 60;

    imageCountdownElement.innerHTML = `<b>Gambar akan terbuka dalam ${hours} Jam ${minutes} Menit ${seconds} Detik</b>`;

    if (imageCountdownTime > 0) {
      imageCountdownTime--;
      setTimeout(updateImageCountdown, 1000);
    } else {
      isImageCountdownRunning = false;
      hideImage();
      imageCountdownElement.innerHTML = "";
    }
  }
}

function startImageCountdown(timeInSeconds) {
  imageCountdownTime = timeInSeconds;
  isImageCountdownRunning = true;
  updateImageCountdown();
}

function hideImage() {
  video.style.display = 'none';
  document.getElementById('replacementImage').style.display = 'block';
  startCameraCountdown(10); // Mulai countdown untuk kamera setelah gambar muncul
}

function showCamera() {
  video.style.display = 'block';
  document.getElementById('replacementImage').style.display = 'none';
  startImageCountdown(1000); // Mulai countdown untuk gambar saat kamera terbuka pertama kali
}

function updateCameraCountdown() {
  const cameraCountdownElement = document.getElementById('cameraCountdown');
  if (isCameraCountdownRunning) {
    const hours = Math.floor(cameraCountdownTime / 3600);
    const minutes = Math.floor((cameraCountdownTime % 3600) / 60);
    const seconds = cameraCountdownTime % 60;

    cameraCountdownElement.innerHTML = `<b>Kamera akan muncul dalam ${hours} Jam ${minutes} Menit ${seconds} Detik</b>`;

    if (cameraCountdownTime > 0) {
      cameraCountdownTime--;
      setTimeout(updateCameraCountdown, 1000);
    } else {
      isCameraCountdownRunning = false;
      showCamera();
      cameraCountdownElement.innerHTML = "";
    }
  }
}

function startCameraCountdown(timeInSeconds) {
  cameraCountdownTime = timeInSeconds;
  isCameraCountdownRunning = true;
  updateCameraCountdown();
}

// Event listener for when the video is ready
video.addEventListener('loadeddata', function () {
  requestAnimationFrame(scanQRCode);

  // Langsung buka kamera
  showCamera();
});
</script>
</body>



</html>