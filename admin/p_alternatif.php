<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */

if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{


$str->nav_link='hal=data_alternatif';
$str->edit_link='hal=tambah_alternatif';
$str->maxresult=10;
$str->hal=(int)$_GET['n'];
$qq="select * from ".$table_prefix."alternatif";

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

$q="select * from ".$table_prefix."alternatif order by kelas limit ".$str->hal.",".$str->maxresult;
$sql=mysql_query($q);
if(mysql_num_rows($sql) > 0){
	$i=$str->hal;
	while($h=mysql_fetch_array($sql)){
		$i++;
		//if($h['kelas']==0){$str->kelas='';}else{$str->kelas=$h['kelas'];}
		$str->daftar.='
		  <tr>
			<td valign="top">'.$i.'</td>
			<td valign="top">'.$h['nama'].'</td>
			<td valign="top">'.$h['alamat'].'</td>
			<td valign="top">'.$h['jenis_kelamin'].'</td>
			<td valign="top">'.$h['satlat'].'</td>
			<td valign="top">'.$h['umur'].'</td>
			<td valign="top">'.$h['kelas'].'</td>
			<td valign="top">'.$h['keterangan'].'</td>
			<td align="center" valign="top"><a href="?'.$str->edit_link.'&amp;id='.$h['id_alternatif'].'&amp;action=delete"><img src="images/delete.png"></a> <a href="?'.$str->edit_link.'&amp;id='.$h['id_alternatif'].'&amp;action=edit"><img src="images/edit.png"></a> </td>
		  </tr>
		';
	}
}


?>
        <div style="font-family:Arial;font-size:12px;padding:3px ">
		<div style="font-size:18px;padding:10px 0 10px 0 ">DATA ALTERNATIF</div>
		<div align="right"><a href="?hal=tambah_alternatif&amp;action=new">Tambah Data</a></div><br>
		<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td align="center" width="20">No.</td>
			<td align="center" width="160">Nama </td>
            <td align="center" width="160">Alamat </td>
            <td align="center" width="80">Jenis Kelamin </td>
            <td align="center" width="160">Satlat </td>
            <td align="center" width="30">Umur </td>
            <td align="center" width="50">Kelas </td>
			<td align="center">Keterangan</td>
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