<!DOCTYPE html>
<html>
<head>
  <title>QR Scanner</title>
  <style>
    body {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      height: 100vh;
      margin: 0;
      margin-left: 25px;
      flex-direction: row;
    }
    #video {
      width: 50%;
      height: auto;
    }
    #result {
      margin-left: 80px; /* Contoh jarak antara kamera dan hasil */
      font-weight: bold;
      font-size: 90px; /* Contoh ukuran font yang diperbesar */
    }
  </style>
</head>
<body>
<video id="video" autoplay></video>
  <div id="result"></div>
  <script src="https://cdn.jsdelivr.net/npm/jsqr@1.0.0/dist/jsQR.min.js"></script>
  <script src="script.js"></script>
</body>
</html>

<script>
const video = document.getElementById('video');
const resultDiv = document.getElementById('result');

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
    }
  } catch (error) {
    console.error('Error decoding QR code:', error);
  }

  requestAnimationFrame(scanQRCode);
}

// Function to send data to PHP script
function sendDataToPHP(nis) {
  fetch('proseskamera.php?nis=' + nis)
    .then(response => response.text())
    .then(data => {
      resultDiv.innerText = data;
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

// Function to insert data into the database
function insertDataToAbsen(nis) {
  fetch('prosesmasukin.php?nis=' + nis + '&namalengkap=' + 'namalengkap' + '&kelas=' + 'kelas' + '&jurusan=' + 'jurusan')
    .then(response => response.text())
    .then(data => {
      console.log(data);
      resultDiv.innerText = data;
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

// Event listener for when the video is ready
video.addEventListener('loadeddata', function () {
  requestAnimationFrame(scanQRCode);
});

</script>