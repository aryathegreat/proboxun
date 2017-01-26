<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */
if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{

if(!empty($_POST['cmd_simpan'])){
	if(empty($_POST['txt_nama']) OR empty($_POST['txt_tipe'])){
		echo "<script>window.alert('Kolom bertanda \'harus diisi\' tidak boleh kosong.');</script>";
	}else{
		if($_POST['txt_action']=='new'){
			$q="insert into tb_kriteria(id_kriteria, nama, minmax, tipe_preferensi, nilai_p, nilai_q, nilai_gausian) ".
			"values(NULL,'".$_POST['txt_nama']."', '".$_POST['txt_minmax']."', '".$_POST['txt_tipe']."', '".$_POST['txt_p']."', '".$_POST['txt_q']."', '".$_POST['txt_gausian']."')";
			mysql_query($q);
		}
		if($_POST['txt_action']=='edit'){
			$q="update tb_kriteria set nama='".$_POST['txt_nama']."', minmax='".$_POST['txt_minmax']."', tipe_preferensi='".$_POST['txt_tipe']."', nilai_p='".$_POST['txt_p']."', nilai_q='".$_POST['txt_q']."', nilai_gausian='".$_POST['txt_gausian']."' where id_kriteria='".$_POST['txt_id']."'";
			mysql_query($q);
		}
		exit("<script>location.href='?hal=data_kriteria';</script>");
	}
}
if($_GET['action']=='delete' and (int)$_GET['id']>0){
	$str->id=(int)$_GET['id'];
	$q=mysql_query("delete from tb_kriteria where id_kriteria='".$str->id."'");
	exit("<script>location.href='?hal=data_kriteria';</script>");
}

$str->action=$_GET['action'];
if($_GET['action']=='edit' and !empty($_GET['id'])){
	$str->id=$_GET['id'];
	$q=mysql_query("select * from tb_kriteria where id_kriteria='".$str->id."'");
	if(mysql_num_rows($q)>0){
		$h=mysql_fetch_array($q);
		$str->nama=$h['nama'];
		$str->minmax=$h['minmax'];
		$str->tipe=$h['tipe_preferensi'];
		$str->nilai_p=$h['nilai_p'];
		$str->nilai_q=$h['nilai_q'];
		$str->gausian=$h['nilai_gausian'];
	}
}
$str->tipe_str=array('','Usual criterion','Quasi criterion','Criterion with linear preference','Level criterion','Criterion with linear preference and indifference area','Gausian criterion');
$str->tipe_list='<option value=""></option>';
for($i=1;$i<=6;$i++){
	if($str->tipe==$i){$s=' selected';}else{$s='';}
	$str->tipe_list.='<option value="'.$i.'" '.$s.'>'.$i.'. '.$str->tipe_str[$i].'</option>';
}

?>
 
        <div style="font-family:Arial;font-size:12px;padding:3px ">
		<div style="font-size:18px;padding:10px 0 10px 0 ">UPDATE DATA KRITERIA</div>
		<form action="" name="" method="post">
		<input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_id" type="hidden" value="<?php echo $str->id;?>">
		<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td width="120"valign="top">Nama</td>
			<td><input name="txt_nama" type="text" size="40" value="<?php echo $str->nama;?>" required="required"> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Min / Max</td>
			<td><select name="txt_minmax">
			  <option value="min" <?php if($str->minmax=='min'){echo 'selected';};?>>Min</option>
			  <option value="max" <?php if($str->minmax=='max'){echo 'selected';};?>>Max</option>
			</select> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Tipe Preferensi</td>
			<td><select name="txt_tipe"><?php echo $str->tipe_list;?></select> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Nilai Min (Q)</td>
			<td><input name="txt_q" type="text" size="5" value="<?php echo $str->nilai_q;?>" required="required"></td>
		  </tr>
		  <tr>
			<td>Nilai Max (P)</td>
			<td><input name="txt_p" type="text" size="5" value="<?php echo $str->nilai_p;?>" required="required"></td>
		  </tr>
		  <tr>
			<td>Gausian</td>
			<td><input name="txt_gausian" type="text" size="5" value="<?php echo $str->gausian;?>"></td>
		  </tr>
		  <tr>
			<td></td>
			<td><input name="cmd_simpan" type="submit" value="Simpan"> <input name="cmd_batal" type="button" onClick="location.href='<?php echo $_SERVER['HTTP_REFERER'];?>';" value="Batal"></td>
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