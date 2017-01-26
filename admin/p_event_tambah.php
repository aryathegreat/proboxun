<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <?php ////////////DATEPICKER RUSAK//////////////////?>
    
</head>
<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */
if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{

////////////////////////////////// untuk merubah format tanggal
 function ubahformatTgl($tanggal) {
        $pisah = explode('/',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('-',$urutan);
        return $satukan;
    }
	
$tgl_event = $_POST['txt_tanggal'];/// untuk merubah format tanggal
$tanggal_event = ubahformatTgl($tgl_event);
///////////////////////////////////////////////////

if(!empty($_POST['cmd_simpan'])){
	if(empty($_POST['txt_namaevent']) OR empty($_POST['txt_tahun'])){
		echo "<script>window.alert('Kolom bertanda \'harus diisi\' tidak boleh kosong.');</script>";
	}else{
		if($_POST['txt_action']=='new'){
			$q="insert into tb_event(id_event, nama_event, tahun, lokasi) ".
			"values(NULL,'".$_POST['txt_namaevent']."', '".$_POST['txt_tahun']."', '".$_POST['txt_lokasi']."', '$tanggal_event')";
			mysql_query($q);
		}
		if($_POST['txt_action']=='edit'){
			$q="update tb_event set nama_event='".$_POST['txt_namaevent']."', tahun='".$_POST['txt_tahun']."', lokasi='".$_POST['txt_lokasi']."', tanggal='$tanggal_event' where id_event='".$_POST['txt_id']."'";
			mysql_query($q);
		}
		exit("<script>location.href='?hal=data_event';</script>");
	}
}
if($_GET['action']=='delete' and (int)$_GET['id']>0){
	$str->id=(int)$_GET['id'];
	$q=mysql_query("delete from tb_event where id_event='".$str->id."'");
	exit("<script>location.href='?hal=data_event';</script>");
}

$str->action=$_GET['action'];
if($_GET['action']=='edit' and !empty($_GET['id'])){
	$str->id=$_GET['id'];
	$q=mysql_query("select * from tb_event where id_event='".$str->id."'");
	if(mysql_num_rows($q)>0){
		$h=mysql_fetch_array($q);
		$str->nama_event=$h['nama_event'];
		$str->tahun=$h['tahun'];
		$str->lokasi=$h['lokasi'];
		
	}
}
$str->tipe_str=array('','Usual criterion','Quasi criterion','Criterion with linear preference','Level criterion','Criterion with linear preference and indifference area','Gausian criterion');
$str->tipe_list='<option value=""></option>';
for($i=1;$i<=6;$i++){
	if($str->tipe==$i){$s=' selected';}else{$s='';}
	$str->tipe_list.='<option value="'.$i.'" '.$s.'>'.$i.'. '.$str->tipe_str[$i].'</option>';
}

?>

<body> 
        <div style="font-family:Arial;font-size:12px;padding:3px ">
		<div style="font-size:18px;padding:10px 0 10px 0 ">UPDATE DATA EVENT</div>
		<form action="" name="" method="post">
		<input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_id" type="hidden" value="<?php echo $str->id;?>">
		<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td width="120"valign="top">Nama Event</td>
			<td><input name="txt_namaevent" type="text" size="40" value="<?php echo $str->nama_event;?>" required> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Tahun</td>
			<td><select name="txt_tahun">
			  <option value="min" <?php $tahun= date(Y); echo $tahun;?>><?php echo $str->tahun;?> </option>
              <?php
   				 
   				 $maxtahun = ($tahun + 5 );
   				  for($tahun= date(Y); $tahun<$maxtahun ;$tahun++){
   
    			?>
			 
               <option value=<?php echo $tahun; ?> ><?php echo $tahun ;?></option>
                 <?php
   				 }
    			?>
			</select> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Lokasi</td>
			<td><input name="txt_lokasi" type="text" size="10" value="<?php echo $str->lokasi;?>" required></td>
		  </tr>
		   <tr>
			<td>Tanggal </td>
			<td><input name="txt_tanggal" type="text" id="tanggal"  class="datepicker" value="" ></td>
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
</body>
</html>