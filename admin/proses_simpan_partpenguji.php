<?php
include '../koneksi.php';
$id_event = @mysql_real_escape_string($_POST['id_event']);
$id_pelatih = @mysql_real_escape_string($_POST['id_pelatih']);
$nama_pelatih = @mysql_real_escape_string($_POST['nama_pelatih']);
$satlat = @mysql_real_escape_string($_POST['satlat']);
$jabatan = @mysql_real_escape_string($_POST['jabatan']);


mysql_query("insert into tb_partpenguji values('', '$id_event', '$id_pelatih', '$nama_pelatih', '$satlat', '$jabatan')") or die (mysql_error());

?>