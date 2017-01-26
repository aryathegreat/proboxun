<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */

if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{
	
		if (isset($_POST['Input'])) {
	$idevent  	= strip_tags($_POST['nim']);
	$namaevent  = strip_tags($_POST['nama']);
	$lokasi		 = strip_tags($_POST['alamat']);
	$tahun		 = strip_tags($_POST['alamat']);
	$tanggal 	= strip_tags($_POST['tanggal']);
	$idpelatih 	= strip_tags($_POST['idpelatih']);
	$namapelatih = strip_tags($_POST['namapelatih']);
	$satlat 	= strip_tags($_POST['satlat']);
	$jabatan 	= strip_tags($_POST['jabatan']);
	
	///////////////////////////////////////////////////////////////////////////////////////////////input ke db
	$query = sprintf("INSERT INTO tb_partpenguji VALUES(NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
			mysql_escape_string($idevent), 
			mysql_escape_string($namaevent),
			mysql_escape_string($lokasi), 
			mysql_escape_string($tahun),
			mysql_escape_string($tanggal), 
			mysql_escape_string($idpelatih), 
			mysql_escape_string($namapelatih),
			mysql_escape_string($satlat), 
			mysql_escape_string($jabatan)
		);
	$sql = mysql_query($query);
	$pesan = "";
	if ($sql) {
		$pesan = "Data berhasil disimpan";
	} else {
		$pesan = "Data gagal disimpan ";
		$pesan .= mysql_error();
	}
	$response = array('pesan'=>$pesan, 'data'=>$_POST);
	echo json_encode($response);
	exit;

	} else if (isset($_POST['Edit'])) {
	$nim  	= strip_tags($_POST['nim']);
	$nama  	= strip_tags($_POST['nama']);
	$alamat = strip_tags($_POST['alamat']);
	
	//////////////////////////////////////////////////////////////////////////update data
	$query = sprintf("UPDATE mahasiswa SET nama='%s', alamat='%s' WHERE nim='%s'", 
			mysql_escape_string($nama), 
			mysql_escape_string($alamat),
			mysql_escape_string($nim)
		);
	$sql = mysql_query($query);
	$pesan = "";
	if ($sql) {
		$pesan = "Data berhasil disimpan";
	} else {
		$pesan = "Data gagal disimpan ";
		$pesan .= mysql_error();
	}
	$response = array('pesan'=>$pesan, 'data'=>$_POST);
	echo json_encode($response);
	exit;
	
	} else if (isset($_POST['Delete'])) {
	$nim  	= strip_tags($_POST['nim']);
	
	/////////////////////////////////////////////////////////////delete data
	$query = sprintf("DELETE FROM mahasiswa WHERE nim='%s'", 
			mysql_escape_string($nim)
		);
	$sql = mysql_query($query);
	$pesan = "";
	if ($sql) {
		$pesan = "Data berhasil dihapus";
	} else {
		$pesan = "Data gagal dihapus ";
		$pesan .= mysql_error();
	}
	$response = array('pesan'=>$pesan, 'data'=>$_POST);
	echo json_encode($response);
	exit;
		};
		
		
		
		?>
        
        
        
        
	<?php 		
		}
else {
	
	echo "<script>alert('untuk mengakses page ini anda harus login terlebih dahulu');</script>";
	exit("<script>location.href='?hal=front';</script>");
	
	}

?>