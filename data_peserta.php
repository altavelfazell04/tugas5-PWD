<?php
include 'koneksi.php'; // Pastikan file koneksi database sudah benar

// Query untuk mengambil data peserta dari tabel
$sql = "SELECT * FROM peserta_seminar";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Peserta</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Tambahkan CSS jika diperlukan -->
</head>
<body>

    <h2>Data Peserta Seminar</h2>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Institusi</th>
            <th>Negara</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Tahun Pendaftaran</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Loop untuk menampilkan data peserta
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['institusi'] . "</td>";
            echo "<td>" . $row['country'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['jenis_kelamin'] . "</td>";
            echo "<td>" . $row['thn_pendaftaran'] . "</td>";
            echo "<td>" . $row['jurusan'] . "</td>";
            echo "<td>
                    <a href='update_peserta.php?id=" . $row['id'] . "'>Edit</a> | 
                    <a href='delete_peserta.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus peserta ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
