<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Peserta Seminar</title>
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
            max-width: 800px;
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
        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    <h2>Daftar Peserta Seminar</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Institusi</th>
                <th>Negara</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Tahun Pendaftaran</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'koneksi.php'; // pastikan file koneksi database sudah benar

            // Query untuk mengambil data peserta
            $sql = "SELECT * FROM peserta_seminar";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['institusi']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['country']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['thn_pendaftaran']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jurusan']) . "</td>";
                    echo "</tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='9'>Tidak ada peserta terdaftar</td></tr>";
            }

            // Tutup koneksi
            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <a href="index.php" class="button">Kembali ke Form Pendaftaran</a>
</div>

</body>
</html>
