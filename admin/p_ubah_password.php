<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */
if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{

if(!empty($_POST['cmd_simpan'])){
	if(empty($_POST['txt_passwordlama']) OR empty($_POST['txt_password']) OR empty($_POST['txt_password1'])){
		echo "<script>window.alert('Kolom bertanda \'harus diisi\' tidak boleh kosong.');</script>";
	}else{
		if($_POST['txt_password']!=$_POST['txt_password1']){
			echo "<script>window.alert('Kolom Password Baru dan Password Baru (ulangi) harus sama.');</script>";
		}else{
			if($_SESSION['LOGIN_usertype']=='admin'){
				if(mysql_num_rows(mysql_query("select * from ".$table_prefix."admin where username='".$_SESSION['LOGIN_username']."' and password='".md5($_POST['txt_passwordlama'])."'"))>0){
					mysql_query("update ".$table_prefix."admin set password='".md5($_POST['txt_password'])."' where username='".$_SESSION['LOGIN_username']."'");
					exit("<script>location.href='?hal=ubah_password';</script>");
				}else{
					echo "<script>window.alert('Password Lama anda tidak sesuai.');</script>";
				}
			}
			
		}
	}
}


?>
 
        <div style="font-family:Arial;font-size:12px;padding:3px ">
		<div style="font-size:18px;padding:10px 0 10px 0 ">UBAH PASSWORD</div>
		<form action="" name="" method="post">
		<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td width="120">Password Lama </td>
			<td><input name="txt_passwordlama" type="password" size="40" value=""> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Password Baru</td>
			<td><input name="txt_password" type="password" size="40" value=""> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td valign="top">Ulangi</td>
			<td><input name="txt_password1" type="password" size="40" value=""> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td></td>
			<td><input name="cmd_simpan" type="submit" value="Simpan"> </td>
		  </tr>
		</table>
		</form>


    	</div>
<?php
		
}
else {
	
	echo "<script>alert('untuk mengakses page ini anda harus login sebagai admin terlebih dahulu');</script>";
	exit("<script>location.href='?hal=front';</script>");
	
	}

?>