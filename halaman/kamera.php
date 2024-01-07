<!DOCTYPE html>
<html>
<head>
  <title>QR Scanner</title>
  <style>
    #video {
      width: 50%;
      height: auto;
    }
    #result {
      margin-top: 20px;
      font-weight: bold;
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

navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
  .then(function(stream) {
    video.srcObject = stream;
    video.play();
  })
  .catch(function(err) {
    console.error('Error accessing the camera:', err);
  });

function scanQRCode() {
  const canvasElement = document.createElement('canvas');
  const canvas = canvasElement.getContext('2d');
  const width = video.videoWidth;
  const height = video.videoHeight;

  canvasElement.width = width;
  canvasElement.height = height;

  canvas.drawImage(video, 0, 0, width, height);
  const imageData = canvas.getImageData(0, 0, width, height);
  const code = jsQR(imageData.data, imageData.width, imageData.height, {
    inversionAttempts: 'dontInvert',
  });

  if (code) {
    console.log('QR Code detected:', code.data);
     // Mengirim data NIS ke skrip PHP
     sendDataToPHP(code.data);
  }

  requestAnimationFrame(scanQRCode); // Melanjutkan scanning secara terus-menerus
}

function sendDataToPHP(nis) {
  fetch('proseskamera.php?nis=' + nis) // Mengirim NIS ke skrip PHP menggunakan GET request
    .then(response => response.text())
    .then(data => {
      resultDiv.innerText = data; // Menampilkan hasil dari skrip PHP di dalam div result
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

video.addEventListener('loadeddata', function() {
  requestAnimationFrame(scanQRCode); // Memulai scanning ketika video siap
});
</script>