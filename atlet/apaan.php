
<?php
//session_start(); /* memulai session */
include '../koneksi.php'; /* membuat koneksi ke database */
include 'promethee80.php';

$q="select * from tb_alternatif where kelas = '80-keatas' order by nama";
$q=mysql_query($q);
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$str->arr_alternatif_id[]=$h['id_alternatif'];
		$str->arr_alternatif_str[]=$h['nama'];
		
		$lf=LF($h['id_alternatif']);
		$ef=EF($h['id_alternatif']);
		$nf=($lf-$ef);
		$rank_lf=0;$rank_ef=0;$rank_nf=0;
		for($i=0;$i<count($arr_lf);$i++){
			if($lf==$arr_lf[$i] and $rank_lf==0){$rank_lf=$i+1;}
			if($ef==$arr_ef[$i] and $rank_ef==0){$rank_ef=$i+1;}
			if($nf==$arr_nf[$i] and $rank_nf==0){$rank_nf=$i+1;}
			/// USE THIS TO RANK IT BITCH !!!!
		}
	
		
		$str->daftar_promethee.='
		  <tr>
			<td>'.$h['nama'].'</td>
			<td align="center">'.$lf.'</td>
			<td align="center">'.$rank_lf.'</td>
			<td align="center">'.$ef.'</td>
			<td align="center">'.$rank_ef.'</td>
		  </tr>
		';
		if($max_1<$lf){
			$max_1=$lf;
			$alternatif_1=$h['nama'];
		}
		if($max_2<$ef){
			$max_2=$ef;
			$alternatif_2=$h['nama'];
		}
		if($max_3<$nf){
			$max_3=$nf;
			$alternatif_3=$h['nama'];
		}
		$str->daftar_promethee1.='
		  <tr> 
			<td>'.$h['nama'].'</td>
			<td align="center">'.$nf.'</td>
			<td align="center">'.$rank_nf.'</td>
		  </tr>
		';
		
		
	}// end of while	


	
}// end of if
if(empty($str->daftar_promethee)){
	$str->daftar_promethee='<tr><td colspan="4"></td></tr>';
	$str->daftar_promethee1='<tr><td colspan="4"></td></tr>';
	}
	
	?>
    <table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td align="center" width="120">Atlet</td>
			<td align="center">Leaving Flow</td>
			<td align="center" width="80">Rank</td>
			<td align="center">Entering Flow</td>
			<td align="center" width="80">Rank</td>
		  </tr>
		  <?php echo $str->daftar_promethee;?>
		</table>
	<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td align="center" width="120">Atlet</td>
			<td align="center">Net Flow</td>
			<td align="center" width="80">Rank</td>
		  </tr>
		  <?php echo $str->daftar_promethee1;?>
		</table>