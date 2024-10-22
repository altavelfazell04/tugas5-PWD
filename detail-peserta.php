<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Peserta Seminar</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Detail Peserta Seminar</h2>

    <?php
    include 'koneksi.php'; // pastikan file koneksi database sudah benar

    // Mengambil ID peserta dari URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);

        // Query untuk mengambil data peserta berdasarkan ID
        $sql = "SELECT * FROM peserta_seminar WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>

            <table>
                <tr>
                    <th>Nama</th>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                </tr>
                <tr>
                    <th>Institusi</th>
                    <td><?php echo htmlspecialchars($row['institusi']); ?></td>
                </tr>
                <tr>
                    <th>Negara</th>
                    <td><?php echo htmlspecialchars($row['country']); ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                </tr>
                <tr>
                    <th>Tahun Pendaftaran</th>
                    <td><?php echo htmlspecialchars($row['thn_pendaftaran']); ?></td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td><?php echo htmlspecialchars($row['jurusan']); ?></td>
                </tr>
            </table>

            <?php
        } else {
            echo "<p>Peserta tidak ditemukan.</p>";
        }

        // Tutup koneksi
        mysqli_close($conn);
    } else {
        echo "<p>ID peserta tidak valid.</p>";
    }
    ?>

    <a href="data_peserta.php" class="button">Kembali ke Daftar Peserta</a>
</div>

</body>
</html>
