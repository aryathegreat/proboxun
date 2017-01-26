
<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */

if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{
	
			
	
		 

		
$str->jabatan_str=array('','Ketua','Anggota');
$str->jabatan_list='<option value=""></option>';
for($i=1;$i<=2;$i++){
	if($str->jabatan==$i){$s=' selected';}else{$s='';}
	$str->jabatan_list.='<option value="'.$i.'" '.$s.'>'.$i.'. '.$str->jabatan_str[$i].'</option>';
	
	$str->action=$_GET['action'];
	//$str->action=$_POST['action'];
	if($_GET['action']=='penguji' and !empty($_GET['id'])){
		
	$str->id=$_GET['id'];
	//$str->id=$_POST['id'];
	$q=mysql_query("select * from tb_event where id_event='".$str->id."'");
		if(mysql_num_rows($q)>0){
		$h=mysql_fetch_array($q);
		$str->nama_event=$h['nama_event'];
		$str->tahun=$h['tahun'];
		$str->lokasi=$h['lokasi'];
		$str->tanggal=$h['tanggal'];
		
		}
	}
}

	?>	
	
     
     <title>Data Tim</title>
<fieldset  class="utama">
<legend >Tim Penguji</legend>
		
	<div style="width:80%; float:left; border:1px solid #999; padding:10px;">
		<table>
        
		<input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_idevent" type="hidden" value="<?php echo $str->id;?>">
			<tr>
				<td>Nama Event </td>
				<td><input type="text"  id="namaevent" value="<?php echo $str->nama_event;?>" readonly="true" /></td>
				<td>Lokasi  </td>
				<td><input type="text" id="lokasi"  value="<?php echo $str->lokasi;?>" readonly="true" /></td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td><input type="text" id="tahun" value="<?php echo $str->tahun;?>" readonly="true" /></td>
			
				<td>Tanggal</td>
				<td><input type="text" id="tanggal" value="<?php echo $str->tanggal;?>" readonly="true" /></td>
			</tr>
		</table>
	</div>   
        
        <table width="100%" style="clear:both; width:100%;">
		<tr>
        	<td width="223">ID  </td>
			<td width="223">Nama Pelatih</td>
		
			<td width="244">Satlat</td>
            <td width="241">Jabatan</td>
			
		</tr>
		<tr>
        	<td style="width:210px;"><input type="text" id="txt_idpelatih" style="width:50px;" readonly="true"  /></td>
			<td style="width:210px;"><input type="text" id="txt_namapelatih" style="width:170px;" readonly="true"  /></td>
			<td style="width:230px;"><input type="text" id="txt_satlat" style="width:170px;" readonly="true" /></td>
            <td style="width:230px;"><select name="txt_jabatan"  style="width:170px;" ><?php echo $str->jabatan_list;?></select></td>
			
		</tr>
		<tr>
			
            
		</tr>
         
         <tr>
			<td  colspan="2" style="padding-top:10px;"><button id="pilihpelatih">Pilih Pelatih </button></td>
            <td colspan="2"style="padding-top:10px;"><button id="simpanpelatih">Simpan Pelatih</button> <button id="batalpelatih">Batalkan Pelatih</button> </td>
            
		</tr>
	</table>
     
      
      <div style="overflow:auto; max-height:250px; margin:10px 0 20px 0;" >
		<fieldset>
		<legend style="font-size:14px;">DATA PELATIH</legend>
			<table class="data" id="data_pelatih">
				<tbody>
					<tr>
						<th>ID Pelatih</th>
						<th>Nama Pelatih</th>
						<th>Satlat</th>
						<th>Jabatan</th>
						<th>Opsi</th>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</div>
        


	<div style="display:inline-table; vertical-align:top;">
		<table>
			<tr>
				<td colspan="3" style="padding:20px 0 0 0;" align="right"><button id="simpan" style="font-size:20px;">Simpan</button> <button id="batal" style="font-size:20px;">Batal</button></td>
			</tr>
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
