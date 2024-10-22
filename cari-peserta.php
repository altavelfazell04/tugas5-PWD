<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | PSB SMK Bintang Nusantara</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <br>

    <header>
        <h1>Admin Penerimaan Siswa Baru</h1>
        <ul>
            <li><a href="beranda.php">Beranda</li>
            <li><a href="data-peserta.php">Data Peserta</li>
            <li><a href="cari-peserta.php">Cari Peserta</a>
            <li><a href="keluar.php">Keluar</li>
            <li><a href="#">.</li>
        </ul>
    </header>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
    <h4>Cari Daftar Peserta Didik Baru</h4>
    <div class="container-1">
        <?php
        $kata_kunci="";
        if (isset($_POST['kata_kunci'])) {
            $kata_kunci=$_POST['kata_kunci'];
        }
        ?>
        <input type="search" id="search" name="kata_kunci" value="<?php echo $kata_kunci;?>" class="input-search"  required/>
        <input type="submit" class="btn-cari" value="Cari">
    </div>
    </form>

    <table class="table">
        <br>
        <thead>
        <tr>
            <th>No</th>
            <th>ID Pendaftaran</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Tanggal Lahir</th>
            <th>Agama</th>
            <th>Alamat</th>

        </tr>
        </thead>
        <?php

        include "koneksi.php";
        if (isset($_POST['kata_kunci'])) {
            $kata_kunci=trim($_POST['kata_kunci']);
            $sql="select * from tb_pendaftaran where id_pendaftaran like '%".$kata_kunci."%' or nm_peserta like '%".$kata_kunci."%' or jurusan like '%".$kata_kunci."%' order by id_pendaftaran asc";

        }else {
            $sql="select * from tb_pendaftaran order by id_pendaftaran asc";
        }


        $hasil=mysqli_query($conn,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["id_pendaftaran"]; ?></td>
                <td><?php echo $data["nm_peserta"];   ?></td>
                <td><?php echo $data["jurusan"];   ?></td>
                <td><?php echo $data["tgl_lahir"];   ?></td>
                <td><?php echo $data["agama"];   ?></td>
                <td><?php echo $data["almt_peserta"];   ?></td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
</div>

</body>
</html>