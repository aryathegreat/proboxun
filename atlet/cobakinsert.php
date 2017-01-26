$atlet = mysql_query("select * from tb_alternatif where kelas  = '".$kelas."' order by nama ") or die(mysql_error());
if(is_resource($atlet) and mysql_num_rows($atlet)>0){
   $dataatlet = mysql_fetch_array($atlet);
   $idalternatif = array ($dataatlet['id_alternatif']);
    print_r(array_values($idalternatif));
   //echo $idalternatif ;
}
		 
$jumlah_atlet = count($dataatlet);
echo $jumlah_atlet;

if ( $jumlah_atlet > 0){
	for($x=0; $x<$jumlah_atlet ;$x++){
			mysql_query("INSERT INTO tb_histori(id_histori, id_user, id_alternatif, kelas, nilai, rangking, waktu) values(NULL, '$iduser', '$idalternatif[$x]', '$kelas', '$arr_nf[$x]', '$rangking[$x]', now())");
		}
	}
