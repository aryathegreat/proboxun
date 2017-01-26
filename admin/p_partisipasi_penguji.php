<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */

if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{
		
	?>	
		
     
     <title>Data Tim</title>
<fieldset class="utama">
<legend>Tim Penguji</legend>
	<div style="width:47%; float:left; border:1px solid #999; padding:10px;">
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
        
        <table style="clear:both; width:100%;">
		<tr>
			<td>Nama Pelatih</td>
			
			<td>Jenis Kelamin</td>
			<td>Satlat</td>
            <td>Jabatan</td>
			
		</tr>
		<tr>
			<td style="width:210px;"><input type="text" id="namapelatih" style="width:170px;" placeholder="Input kode barang dan enter" /></td>
			<td style="width:170px;"><input type="text" id="jeniskelamin" style="width:130px;" disabled="disabled" /></td>
			<td style="width:230px;"><input type="text" id="satlat" style="width:170px;" disabled="disabled" /></td>
            <td style="width:230px;"><input type="text" id="jabatan" style="width:170px;" disabled="disabled" /></td>
			
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
       
       
       
       
       
       	<div id="bg-popup">
		<div style="margin-top:100px; margin-left:23%;">
			<div id="popup">
				<div style="overflow:auto; max-height:400px; width:700px;" >
				<table class="data">
			        <thead>
				        <tr>
				        	<th>Nama Pelatih</th>
				            <th>Jenis Kelamin</th>
				            <th>Satlat</th>
				        </tr>
			        </thead>
			        <tbody id="barang">
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
							<td><button class="pilih" kd="<?php echo $data['nama']; ?>" nm="<?php echo $data['nama']; ?>" stok="<?php echo $data['jenis_kelamin']; ?>" hs="<?php echo $data['satlat']; ?>">Pilih</button> <?php echo $data['nama']; ?></td>
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
	    <button style="border-radius:10px; margin-left:20.5%; position:absolute; z-index:5; margin-top:-20px;" id="keluar">Keluar</button>
	</div>
       
       
<?php 		
		}
else {
	
	echo "<script>alert('untuk mengakses page ini anda harus login terlebih dahulu');</script>";
	exit("<script>location.href='?hal=front';</script>");
	
	}

?>