<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */
if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{

$str->nav_link='hal=daftar_pelatih';
$str->edit_link='hal=tambah_partpenguji';

$str->jabatan_str=array('','Ketua','Anggota');
$str->jabatan_list='<option value=""></option>';
for($i=1;$i<=2;$i++){
	if($str->jabatan==$i){$s=' selected';}else{$s='';}
	$str->jabatan_list.='<option value="'.$i.'" '.$s.'>'.$i.'. '.$str->jabatan_str[$i].'</option>';
	$str->action=$_GET['action'];
	if($_GET['action']=='penguji' and !empty($_GET['id'])){	
	$str->id=$_GET['id'];
	$q=mysql_query("select * from tb_event where id_event='".$str->id."'");
		if(mysql_num_rows($q)>0){
		$h=mysql_fetch_array($q);
		$str->nama_event=$h['nama_event'];
		$str->tahun=$h['tahun'];
		$str->lokasi=$h['lokasi'];
		$str->tanggal=$h['tanggal'];
		
		
		
		$_SESSION['id_event'] = $_GET['id'];
		$_SESSION['nama_event']=$h['nama_event'];
		$_SESSION['tahun']=$h['tahun'];
		$_SESSION['lokasi']=$h['lokasi'];
		$_SESSION['tanggal']=$h['tanggal'];
		
		}
	}
	}


$str->maxresult=10;
$str->hal=(int)$_GET['n'];
$qq="select * from tb_partpenguji";
$str->n=(int)mysql_num_rows(mysql_query($qq));
if($str->n % $str->maxresult >0){
	$str->n=(int)($str->n/$str->maxresult);
}else{
	$str->n=(int)($str->n/$str->maxresult);$str->n--;
}

if($str->hal < 0){
	$str->hal=0;
	
}elseif($str->hal > $str->n){
	$str->hal=$str->n;
}
if($str->hal < 0){$str->hal=0;}
if($str->hal > 0){
	$str->nav_first='<a href="?'.$str->nav_link.'&n=0"><img src="images/firstPage.gif" alt="" /></a>&nbsp;&nbsp;&nbsp;';
}else{
	$str->nav_first='<img src="images/firstPage.gif" alt="" />&nbsp;&nbsp;&nbsp;';
}
if($str->hal > 0){
	$str->nav_prev='<a href="?'.$str->nav_link.'&n='.($str->hal-1).'"><img src="images/previousPage.gif" alt="" /></a>&nbsp;&nbsp;&nbsp;';
}else{
	$str->nav_prev='<img src="images/previousPage.gif" alt="" />&nbsp;&nbsp;&nbsp;';
}
if($str->hal < $str->n ){
	$str->nav_next='<a href="?'.$str->nav_link.'&n='.($str->hal+1).'"><img src="images/nextPage.gif" alt="" /></a>&nbsp;&nbsp;&nbsp;';
}else{
	$str->nav_next='<img src="images/nextPage.gif" alt="" />&nbsp;&nbsp;&nbsp;';
}
if($str->hal < $str->n ){
	$str->nav_last='<a href="?'.$str->nav_link.'&n='.$str->n.'"><img src="images/lastPage.gif" alt="" /></a>';
}else{
	$str->nav_last='<img src="images/lastPage.gif" alt="" />';
}
$str->hal=$str->hal*$str->maxresult;
$q="select * from tb_partpenguji where id_event='".$str->id."' limit ".$str->hal.",".$str->maxresult;
$sql=mysql_query($q);
if(mysql_num_rows($sql) > 0){
	$i=$str->hal;
	while($h=mysql_fetch_array($sql)){
		$i++;
		$str->daftar.='
		  <tr>
			<td valign="top">'.$i.'</td>
			<td valign="top">'.$h['nama_pelatih'].'</td>
			<td valign="top" align="center">'.$h['satlat'].'</td>
			<td valign="top" align="center">'.$h['jabatan'].'</td>
			
			<td align="center" valign="top"><a href="?'.$str->edit_link.'&amp;id='.$h['id_partpenguji'].'&amp;action=delete"><img src="images/delete.png"></a> </td>
		  </tr>
		';
	}
}






?>

 <title>Data Tim</title>
<fieldset  class="utama">
<legend style="font-size:14px;">Tim Penguji</legend>
		
	<div style="width:96%; float:left; border:1px solid #999; padding:10px;">
		<table>
        <form action="" name="" method="post">
		<input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_idevent" type="hidden" value="<?php echo $str->id;?>">
			<tr>
				<td style="font-size:14px;">Nama Event </td>
				<td><input type="text"  id="namaevent" value="<?php echo $str->nama_event;?>" readonly="true" style="font-size:13px;"/></td>
				<td style="font-size:14px;">Lokasi  </td>
				<td><input type="text" id="lokasi"  value="<?php echo $str->lokasi;?>" readonly="true" style="font-size:13px;"/></td>
                <td style="font-size:14px;"><a href="?hal=tambah_partpenguji">Kelola Tim</a> </td>
			</tr>
			<tr>
				<td style="font-size:14px;">Tahun</td>
				<td><input type="text" id="tahun" value="<?php echo $str->tahun;?>" readonly="true" style="font-size:13px;"/></td>
			
				<td style="font-size:14px;">Tanggal</td>
				<td><input type="text" id="tanggal" value="<?php echo $str->tanggal;?>" readonly="true" style="font-size:13px;" /></td>
			</tr>
           
		</table>
	</div>   
     <p><br></p>
         <p><br></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
 	  
      <div style="overflow:auto; max-height:250px; margin:10px 0 20px 0;" >
		<fieldset>

        <div style="font-family:Arial;font-size:12px;padding:3px ">
	
		
		<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td align="center" width="40">No.</td>
			<td align="center">Nama Pelatih</td>
			<td align="center" width="80">Satlat</td>
			<td align="center" width="80">Jabatan</td>
            
			<td align="center" width="40">Action</td>
		  </tr>
		  <?php echo $str->daftar;?>
		</table>

		
		<br />
		<div align="right"><?php echo $str->nav_first.$str->nav_prev.$str->nav_next.$str->nav_last;?></div>
		<br /><br /><br />

    	</div>

<?php
		
}
else {
	
	echo "<script>alert('untuk mengakses page ini anda harus login terlebih dahulu');</script>";
	exit("<script>location.href='?hal=front';</script>");
	
	}

?>