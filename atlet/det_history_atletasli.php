<?php
session_start(); /* memulai session */
include '../koneksi.php'; /* membuat koneksi ke database */
if ( !empty($_SESSION['LOGIN_username']) and !empty($_SESSION['LOGIN_event']) and $_SESSION['LOGIN_usertype']!='admin') 
	{

$str->nav_link='hal=dethistory_atlet';



for($i=1;$i<=2;$i++){
	
	$str->action=$_GET['action'];
	if($_GET['action']=='history' and !empty($_GET['id'])){	
	$str->id=$_GET['id'];
	$q=mysql_query("SELECT 
	tb_partatlet.id_partatlet,
	tb_partatlet.id_alternatif,
	tb_alternatif.nama, 
	tb_alternatif.satlat, 
	tb_alternatif.jenis_kelamin 
	FROM tb_partatlet
	JOIN tb_alternatif ON tb_partatlet.id_alternatif = tb_alternatif.id_alternatif WHERE CONCAT (tb_partatlet.id_alternatif) ='".$str->id."'");
		if(mysql_num_rows($q)>0){
		$h=mysql_fetch_array($q);
		$str->nama_alternatif=$h['nama'];
		$str->satlat=$h['satlat'];
		$str->jenis_kelamin=$h['jenis_kelamin'];
		
		
		
		/*
		$_SESSION['id_event'] = $_GET['id'];
		$_SESSION['nama_event']=$h['nama_event'];
		$_SESSION['tahun']=$h['tahun'];
		$_SESSION['lokasi']=$h['lokasi'];
		$_SESSION['tanggal']=$h['tanggal']; */
		
		}
	}
	}


$str->maxresult=10;
$str->hal=(int)$_GET['n'];
$qq="select * from tb_partatlet where id_alternatif ='".$str->id."'";
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
$q="SELECT 
tb_partatlet.id_partatlet,
tb_partatlet.id_alternatif,
tb_partatlet.kelas, 
tb_histori.rangking,
tb_histori.waktu, 
tb_event.nama_event, 
tb_event.tahun
FROM tb_partatlet
JOIN tb_event ON tb_partatlet.id_event = tb_event.id_event
JOIN tb_histori ON tb_histori.id_partatlet = tb_partatlet.id_partatlet WHERE CONCAT (tb_partatlet.id_alternatif) ='".$str->id."' limit ".$str->hal.",".$str->maxresult;
$sql=mysql_query($q);
if(mysql_num_rows($sql) > 0){
	$i=$str->hal;
	while($h=mysql_fetch_array($sql)){
		$i++;
		$str->daftar.='
		  <tr>
			<td valign="top">'.$i.'</td>
			<td valign="top">'.$h['nama_event'].'</td>
			<td valign="top" align="center">'.$h['tahun'].'</td>
			<td valign="top" align="center">'.$h['kelas'].'</td>
			<td valign="top" align="center">'.$h['rangking'].'</td>
			<td valign="top" align="center">'.$h['waktu'].'</td>
			
		  </tr>
		';
	}
}





?>

 <title>Data Tim</title>
<fieldset  class="utama">
<legend style="font-size:14px;">Peserta Seleksi</legend>
		
	<div style="width:96%; float:left; border:1px solid #999; padding:10px;">
		<table>
        <form action="" name="" method="post">
		<input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_idevent" type="hidden" value="<?php echo $str->id;?>">
			<tr>
				<td style="font-size:14px;">Nama Atlet </td>
                
				<td><input type="text"  id="namaatlet" value="<?php echo $str->nama_alternatif;?>" readonly style="font-size:13px;"/></td>
            </tr>    
            <tr>
				<td style="font-size:14px;">Satlat  </td>
				<td><input type="text" id="satlat"  value="<?php echo $str->satlat;?>" readonly style="font-size:13px;"/></td>
                
			</tr>
			<tr>
				<td style="font-size:14px;">Jenis Kelamin</td>
				<td><input type="text" id="jenis_kelamin" value="<?php echo $str->jenis_kelamin;?>" readonly style="font-size:13px;"/></td>
			
				
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
			<td align="center">Nama Event</td>
			<td align="center" width="80">Tahun</td>
			<td align="center" width="80">Kelas</td>
            <td align="center" width="80">Rangking</td>       
			<td align="center" width="40">Waktu</td>
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