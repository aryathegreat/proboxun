<?php
session_start(); /* memulai session */
include 'koneksi.php'; /* membuat koneksi ke database */

if (!empty($_SESSION['LOGIN_username']) and $_SESSION['LOGIN_usertype']=='admin') 
	{			
	

	
	$id_event = $_SESSION['id_event'];
	$namaevent = $_SESSION['nama_event'];
		$tahun = $_SESSION['tahun'];
	$lokasi =	$_SESSION['lokasi'];
	$tanggal = $_SESSION['tanggal'];
	
	
	
	if($_GET['action']=='delete' and (int)$_GET['id']>0){
	$str->id=(int)$_GET['id'];
	$q=mysql_query("delete from tb_partatlet where id_partatlet ='".$str->id."'");
	
	exit("<script>window.history.back(); </script>");
	
	}

	?>	
	
     
     <title>Data Tim</title>
<fieldset  class="utama">
<legend style="font-size:14px;">Peserta Seleksi</legend>
		
	<div style="width:80%; float:left; border:1px solid #999; padding:10px;">
		<table>
        
		<input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_idevent" type="hidden" value="<?php echo $id_event;?>">
			<tr>
				<td style="font-size:14px;">Nama Event </td>
				<td><input type="text"  id="namaevent" value="<?php echo $namaevent;?>" readonly style="font-size:13px;"/></td>
				<td style="font-size:14px;">Lokasi  </td>
				<td><input type="text" id="lokasi"  value="<?php echo $lokasi;?>" readonly style="font-size:13px;"/></td>
			</tr>
			<tr>
				<td style="font-size:14px;">Tahun</td>
				<td><input type="text" id="tahun" value="<?php echo $tahun;?>" readonly style="font-size:13px;"/></td>
			
				<td style="font-size:14px;">Tanggal</td>
				<td><input type="text" id="tanggal" value="<?php echo $tanggal;?>" readonly style="font-size:13px;"/></td>
			</tr>
		</table>
	</div>   
        
        <table width="100%" style="clear:both; width:100%;">
		<tr>
        	<td width="223" style="font-size:14px;">ID  </td>
			<td width="223" style="font-size:14px;">Nama Atlet</td>
			<td width="244" style="font-size:14px;">Satlat</td>
            <td width="241" style="font-size:14px;">Kelas</td>
			
		</tr>
		<tr>
        	<td style="width:210px;"><input type="text" id="txt_idatlet" style="width:50px; font-size:13px;" readonly  /></td>
			<td style="width:210px;"><input type="text" id="txt_namaatlet" style="width:170px; font-size:13px;" readonly  /></td>
			<td style="width:230px;"><input type="text" id="txt_satlat" style="width:170px; font-size:13px;" readonly /></td>
            <td style="width:230px;"><select name="txt_kelas" id="txt_kelas">
        <option value="54.1-58 putri"  > 54.1-58 putri </option>
        <option value="58.1-62 putri"   > 58.1-62 putri </option>
        <option value="49.1-52 putra"  > 49.1-52 </option>
        <option value="52.1-55 putra"  > 52.1-55 </option>
        <option value="55.1-58 putra"   > 55.1-58</option>
        <option value="58.1-61 putra" > 58.1-61 </option>
        <option value="61.1-64 putra" > 61.1-64 </option>
        <option value="64.1-67 putra"   > 64.1-67 </option>
        <option value="67.1-70 putra" > 67.1-70 </option>
        <option value="70.1-75 putra" > 70.1-75 </option>
        <option value="75.1-80 putra"   > 75.1-80 </option>
        <option value="80-keatas putra"   > 80 keatas </option>
      	</select>   <em>harus diisi</em>   </td>
			
		</tr>
		<tr>
			
            
		</tr>
         
         <tr>
			<td  colspan="2" style="padding-top:10px;"><button id="pilihatlet">Pilih Atlet </button></td>
            <td colspan="2"style="padding-top:10px;"><button id="simpanatlet">Simpan Atlet</button> <button id="batalatlet">Batalkan Atlet</button> </td>
            
		</tr>
	</table>
     
      
      <div style="overflow:auto; max-height:250px; margin:10px 0 20px 0;" >
		<fieldset>
		<legend style="font-size:12px;">DATA ATLET</legend>
			<table class="data" id="data_atlet">
				<tbody>
					<tr>
						<th style="font-size:14px;" width="20">ID </th>
						<th style="font-size:14px;" width="180">Nama Atlet</th>
						<th style="font-size:14px;" width="60">Satlat</th>
						<th style="font-size:14px;" width="40">Kelas</th>
						<th style="font-size:14px;" width="40">Opsi</th>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</div>
        


	<div style="display:inline-table; vertical-align:top;">
		<table>
			<tr>
				<td colspan="3" style="padding:20px 0 0 0;" align="right"><button id="simpan" style="font-size:14px;">Simpan</button> <button id="batal" style="font-size:14px;">Batal</button></td>
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
				        	<th width="137">Nama Atlet</th>
				            <th width="54">Satlat</th>
				        </tr>
			        </thead>
			        <tbody id="">
			        <?php
					$sql = mysql_query("select * from tb_alternatif ") or die (mysql_error());
					$cek = mysql_num_rows($sql);
					if($cek < 1) { ?>
			            <tr>
			            	<td colspan="9" style="padding:10px;">Data tidak ditemukan</td>
			            </tr>
					<?php } else {
						while($data = mysql_fetch_array($sql)) { ?>
						<tr>
							<td><button class="pilih" id="<?php echo $data['id_alternatif']; ?>" idhid="<?php echo $data['id_alternatif']; ?>" nm="<?php echo $data['nama']; ?>" nmhid="<?php echo $data['nama']; ?>" satlat="<?php echo $data['satlat']; ?>" satlathid="<?php echo $data['satlat']; ?>">Pilih</button></td>
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


 <div id="hasil"></div>
       
 </fieldset>
 
 <div id="hasil"></div>
 
    <script type="text/javascript">
 
 
 $("#simpan").click(function() {
		var ke =  $('#data_atlet tr').length;

		var id_event = <?php echo json_encode($id_event, JSON_HEX_TAG); ?>;
		
		if(id_event == "") {
			alert(" event tidak boleh kosong");
			$("#namaevent").focus();
		
		} else {
			
			for(var i = 1; i < ke; i++) {
				var id_event = <?php echo json_encode($id_event, JSON_HEX_TAG); ?>;
				//var id_event = "1";
				var id_alternatif = $("#id_atlet-"+i).text();
				var nama_alternatif = $("#nama_atlet-"+i).text();
				var satlat = $("#satlat-"+i).text();
				var kelas = $("#kelas-"+i).text();
				$.ajax({
					url : 'admin/proses_simpan_partatlet.php',
					type : 'post',
					data : 'id_event='+id_event+'&id_alternatif='+id_alternatif+'&nama_alternatif='+nama_alternatif+'&satlat='+satlat+'&kelas='+kelas,
					success : function(msg) {
						$("#hasil").html(msg);
					}
				});
			}
			alert("data partisipan telah tersimpan");
			if (document.referrer != "") {
			 var referringURL = document.referrer;
  			 var local = referringURL.substring(referringURL.indexOf("?"), referringURL.length);
  			 location.href = "http://localhost/proboxunv6/index.php" + local; //GANTI DG HOME PAGE 
  			 
			}
		}
	});
 
 $("#batal").click(function() {
		if (document.referrer != "") {
			 var referringURL = document.referrer;
  			 var local = referringURL.substring(referringURL.indexOf("?"), referringURL.length);
  			 location.href = "http://localhost/proboxunv6/index.php" + local; //GANTI DG HOME PAGE 
  			 
			}
	});	
 
	
	 $("#pilihatlet").click(function() {
		$("#bg-popup").fadeIn(700, function() {
			$("#popup").fadeIn(600);
		});
	});	
	
		
		$('.pilih').click(function() {
		var id = $(this).attr("id");
		var nm = $(this).attr("nm");
		var satlat = $(this).attr("satlat");
		///COBAK NGAMBIL DATA DARI PHP KE JAVASCRIPT PAKE JSON 
		////var data = <?php// echo json_encode($id_event, JSON_HEX_TAG); ?>;
	
		$("#txt_idatlet").val(id);
		$("#txt_namaatlet").val(nm);
		$("#txt_satlat").val(satlat);
		
		keluar();
		});
	
	
	$("#batalatlet").click(function () {
		
		$("#txt_idatlet").val("");
		$("#txt_namaatlet").val("");
		$("#txt_satlat").val("");
				
	});
	
	function clear() {
		$("#txt_idatlet").val("");
		$("#txt_namaatlet").val("");
		$("#txt_satlat").val("");
	}
	////////////////////////////////
	


	
	$("#simpanatlet").click(function() {
		var num = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
		var ke =  $('#data_atlet tr').length;
		

		var id_atlet = $("#txt_idatlet").val();
		var nama_atlet = $("#txt_namaatlet").val();
		var satlat = $("#txt_satlat").val();
		var kelas = $("#txt_kelas").val();
		
		if(id_atlet == "") {
			alert(" data atlet kosong, silahkan pilih data ");
			$("#txt_idatlet").focus();
		} else if(kelas == "") {
			alert("kelas tidak boleh kosong");
		} else {
			
					var newRow = "<tr>" +
					"<td style='font-size:14px;' align='center'><span id='id_atlet-"+ke+"'>"+id_atlet+"</span></td>" +
					"<td style='font-size:14px;' align='center'><span id='nama_atlet-"+ke+"'>"+nama_atlet+"</span></td>" +
					"<td  style='border-left:0; font-size:14px;' align='center'><span id='satlat-"+ke+"'>"+satlat+"</span></td>" +
					"<td style='font-size:14px;' align='center'><span id='kelas-"+ke+"'>"+kelas+"</span></td>" +
					"<td><button class='hapus' >Hapus</button></td>"+
					"</tr>";
					$('#data_atlet > tbody').append(newRow);
					clear();
   
				}	
	});
	
	
	$("#data_atlet").on("click", ".hapus", function() {
		$(event.target).closest("tr").remove();

		
	});
	
	////////////////////////////////
	
	
	
	
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
