<?php
include 'koneksi.php'; // Pastikan file koneksi database sudah benar
session_start(); // Memulai sesi jika diperlukan

// Cek apakah ID peserta ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data peserta berdasarkan ID
    $query = "SELECT * FROM peserta_seminar WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $peserta = mysqli_fetch_assoc($result);

    // Jika data peserta tidak ditemukan
    if (!$peserta) {
        die("Error: Peserta tidak ditemukan.");
    }

    // Define variables and set to empty values
    $namaErr = $emailErr = $institusiErr = $countryErr = $addressErr = $jenis_kelaminErr = $thn_pendaftaranErr = ""; 
    $nama = $email = $institusi = $country = $address = $jenis_kelamin = $thn_pendaftaran = $jurusan = ""; 

    // Jika form di-submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $nama = test_input($_POST["nama"]);
        $email = test_input($_POST["email"]);
        $institusi = test_input($_POST["institusi"]);
        $country = test_input($_POST["country"]);
        $address = test_input($_POST["address"]);
        $jenis_kelamin = test_input($_POST["jenis_kelamin"]);
        $thn_pendaftaran = test_input($_POST["thn_pendaftaran"]);
        $jurusan = test_input($_POST["jurusan"]);

        // Validasi input...
        // (kode validasi input Anda di sini)

        // Jika tidak ada error, update data ke database
        if (empty($namaErr) && empty($emailErr) && empty($institusiErr) && empty($countryErr) && empty($addressErr) && empty($jenis_kelaminErr) && empty($thn_pendaftaranErr)) {
            $sql = "UPDATE peserta_seminar SET 
                    nama = '$nama', 
                    email = '$email', 
                    institusi = '$institusi', 
                    country = '$country', 
                    address = '$address', 
                    jenis_kelamin = '$jenis_kelamin', 
                    thn_pendaftaran = '$thn_pendaftaran', 
                    jurusan = '$jurusan' 
                    WHERE id = '$id'";

            // Eksekusi kueri
            try {
                if (mysqli_query($conn, $sql)) {
                    echo "Data berhasil diupdate";
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
} else {
    echo "Error: ID peserta tidak ditentukan.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Peserta</title>
</head>
<body>

    <h2>Update Data Peserta</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id"; ?>">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $peserta['nama']; ?>">
        <span class="error">* <?php echo $namaErr; ?></span>
        <br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $peserta['email']; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br>

        <label for="institusi">Institusi:</label>
        <input type="text" name="institusi" value="<?php echo $peserta['institusi']; ?>">
        <span class="error"><?php echo $institusiErr; ?></span>
        <br>

        <label for="country">Negara:</label>
        <input type="text" name="country" value="<?php echo $peserta['country']; ?>">
        <span class="error"><?php echo $countryErr; ?></span>
        <br>

        <label for="address">Alamat:</label>
        <input type="text" name="address" value="<?php echo $peserta['address']; ?>">
        <span class="error"><?php echo $addressErr; ?></span>
        <br>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <input type="radio" name="jenis_kelamin" value="L" <?php if ($peserta['jenis_kelamin'] == 'L') echo 'checked'; ?>> Laki-Laki
        <input type="radio" name="jenis_kelamin" value="P" <?php if ($peserta['jenis_kelamin'] == 'P') echo 'checked'; ?>> Perempuan
        <span class="error">* <?php echo $jenis_kelaminErr; ?></span>
        <br>

        <label for="thn_pendaftaran">Tahun Pendaftaran:</label>
        <input type="text" name="thn_pendaftaran" value="<?php echo $peserta['thn_pendaftaran']; ?>">
        <span class="error"><?php echo $thn_pendaftaranErr; ?></span>
        <br>

        <label for="jurusan">Jurusan:</label>
        <select name="jurusan">
            <option value="">--Pilih--</option>
            <option value="Teknik Komputer dan Jaringan" <?php if ($peserta['jurusan'] == 'Teknik Komputer dan Jaringan') echo 'selected'; ?>>Teknik Komputer dan Jaringan</option>
            <option value="Akuntansi dan Keuangan Lembaga" <?php if ($peserta['jurusan'] == 'Akuntansi dan Keuangan Lembaga') echo 'selected'; ?>>Akuntansi dan Keuangan Lembaga</option>
            <option value="Teknik dan Bisnis Sepeda Motor" <?php if ($peserta['jurusan'] == 'Teknik dan Bisnis Sepeda Motor') echo 'selected'; ?>>Teknik dan Bisnis Sepeda Motor</option>
            <option value="Multimedia" <?php if ($peserta['jurusan'] == 'Multimedia') echo 'selected'; ?>>Multimedia</option>
            <option value="Teknik Kendaraan Ringan dan Otomotif" <?php if ($peserta['jurusan'] == 'Teknik Kendaraan Ringan dan Otomotif') echo 'selected'; ?>>Teknik Kendaraan Ringan dan Otomotif</option>
        </select>
        <br>

        <input type="submit" value="Update">
    </form>

</body>
</html>
