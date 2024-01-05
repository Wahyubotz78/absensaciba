<!DOCTYPE html>
<html>
<head>
  <title>Scanner QR Code</title>
</head>
<body>
  <video id="cameraPreview" width="50%" height="auto" playsinline autoplay></video>

  <script src="https://cdn.jsdelivr.net/npm/quagga"></script>
  <script>
    function startScanner() {
      navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
          var video = document.getElementById('cameraPreview');
          video.srcObject = stream;
          video.play();

          Quagga.init({
            inputStream: {
              video: {
                target: video,
              },
            },
            decoder: {
              readers: ['code_128_reader'] // Sesuaikan pembaca QR code
            }
          });

          Quagga.onDetected(function(result) {
            var code = result.codeResult.code; // Nilai NIS dari QR code
            sendDataToServer(code);
          });

          Quagga.start();
        })
        .catch(function(err) {
          console.error('Tidak dapat mengakses kamera:', err);
        });
    }

    function sendDataToServer(code) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "proseskamera.php", true);
      xhr.setRequestHeader("Content-Type", "application/json");

      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            console.log('Data absen berhasil disimpan.');
            // Lakukan tindakan lain setelah data berhasil disimpan
          } else {
            console.error('Gagal menyimpan data absen.');
            // Handle kesalahan jika penyimpanan data gagal
          }
        }
      };

      var data = JSON.stringify({ nis: code });
      xhr.send(data);
    }

    // Mulai scanner ketika halaman dimuat
    startScanner();
  </script>
</body>
</html>
