<!DOCTYPE html>
<html lang="id"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Webinar</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
include 'koneksi.php'; // Pastikan file koneksi database sudah benar

// Define variables and set to empty values 
$namaErr = $emailErr = $institusiErr = $countryErr = $addressErr = $jenis_kelaminErr = $thn_pendaftaranErr = ""; 
$nama = $email = $institusi = $country = $address = $jenis_kelamin = $thn_pendaftaran = $jurusan = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Validasi nama
    if (empty($_POST["nama"])) { 
        $namaErr = "Nama harus diisi"; 
    } else { 
        $nama = test_input($_POST["nama"]); 
        // Cek apakah nama sudah terdaftar
        $query = "SELECT * FROM peserta_seminar WHERE nama='$nama'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $namaErr = "Nama sudah terdaftar"; // Set error jika nama sudah ada
        }
    }

    // Validasi email
    if (empty($_POST["email"])) { 
        $emailErr = "Email harus diisi"; 
    } else { 
        $email = test_input($_POST["email"]); 
        // Cek format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $emailErr = "Email tidak sesuai format";  
        } else {
            // Cek apakah email sudah terdaftar
            $query = "SELECT * FROM peserta_seminar WHERE email='$email'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $emailErr = "Email sudah terdaftar"; // Set error jika email sudah ada
            }
        }
    }

    // Validasi institusi
    if (empty($_POST["institusi"])) { 
        $institusiErr = "Institusi harus diisi"; 
    } else { 
        $institusi = test_input($_POST["institusi"]); 
    }

    // Validasi negara
    if (empty($_POST["country"])) { 
        $countryErr = "Negara harus diisi"; 
    } else { 
        $country = test_input($_POST["country"]); 
    }

    // Validasi alamat
    if (empty($_POST["address"])) { 
        $addressErr = "Alamat harus diisi"; 
    } else { 
        $address = test_input($_POST["address"]); 
    }

    // Validasi jenis kelamin
    if (empty($_POST["jenis_kelamin"])) { 
        $jenis_kelaminErr = "Jenis kelamin harus dipilih"; 
    } else { 
        $jenis_kelamin = test_input($_POST["jenis_kelamin"]); 
    }

    // Validasi tahun pendaftaran
    if (empty($_POST["thn_pendaftaran"])) { 
        $thn_pendaftaranErr = "Tahun pendaftaran harus diisi"; 
    } else { 
        $thn_pendaftaran = test_input($_POST["thn_pendaftaran"]); 
    }

    // Validasi jurusan
    if (empty($_POST["jurusan"])) { 
        $jurusan = ""; // Default value if not selected
    } else { 
        $jurusan = test_input($_POST["jurusan"]); 
    }

    // Jika tidak ada error, simpan data ke database
    if (empty($namaErr) && empty($emailErr) && empty($institusiErr) && empty($countryErr) && empty($addressErr) && empty($jenis_kelaminErr) && empty($thn_pendaftaranErr)) {
        // Query untuk menyimpan data ke database
        $sql = "INSERT INTO peserta_seminar (nama, email, institusi, country, address, jenis_kelamin, thn_pendaftaran, jurusan) 
                VALUES ('$nama', '$email', '$institusi', '$country', '$address', '$jenis_kelamin', '$thn_pendaftaran', '$jurusan')";

        // Jalankan query
        try {
            if (mysqli_query($conn, $sql)) {
                echo "<p>Data berhasil disimpan</p>";
            } else {
                throw new Exception("Error executing query: " . mysqli_error($conn));
            }
        } catch (Exception $e) {
            echo "<p>Exception caught: " . $e->getMessage() . "</p>";
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

<section class="box-formulir">
    <h2>Form Pendaftaran Webinar</h2>
    <h4>PT Bintang Nusantara LOMBOK</h4>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="box">
            <h3>Data Diri Calon Peserta Seminar</h3>
            <table border="0" class="table-form">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama" value="<?php echo $nama; ?>">
                        <span class="error">* <?php echo $namaErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                        <span class="error">* <?php echo $emailErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Institusi</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="institusi" value="<?php echo $institusi; ?>">
                        <span class="error"><?php echo $institusiErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Negara</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="country" value="<?php echo $country; ?>">
                        <span class="error"><?php echo $countryErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="address" value="<?php echo $address; ?>">
                        <span class="error"><?php echo $addressErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>
                        <input type="radio" name="jenis_kelamin" value="L" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "L") echo "checked"; ?>> Laki-Laki
                        <input type="radio" name="jenis_kelamin" value="P" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "P") echo "checked"; ?>> Perempuan
                        <span class="error">* <?php echo $jenis_kelaminErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Tahun Pendaftaran</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="thn_pendaftaran" value="<?php echo $thn_pendaftaran; ?>">
                        <span class="error"><?php echo $thn_pendaftaranErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Jurusan</td>
                    <td>:</td>
                    <td>
                        <select name="jurusan">
                            <option value="">--Pilih--</option>
                            <option value="Teknik Komputer dan Jaringan" <?php if ($jurusan == "Teknik Komputer dan Jaringan") echo "selected"; ?>>Teknik Komputer dan Jaringan</option>
                            <option value="Akuntansi dan Keuangan Lembaga" <?php if ($jurusan == "Akuntansi dan Keuangan Lembaga") echo "selected"; ?>>Akuntansi dan Keuangan Lembaga</option>
                            <option value="Teknik dan Bisnis Sepeda Motor" <?php if ($jurusan == "Teknik dan Bisnis Sepeda Motor") echo "selected"; ?>>Teknik dan Bisnis Sepeda Motor</option>
                            <option value="Multimedia" <?php if ($jurusan == "Multimedia") echo "selected"; ?>>Multimedia</option>
                            <option value="Teknik Kendaraan Ringan dan Otomotif" <?php if ($jurusan == "Teknik Kendaraan Ringan dan Otomotif") echo "selected"; ?>>Teknik Kendaraan Ringan dan Otomotif</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </div>
    </form>
</section>

</body>
</html>
