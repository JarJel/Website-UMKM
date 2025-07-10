<?php
// Sertakan file koneksi database
include 'db_connect.php';

// Memeriksa apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil dan membersihkan data dari form
    $nama = $conn->real_escape_string(trim($_POST['nama']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $unit_asal = $conn->real_escape_string(trim($_POST['unit_asal']));
    $pesan = $conn->real_escape_string(trim($_POST['pesan']));

    // Mengambil URL redirect dari input tersembunyi
    // Gunakan nilai default jika redirect_url tidak ditemukan (misal: kembali ke index.php)
    $redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : 'index.php#kontak';

    // Memastikan semua field terisi
    if (!empty($nama) && !empty($email) && !empty($unit_asal) && !empty($pesan)) {
        // Query SQL untuk menyimpan data
        $sql = "INSERT INTO pesan (nama, email, unit_asal, pesan) VALUES ('$nama', '$email', '$unit_asal', '$pesan')";

        if ($conn->query($sql) === TRUE) {
            // Jika berhasil disimpan, arahkan kembali ke URL yang telah ditentukan
            echo "<script>alert('Pesan Anda berhasil dikirim dari unit " . $unit_asal . "!'); window.location.href='" . $redirect_url . "';</script>";
        } else {
            // Jika terjadi error saat menyimpan
            echo "<script>alert('Error: " . $sql . "\\n" . $conn->error . "'); window.location.href='" . $redirect_url . "';</script>";
        }
    } else {
        // Jika ada field yang kosong
        echo "<script>alert('Mohon lengkapi semua kolom formulir.'); window.location.href='" . $redirect_url . "';</script>";
    }
} else {
    // Jika diakses langsung tanpa submit form, arahkan ke halaman utama
    header("Location: index.php");
    exit();
}

// Menutup koneksi database
$conn->close();
?>