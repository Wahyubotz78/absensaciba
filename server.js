// server.js
const express = require('express');
const mysql = require('mysql');

const app = express();

// Koneksi ke database
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root', // Ganti dengan username database kamu
  password: '', // Ganti dengan password database kamu
  database: 'absensaciba' // Ganti dengan nama database kamu
});

connection.connect(err => {
  if (err) {
    console.error('Error connecting to database:', err);
    return;
  }
  console.log('Connected to database!');
});

// Endpoint untuk mengambil data waktu dari database dan waktu sekarang
// Endpoint untuk mengambil data waktu dari database dan waktu sekarang beserta countdown
app.get('/api/waktuk', (req, res) => {
  // Query untuk mengambil data waktu dari database
  const query = 'SELECT keterangan, mulai, selesai FROM jamabsen'; // Sesuaikan dengan struktur database kamu
  connection.query(query, (error, results) => {
    if (error) {
      res.status(500).json({ error: 'Error fetching data from database' });
      return;
    }

    // Waktu sekarang
    const waktuSekarang = new Date();

    // Filter data yang sesuai dengan rentang waktu sekarang
    const dataSesuaiWaktu = results.filter(data => {
      const waktuMulai = new Date();
      const waktuSelesai = new Date();

      // Set nilai jam, menit, dan detik dari waktuMulai dan waktuSelesai
      const [mulaiHours, mulaiMinutes, mulaiSeconds] = data.mulai.split(':');
      waktuMulai.setHours(Number(mulaiHours), Number(mulaiMinutes), Number(mulaiSeconds));

      const [selesaiHours, selesaiMinutes, selesaiSeconds] = data.selesai.split(':');
      waktuSelesai.setHours(Number(selesaiHours), Number(selesaiMinutes), Number(selesaiSeconds));

      // Periksa apakah waktu sekarang berada dalam rentang waktu mulai dan selesai
      return waktuSekarang.getTime() >= waktuMulai.getTime() && waktuSekarang.getTime() <= waktuSelesai.getTime();
    });

    // Jika tidak ada data yang sesuai, kembalikan respons dengan dataSesuaiWaktu kosong
    if (dataSesuaiWaktu.length === 0) {
      const responseData = {
        dataSesuaiWaktu: [],
        waktuSekarang: waktuSekarang.toLocaleTimeString('en-US', { hour12: false }),
      };
      res.json(responseData);
      return;
    }

    // Hitung selisih waktu untuk setiap data sesuai waktu
    const countdowns = dataSesuaiWaktu.map(data => {
      const waktuMulai = new Date();
      const waktuSelesai = new Date();

      const [mulaiHours, mulaiMinutes, mulaiSeconds] = data.mulai.split(':');
      waktuMulai.setHours(Number(mulaiHours), Number(mulaiMinutes), Number(mulaiSeconds));

      const [selesaiHours, selesaiMinutes, selesaiSeconds] = data.selesai.split(':');
      waktuSelesai.setHours(Number(selesaiHours), Number(selesaiMinutes), Number(selesaiSeconds));

      // Hitung selisih waktu dalam milidetik
      const selisihWaktu = waktuSelesai.getTime() - waktuSekarang.getTime();

      // Ubah selisih waktu menjadi format HH:mm:ss
      const countdown = new Date(selisihWaktu).toISOString().substr(11, 8);

      return { keterangan: data.keterangan, countdown: countdown };
    });

    // Persiapkan data yang akan dikirim sebagai respons
    const responseData = {
      dataSesuaiWaktu: dataSesuaiWaktu,
      countdowns: countdowns,
      waktuSekarang: waktuSekarang.toLocaleTimeString('en-US', { hour12: false }),
    };

    // Kirim data sebagai respons JSON
    res.json(responseData);
  });
});


const PORT = 3000; // Port yang akan digunakan oleh server
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
// dataFromDatabase: results,