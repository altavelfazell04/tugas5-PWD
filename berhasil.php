<?php
include 'koneksi.php'; // pastikan file koneksi database sudah benar

// Define variables and set to empty values 
$namaErr = $emailErr = $institusiErr = $countryErr = $addressErr = $jenis_kelaminErr = $thn_pendaftaranErr = ""; 
$nama = $email = $institusi = $country = $address = $jenis_kelamin = $thn_pendaftaran = $jurusan = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Validasi input...
    // (kode validasi input Anda di sini)

    // Jika tidak ada error, lanjutkan untuk menyimpan data ke database
    if (empty($namaErr) && empty($emailErr) && empty($institusiErr) && empty($countryErr) && empty($addressErr) && empty($jenis_kelaminErr) && empty($thn_pendaftaranErr)) {
        // Cek apakah tabel ada
        $table_check_query = "SHOW TABLES LIKE 'peserta_seminar'";
        $table_check_result = mysqli_query($conn, $table_check_query);

        if (mysqli_num_rows($table_check_result) == 0) {
            die("Error: Tabel 'peserta_seminar' tidak ada.");
        }

        // Siapkan kueri SQL INSERT
        $sql = "INSERT INTO peserta_seminar (nama, email, institusi, country, address, jenis_kelamin, thn_pendaftaran, jurusan) 
                VALUES ('$nama', '$email', '$institusi', '$country', '$address', '$jenis_kelamin', '$thn_pendaftaran', '$jurusan')";

        // Eksekusi kueri
        try {
            if (mysqli_query($conn, $sql)) {
                echo "Data berhasil disimpan";
            } else {
                throw new Exception("Error executing query: " . mysqli_error($conn));
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }
    }
}

// Fungsi untuk membersihkan input agar aman
function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
} 
?>
