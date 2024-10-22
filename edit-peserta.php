<?php
include 'koneksi.php';
$id         = $_GET['id'];
$mahasiswa  = mysqli_query($conn, "select * from tb_pendaftaran where id_pendaftaran='$id'");
$row        = mysqli_fetch_array($mahasiswa);
// membuat data jurusan menjadi dinamis dalam bentuk array
$jurusan    = array('TEKNIK KOMPUTER DAN JARINGAN','AKUNTANSI DAN KEUANGAN LEMBAGA','TEKNIK DAN BISNIS SEPEDA MOTOR', 'MULTIMEDIA', 'TEKNIK KENDARAAN RINGAN DAN OTOMOTIF');
// membuat function untuk set aktif radio button
function active_radio_button($value,$input){
    // apabilan value dari radio sama dengan yang di input
    $result =  $value==$input?'checked':'';
    return $result;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EDIT PESERTA</title>
    </head>
    <body>
        <form method="post" action="update.php">
            <input type="hidden" value="<?php echo $row['id_pendaftaran'];?>" name="id_pendaftaran">
            <table>
                <tr><td>ID PENDAFTARAN</td><td><input type="text" value="<?php echo $row['id_pendaftaran'];?>" name="id_pendaftaran"></td></tr>
                <tr><td>NAMA</td><td><input type="text" value="<?php echo $row['nm_peserta'];?>" name="nm_peserta"></td></tr>
                <tr><td>TEMPAT, TANGGAL LAHIR</td><td><input type="text" value="<?php echo $row['tmp_lahir'];?>" name="tmp_lahir"></td></tr>
                <tr><td>JENIS KELAMIN</td><td>
                        <input type="radio" name="jk" value="L" <?php echo active_radio_button("L", $row['jk'])?>>Laki Laki
                        <input type="radio" name="jk" value="P" <?php echo active_radio_button("P", $row['jk'])?>>Perempuan
                    </td></tr>
                <tr><td>JURUSAN</td><td>
                        <select name="jurusan">
                            <?php
                            foreach ($jurusan as $j){
                                echo "<option value='$j' ";
                                echo $row['jurusan']==$j?'selected="selected"':'';
                                echo ">$j</option>";
                            }
                            ?>
                        </select>
                    </td></tr>
                <tr><td>ALAMAT</td><td><input value="<?php echo $row['almt_peserta'];?>" type="text" name="almt_peserta"></td></tr>
                <tr><td colspan="2"><button type="submit" value="simpan">SIMPAN PERUBAHAN</button>
                        <a href="data-peserta.php">Kembali</a></td></tr>
            </table>
        </form>
    </body>
</html>
