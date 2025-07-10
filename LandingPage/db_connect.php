<?php
$servername = "localhost"; // Ganti dengan nama server database Anda jika berbeda
$username = "root";      // Ganti dengan username database Anda
$password = "";          // Ganti dengan password database Anda
$dbname = "sekolah_db";  // Ganti dengan nama database yang Anda buat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>