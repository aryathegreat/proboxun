<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */
if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{

# Terpilih jenis kelamin
if($_POST['cmb_jeniskelamin']=="laki-laki") { $jeniskelamin1	= " selected"; }
else if($_POST['cmb_jeniskelamin']=="perempuan") { $jeniskelamin2	= " selected"; }
/////////////////////////////////////////////////////////////////////////////////////

if(!empty($_POST['cmd_simpan'])){
	if(empty($_POST['txt_nama']) OR empty($_POST['txt_alamat']) OR empty($_POST['txt_username']) OR empty($_POST['txt_password']) OR empty($_POST['txt_password1'])){
		echo "<script>window.alert('Kolom bertanda \'harus diisi\' tidak boleh kosong.');</script>";
	}else {
		if ($_POST['txt_password']!=$_POST['txt_password1']){
			echo "<script>window.alert('Kolom Password Baru dan Password Baru (ulangi) harus sama.');</script>";
	}else{
		if($_POST['txt_action']=='new'){
			$q="insert into tb_admin(id_admin, nama, alamat, jenis_kelamin, satlat, username, password) values(NULL, '".$_POST['txt_nama']."', '".$_POST['txt_alamat']."', '".$_POST['cmb_jeniskelamin']."', '".$_POST['txt_satlat']."', '".$_POST['txt_username']."', '".md5($_POST['txt_password'])."')";
			mysql_query($q);
		}
		
		exit("<script>location.href='?hal=data_penguji';</script>");
	}
}

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($_GET['action']=='delete' and (int)$_GET['id']>0){
	$str->id=(int)$_GET['id'];
	$q=mysql_query("delete from tb_admin where id_admin='".$str->id."'");
	exit("<script>location.href='?hal=data_penguji';</script>");
}
//////////////////////////////////////////////////////////////////////////////////////

?>
 
        <div style="font-family:Arial;font-size:12px;padding:3px ">
		<div style="font-size:18px;padding:10px 0 10px 0 ">TAMBAH DATA PENGUJI</div>
		<form action="" name="" method="post">
		<input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_id" type="hidden" value="<?php echo $str->id;?>">
		<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td width="120"valign="top">Nama</td>
			<td><input name="txt_nama" type="text" size="40" value=""> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Alamat</td>
			<td><input name="txt_alamat" type="text" size="40" value=""> <em>harus diisi</em></td>
		  </tr>
          
          <tr>
			<td>Jenis Kelamin</td>
			<td><select name="cmb_jeniskelamin">
        
        <option value="laki-laki"  <?php echo $jeniskelamin1; ?>> laki-laki </option>
        <option value="perempuan"   <?php echo $jeniskelamin2; ?>> perempuan </option>
        </select>  
         <em>harus diisi</em></td>
		  </tr>
          
		  <tr>
			<td>Satlat</td>
			<td><input name="txt_satlat" type="text" size="40" value=""> </td>
		  </tr>
		  <tr>
			<td>Username</td>
			<td><input name="txt_username" type="text" size="5" value=""><em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Password</td>
			<td><input name="txt_password" type="password" size="5" value=""><em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Password (Ulangi)</td>
			<td><input name="txt_password1" type="password" size="5" value=""><em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td></td>
			<td><input name="cmd_simpan" type="submit" value="Simpan"> <input name="cmd_batal" type="button" onClick="location.href='?hal=data_penguji';" value="Batal"></td>
		  </tr>
		</table>
		</form>


    	</div>

<?php
		
}
else {
	
	echo "<script>alert('untuk mengakses page ini anda harus login terlebih dahulu');</script>";
	echo "<script>windows.location='?hal=front';</script>";
	
	}

?>