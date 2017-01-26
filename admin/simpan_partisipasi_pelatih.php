<?php
include "../koneksi.php";

$idevent = @mysql_real_escape_string($_POST['idevent']);
$namaevent = @mysql_real_escape_string($_POST['namaevent']);
$lokasi = @mysql_real_escape_string($_POST['lokasi']);
$tahun = @mysql_real_escape_string($_POST['tahun']);
$tanggal = @mysql_real_escape_string($_POST['tanggal']);
$idpelatih = @mysql_real_escape_string($_POST['idpelatih']);
$namapelatih = @mysql_real_escape_string($_POST['namapelatih']);
$satlat = @mysql_real_escape_string($_POST['satlat']);
$jabatan = @mysql_real_escape_string($_POST['jabatan']);

mysql_query("insert into tb_partpenguji (id_partpenguji, id_event, nama_event, lokasi, tahun, tanggal, id_pelatih, nama_pelatih, satlat, jabatan) values(NULL,'$idevent', '$namaevent', '$lokasi', '$tahun', '$tanggal', '$idpelatih', '$namapelatih', '$satlat', '$jabatan')") or die (mysql_error());

?>