<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <link type="text/css" rel="stylesheet" href="development-bundle/themes/ui-lightness/ui.all.css" />
    
    <link rel="stylesheet" href="style/jquery-ui.css" />
    <script src="jquery-1.12.4.js"></script>
  	<script src="jquery-ui.js"></script>
    <script type="text/javascript">
     $( function() {
    var dialog, form,  
	  
	
	  dialog = $( "#popup" ).dialog({
      autoOpen: false,
      height: 400,
      width: 600,
      modal: true,
     
    });
	form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
	
	 function keluar() {
		$("#popup").fadeOut(400); 
		
	}

	$("#keluar").click(function() {
		keluar();
	});
	
	$( "#pilihpelatih" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
	 } );	
		
		$("#pilih").button().on( "click", function()  {
		var id = $(this).attr("id");
		var nm = $(this).attr("nm");
		var jk = $(this).attr("jk");
		var satlat = $(this).attr("satlat");
		$("#txt_idpelatih").val(id);
		$("#txt_namapelatih").val(nm);
		$("#txt_jeniskelamin").val(jk);
		$("#txt_satlat").val(satlat);
		
		keluar();
		
	});
	
    </script>
</head>
<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */

if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{
		
		
$str->jabatan_str=array('','Ketua Tim Pelatih','Anggota Pelatih ');
$str->jabatan_list='<option value=""></option>';
for($i=1;$i<=2;$i++){
	if($str->jabatan==$i){$s=' selected';}else{$s='';}
	$str->jabatan_list.='<option value="'.$i.'" '.$s.'>'.$i.'. '.$str->jabatan_str[$i].'</option>';
}
	?>	
	
     
     <title>Data Tim</title>
<fieldset  class="utama">
<legend >Tim Penguji</legend>
	<div style="width:80%; float:left; border:1px solid #999; padding:10px;">
		<table>
			<tr>
				<td>Nama Event</td>
				<td><input type="text"  id="nama_event" value="<?php echo $str->nama_event;?>" disabled="disabled" /></td>
			<td>Lokasi</td>
				<td><input type="text" id="lokasi"  value="<?php echo $str->lokasi;?>" disabled="disabled" /></td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td><input type="text" id="tahun" value="<?php echo $str->tahun;?>" disabled="disabled" /> </td>
			
				<td>Tanggal</td>
				<td><input type="text" id="tahun" value="<?php echo $str->tanggal;?>" disabled="disabled" /> </td>
			</tr>
		</table>
	</div>   
        
        <table width="100%" style="clear:both; width:100%;">
		<tr>
        	<td width="223">ID </td>
			<td width="223">Nama Pelatih</td>
			
			<td width="180">Jenis Kelamin</td>
			<td width="244">Satlat</td>
            <td width="241">Jabatan</td>
			
		</tr>
		<tr>
        	<td style="width:210px;"><input type="text" id="txt_idpelatih" style="width:50px;"   /></td>
			<td style="width:210px;"><input type="text" id="txt_namapelatih" style="width:170px;" disabled="disabled"  /></td>
			<td style="width:170px;"><input type="text" id="txt_jeniskelamin" style="width:130px;" disabled="disabled" /></td>
			<td style="width:230px;"><input type="text" id="txt_satlat" style="width:170px;" disabled="disabled" /></td>
            <td style="width:230px;"><select name="txt_jabatan"  style="width:170px;" ><?php echo $str->jabatan_list;?></select> </td>
			
		</tr>
		<tr>
			<td colspan="3" style="padding-top:10x;"><button id="pilihpelatih">Pilih Pelatih </button></td>
			
			<td colspan="3" align="right" style="padding-top:10px;"><button id="simpanitem">Setujui Pelatih</button> <button id="batalitem">Batalkan Pelatih</button> <button id="hapussemuaitem">Hapus Semua Data</button></td>
		</tr>
	</table>
      
      <div style="overflow:auto; max-height:250px; margin:10px 0 20px 0;" >
		<fieldset>
		<legend style="font-size:14px;">Daftar Tim Pelatih</legend>
			<table class="data" id="tim_pelatih">
				<tbody>
					<tr>
						
						<th>Nama Pelatih</th>
						<th colspan="2">Jenis Kelamin</th>
						<th>Satlat</th>
						<th colspan="2">Jabatan</th>
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
       
       
       
       
       
       
			<div id="popup">
				<div style="overflow:auto; max-height:400px; width:900px;" >
				<table width="413" class="data">
			        <thead>
				        <tr>
                        	<th width="66">Aksi</th>
                        	<th width="37">ID</th>
				        	<th width="137">Nama Pelatih</th>
				            <th width="95">Jenis Kelamin</th>
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
							<td><button id="pilih" class="pilih" id="<?php echo $data['id_admin']; ?>" nm="<?php echo $data['nama']; ?>" jk="<?php echo $data['jenis_kelamin']; ?>" satlat="<?php echo $data['satlat']; ?>">Pilih</button></td>
						      <td><?php echo $data['id_admin']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
							<td><?php echo $data['jenis_kelamin']; ?></td>
							<td><?php echo $data['satlat']; ?></td>
							
						</tr>
						<?php }
					} ?>
			        </tbody>
				</table>
				</div>
			</div>
	    </div>
	    
       
 </fieldset>
      
<?php 		
		}
else {
	
	echo "<script>alert('untuk mengakses page ini anda harus login terlebih dahulu');</script>";
	exit("<script>location.href='?hal=front';</script>");
	
	}

?>
</body>
</html>