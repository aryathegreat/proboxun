<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */

if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{

# Terpilih kelas
if($_POST['cmb_kelas']=="54.1-58") { $kelas1	= " selected"; }
else if($_POST['cmb_kelas']=="58.1-62") { $kelas2	= " selected"; }
else if($_POST['cmb_kelas']=="49.1-52") { $kelas3	= " selected"; }
else if($_POST['cmb_kelas']=="52.1-55") { $kelas4	= " selected"; }
else if($_POST['cmb_kelas']=="55.1-58") { $kelas5	= " selected"; }
else if($_POST['cmb_kelas']=="58.1-61") { $kelas6	= " selected"; }
else if($_POST['cmb_kelas']=="61.1-64") { $kelas7	= " selected"; }
else if($_POST['cmb_kelas']=="64.1-67") { $kelas8	= " selected"; }
else if($_POST['cmb_kelas']=="67.1-70") { $kelas9	= " selected"; }
else if($_POST['cmb_kelas']=="70.1-75") { $kelas10	= " selected"; }
else if($_POST['cmb_kelas']=="75.1-80") { $kelas11	= " selected"; }
else if($_POST['cmb_kelas']=="80-keatas") { $kelas12 = " selected"; }


# Terpilih jenis kelamin
if($_POST['cmb_jeniskelamin']=="laki-laki") { $jeniskelamin1	= " selected"; }
else if($_POST['cmb_jeniskelamin']=="perempuan") { $jeniskelamin2	= " selected"; }

#validasi kelas
if ($_POST[cmb_jeniskelamin]=="laki-laki"){
	if($_POST[cmb_kelas]=="54.1-58"){
    	echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putra '); </script>";
        }
	else if($_POST[cmb_kelas]=="58.1-62"){
    	echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putra '); </script>";
        }
	}
else if ($_POST[cmb_jeniskelamin]=="perempuan"){
	if($_POST[cmb_kelas]=="49.1-52"){
    	echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
        }
	else if ($_POST[cmb_kelas]=="52.1-55"){
		echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
		}
	else if ($_POST[cmb_kelas]=="55.1-58"){
		echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
		}
	else if ($_POST[cmb_kelas]=="58.1-61"){
		echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
		}
	else if ($_POST[cmb_kelas]=="61.1-64"){
		echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
		}
	else if ($_POST[cmb_kelas]=="64.1-67"){
		echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
		}
	else if ($_POST[cmb_kelas]=="67.1-70"){
		echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
		}
	else if ($_POST[cmb_kelas]=="70.1-75"){
		echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
		}
	else if ($_POST[cmb_kelas]=="75.1-80"){
		echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
		}
	else if ($_POST[cmb_kelas]=="80-keatas"){
		echo"<script>window.alert('kelas tersebut tidak tersedia untuk atlet putri '); </script>";
		}
	}
	

#command simpan
if(!empty($_POST['cmd_simpan'])){
	if(empty($_POST['cmb_jeniskelamin']) OR empty ($_POST['cmb_kelas']) ){
		echo "<script>window.alert('Kolom bertanda \'harus diisi\' tidak boleh kosong.');</script>";
	}else{
		if($_POST['txt_action']=='new'){
			$q="insert into ".$table_prefix."alternatif(id_alternatif, nama, alamat, jenis_kelamin, satlat, umur, kelas, keterangan) values(NULL, '".$_POST['txt_nama']."', '".$_POST['txt_alamat']."', '".$_POST['cmb_jeniskelamin']."', '".$_POST['txt_satlat']."', '".$_POST['txt_umur']."', '".$_POST['cmb_kelas']."', '".$_POST['txt_keterangan']."')";
			mysql_query($q);
		}
		
		
		
		if($_POST['txt_action']=='edit'){
			$q="update ".$table_prefix."alternatif set nama='".$_POST['txt_nama']."', alamat='".$_POST['txt_alamat']."', jenis_kelamin='".$_POST['cmb_jeniskelamin']."', satlat='".$_POST['txt_satlat']."', umur='".$_POST['txt_umur']."', kelas='".$_POST['cmb_kelas']."', keterangan='".$_POST['txt_keterangan']."'  where id_alternatif='".$_POST['txt_id']."'";
			mysql_query($q);
		}
		exit("<script>location.href='?hal=data_alternatif';</script>");
	}
}

$str->action=$_GET['action'];
if($_GET['action']=='edit' and !empty($_GET['id'])){
	$str->id=$_GET['id'];
	$q=mysql_query("select * from ".$table_prefix."alternatif where id_alternatif='".$str->id."'");
	if(mysql_num_rows($q)>0){
		$h=mysql_fetch_array($q);
		$str->nama=$h['nama'];
		$str->alamat=$h['alamat'];
		$str->jenis_kelamin=$h['jenis_kelamin'];//cmb jeniskelamin perlu penanganan lebih lanjut krn gk ada ($str->jenis_kelamin)
		$str->satlat=$h['satlat'];
		$str->umur=$h['umur'];
		$str->kelas=$h['kelas'];//cmb kelas perlu penanganan lebih lanjut krn gk ada ($str->kelas)
		$str->keterangan=$h['keterangan'];
	}
}
if($_GET['action']=='delete' and (int)$_GET['id']>0){
	$str->id=(int)$_GET['id'];
	$q=mysql_query("delete from ".$table_prefix."alternatif where id_alternatif='".$str->id."'");
	exit("<script>location.href='?hal=data_alternatif';</script>");
}

?>
 
        <div style="font-family:Arial;font-size:12px;padding:3px ">
		<div style="font-size:18px;padding:10px 0 10px 0 ">UPDATE DATA ALTERNATIF</div>
		<form action="" name="" method="post" enctype="multipart/form-data">
		<input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_id" type="hidden" value="<?php echo $str->id;?>">
		<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td width="120">Nama Alternatif </td>
			<td><input name="txt_nama" type="text" size="40" value="<?php echo $str->nama;?>" required="required"> <em>harus diisi</em></td>
		  </tr>
            <tr>
			<td>Alamat </td>
			<td><input name="txt_alamat" type="text" size="40" value="<?php echo $str->alamat;?>" required="required" > <em>harus diisi</em></td>
		  </tr>
           <tr>
			<td>Jenis Kelamin </td>
			<td><select name="cmb_jeniskelamin" >
        <option value="<?php echo ($str->jenis_kelamin); ?>"  > <?php echo ($str->jenis_kelamin); ?> </option>
        <option value="laki-laki"  <?php echo $jeniskelamin1; ?>> laki-laki </option>
        <option value="perempuan"   <?php echo $jeniskelamin2; ?>> perempuan </option>
        </select>    <em>harus diisi</em>  </td>
		  </tr>
           <tr>
			<td>Satlat </td>
			<td><input name="txt_satlat" type="text" size="40" value="<?php echo $str->satlat;?>" required="required"> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Umur</td>
			<td><input name="txt_umur" type="text" size="40" value="<?php echo $str->umur;?>" required="required"> <em>harus diisi</em></td>
		  </tr>
        
           <tr>
			<td>Kelas </td>
			<td><select name="cmb_kelas">
        <option value="<?php echo ($str->kelas); ?>"  > <?php echo ($str->kelas); ?> </option>
        <option value="54.1-58"  <?php echo $kelas1; ?>> 54.1-58 putri </option>
        <option value="58.1-62"   <?php echo $kelas2; ?>> 58.1-62 putri </option>
        <option value="49.1-52"  <?php echo $kelas3; ?>> 49.1-52 </option>
        <option value="52.1-55"   <?php echo $kelas4; ?>> 52.1-55 </option>
        <option value="55.1-58"   <?php echo $kelas5; ?>> 55.1-58</option>
        <option value="58.1-61" <?php echo $kelas6; ?>> 58.1-61 </option>
        <option value="61.1-64" <?php echo $kelas7; ?>> 61.1-64 </option>
        <option value="64.1-67"   <?php echo $kelas8; ?>> 64.1-67 </option>
        <option value="67.1-70" <?php echo $kelas9; ?>> 67.1-70 </option>
        <option value="70.1-75" <?php echo $kelas10; ?>> 70.1-75 </option>
        <option value="75.1-80"   <?php echo $kelas11; ?>> 75.1-80 </option>
        <option value="80-keatas"   <?php echo $kelas12; ?>> 80 keatas </option>
      	</select>   <em>harus diisi</em>   </td>
		  </tr>
		  <tr>
          <tr>
			<td>Keterangan </td>
			<td><textarea name="txt_keterangan" cols="60" rows="4"><?php echo $str->keterangan;?></textarea></td>
		  </tr>
		  <tr>
			<td></td>
			<td><input name="cmd_simpan" type="submit" value="Simpan"> <input name="cmd_batal" type="button" onClick="location.href='?hal=data_alternatif';" value="Batal"></td>
		  </tr>
		</table>
		</form>


    	</div>

<?php
		
}
else {
	
	echo "<script>alert('untuk mengakses page ini anda harus login terlebih dahulu');</script>";
	exit("<script>location.href='?hal=front';</script>");
	
	}

?>