<!DOCTYPE html>
<html lang="en">
<head>
    <title>QR Code Scanner</title>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
    <center>
    <div id="app">
        <video id="preview"></video>
    </div>
    </center>
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        scanner.addListener('scan', function(content) {
            // Lakukan proses penyimpanan ke database menggunakan Ajax di sini
            saveQRCodeToDatabase(content);
        });

        // Mulai pemindaian QR code
        Instascan.Camera.getCameras().then(cameras => {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('Tidak ada kamera yang ditemukan.');
            }
        }).catch(e => {
            console.error(e);
        });

        // Fungsi untuk menyimpan hasil QR code ke database menggunakan Ajax
        function saveQRCodeToDatabase(qrContent) {
            let xhr = new XMLHttpRequest();
            let url = 'proseskamera.php';
            let params = 'hasil_qr=' + qrContent;

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Hasil QR Code berhasil disimpan ke database.');
                    } else {
                        console.error('Gagal menyimpan ke database.');
                    }
                }
            };

            xhr.send(params);
        }
    </script>
</body>
</html>
