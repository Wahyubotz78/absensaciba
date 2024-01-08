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

// Endpoint untuk mengambil data waktu dari database
app.get('/api/waktu', (req, res) => {
  const query = 'SELECT mulai, selesai FROM jamabsen WHERE id = 1'; // Sesuaikan dengan struktur database kamu
  connection.query(query, (error, results) => {
    if (error) {
      res.status(500).json({ error: 'Error fetching data from database' });
      return;
    }
    if (results.length === 0) {
      res.status(404).json({ error: 'Data not found' });
      return;
    }
    res.json(results[0]); // Kirim data waktu ke client sebagai response
  });
});

const PORT = 3000; // Port yang akan digunakan oleh server
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
