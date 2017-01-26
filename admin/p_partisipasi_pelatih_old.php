
<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */

if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{
	
			
	
		 
//$str->nav_link='hal=data_event';
//$str->edit_link='hal=add_daftar_penguji';
		
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

	?>	
	
     
     <title>Data Tim</title>
<fieldset  class="utama">
<legend style="font-size:14px;">Tim Penguji</legend>
		
	<div style="width:90%; float:left; border:1px solid #999; padding:10px;">
		<table>
        <form action="" name="" method="post">
		<input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_idevent" type="hidden" value="<?php echo $str->id;?>">
			<tr>
				<td style="font-size:14px;">Nama Event </td>
				<td><input type="text"  id="namaevent" value="<?php echo $str->nama_event;?>" readonly="true" style="font-size:13px;"/></td>
				<td style="font-size:14px;">Lokasi  </td>
				<td><input type="text" id="lokasi"  value="<?php echo $str->lokasi;?>" readonly="true" style="font-size:13px;"/></td>
                <td style="font-size:14px;"><a href="?hal=add_daftar_penguji">Kelola Tim</a> </td>
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
      <p>&nbsp;</p>
      <p>&nbsp;</p>
 	  <p>&nbsp;</p>
      <p>&nbsp; </p>
 
      <div style="overflow:auto; max-height:250px; margin:10px 0 20px 0;" >
		<fieldset>
		
			
    <table class="table">
    <tr>
    
    </tr>
	<tr>
		<th style="font-size:14px;">No</th>
		<th style="font-size:14px;">Nama Pelatih </th>
		<th style="font-size:14px;">Satlat</th>
		<th style="font-size:14px;">Jabatan</th>				
		<th style="font-size:14px;">Opsi</th>
	</tr>
	<?php  /// editlah sebaik mungkin .. tb_partpenguji
	
	$brg=mysql_query("select * from tb_partpenguji where id_event='".$str->id."'");
	
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td style="font-size:14px;"><?php echo $no++ ?></td>
			<td style="font-size:14px;"><?php echo $b['nama_pelatih'] ?></td>
			<td style="font-size:14px;"><?php echo $b['satlat'] ?></td>
			<td style="font-size:14px;"><?php echo $b['jabatan'] ?></td>			
			<td style="font-size:14px;">		
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_laku.php?id=<?php echo $b['id']; ?>&jumlah=<?php echo $b['jumlah'] ?>&nama=<?php echo $b['nama']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>

		<?php 
	}
	?>
</table>
	
		
	</div>
    
       


	
       
       
		<div id="bg-popup">
		<div style="margin-top:100px; margin-left:23%;">
			<div id="popup">
				<div style="overflow:auto; max-height:400px; width:700px;" >
				<table width="413" class="data">
			        <thead>
				        <tr>
                        	<th width="66">Aksi</th>
                        	<th width="37">ID</th>
				        	<th width="137">Nama Pelatih</th>
				            
				            <th width="54">Satlat</th>
				        </tr>
			        </thead>
			        <tbody id="pelatih">
			        <?php
					$sql = mysql_query("select * from tb_user where username != 'admin'") or die (mysql_error());
					$cek = mysql_num_rows($sql);
					if($cek < 1) { ?>
			            <tr>
			            	<td colspan="9" style="padding:10px;">Data tidak ditemukan</td>
			            </tr>
					<?php } else {
						while($data = mysql_fetch_array($sql)) { ?>
						<tr>
							<td><button class="pilih" id="<?php echo $data['id_admin']; ?>" idhid="<?php echo $data['id_admin']; ?>" nm="<?php echo $data['nama']; ?>" nmhid="<?php echo $data['nama']; ?>" satlat="<?php echo $data['satlat']; ?>" satlathid="<?php echo $data['satlat']; ?>">Pilih</button></td>
						    <td><?php echo $data['id_admin']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
							<td><?php echo $data['satlat']; ?></td>
							
						</tr>
						<?php }
					} ?>
			        </tbody>
				</table>
				</div>
			</div>
	    </div>
	     <button style="border-radius:10px; margin-left:20.5%; position:absolute; z-index:5; margin-top:-20px;" id="keluar">Keluar</button>
	</div> 
       
 </fieldset>
 	<script src="jquery.js"></script>
    <script src="jquery-ui.js"></script>
    <script src="jquery-number.js"></script>
    <script type="text/javascript">
    
	
	
	 $("#pilihpelatih").click(function() {
		$("#bg-popup").fadeIn(700, function() {
			$("#popup").fadeIn(600);
		});
	});	
		
		$('.pilih').click(function() {
		var id = $(this).attr("id");
		var nm = $(this).attr("nm");
		var satlat = $(this).attr("satlat");
		
		var idhid = $(this).attr("idhid");
		var nmhid = $(this).attr("nmhid");
		var satlathid = $(this).attr("satlathid");
		
		$("#txt_idpelatih").val(id);
		$("#txt_namapelatih").val(nm);
		$("#txt_satlat").val(satlat);
		$("#hid_idpelatih").val(idhid);
		$("#hid_namapelatih").val(nmhid);
		$("#hid_satlat").val(satlathid);
		keluar();
		});
	
	
	$("#batalpelatih").click(function () {
		
		$("#txt_idpelatih").val("");
		$("#txt_namapelatih").val("");
		$("#txt_satlat").val("");
		$("#hid_idpelatih").val("");
		$("#hid_namapelatih").val("");
		$("#hid_satlat").val("");		
	});
	
	function keluar() {
		$("#popup").fadeOut(400, function() {
			$("#bg-popup").fadeOut(600);
		});
	}

	$("#keluar").click(function() {
		keluar();
	});

	
	
    </script>
      
<?php 		
		}
else {
	
	echo "<script>alert('untuk mengakses page ini anda harus login terlebih dahulu');</script>";
	exit("<script>location.href='?hal=front';</script>");
	
	}

?>
