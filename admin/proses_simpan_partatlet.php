<?php
include '../koneksi.php';
$id_event = @mysql_real_escape_string($_POST['id_event']);
$id_alternatif = @mysql_real_escape_string($_POST['id_alternatif']);
$nama_alternatif = @mysql_real_escape_string($_POST['nama_alternatif']);
$satlat = @mysql_real_escape_string($_POST['satlat']);
$kelas = @mysql_real_escape_string($_POST['kelas']);


mysql_query("insert into tb_partatlet values('', '$id_event', '$id_alternatif', '$nama_alternatif', '$satlat', '$kelas')") or die (mysql_error());

?>