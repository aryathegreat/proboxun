<?     
require("koneksi.php");
$page = $_POST['page'];
$rp = $_POST['rp'];
$id_event= $_GET['id'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = 'name';
if (!$sortorder) $sortorder = 'desc';
if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);
$limit = "LIMIT $start, $rp";
$sort = "ORDER BY $sortname $sortorder";

$where = "";

$query = mysql_real_escape_string($_POST['query']);
$qtype = $_POST['qtype'];

if ($query) $where = " WHERE id_event LIKE '$id_event' $qtype LIKE '%$query%' ";
$sql = "SELECT id_pelatih,nama_pelatih,satlat,jabatan FROM tb_partpenguji $where $sort $limit";
$result = runSQL($sql);
$numrow = countRec('iso','country',$where);

if($numrow>0){
	$data['page'] = intval($page); 
	$data['total'] = intval($numrow); 
	while ($row = mysql_fetch_array($result)) {
			$rows[] = array(
					"id" => $row['id_pelatih'],
					"cell" => array(
						$row['id_pelatih'],
						$row['nama_pelatih'],
				    	$row['satlat'],
						$row['jabatan'],
						
					)
				);	
	}
} else { 
     	$rows[] = array(
			"id" => 'null',
			"cell" => array(
				'null',
				'null',
				'null',
				'null'
			)
		);		
}

$data['rows'] = $rows;
echo json_encode($data);
exit;
?>