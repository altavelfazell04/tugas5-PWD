<?php
    include 'koneksi.php';

    $peserta = mysqli_query($conn, "SELECT * FROM tb_pendaftaran WHERE id_pendaftaran = '".$_GET['id']."' ");

    $p = mysqli_fetch_object($peserta);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penerimaan Peserta Didik Baru</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <script>
        window.print();
    </script>
</head>
<body>

    <h2>Bukti Pendafataran</h2>
    <table class="table-data" border="0">
        <tr>
            <td>Kode Pendaftaran</td>
            <td>:</td>
            <td><?php echo $p->id_pendaftaran ?></td>
        </tr>
        <tr>
            <td>Tahun Ajaran</td>
            <td>:</td>
            <td><?php echo $p->th_ajaran ?></td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td><?php echo $p->nm_peserta ?></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td>:</td>
            <td><?php echo $p->jurusan ?></td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>:</td>
            <td><?php echo $p->tmp_lahir.',' .$p->tgl_lahir ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?php echo $p->jk ?></td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td><?php echo $p->agama ?></td>
        </tr>
        <tr>
            <td>Alamat Lengkap</td>
            <td>:</td>
            <td><?php echo $p->almt_peserta ?></td>
        </tr>
    </table>

</body>
</html>