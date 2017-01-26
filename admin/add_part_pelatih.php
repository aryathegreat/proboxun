<a href=""><button style="border-top-left-radius:7px; border-bottom-left-radius:7px;">Input Penjualan</button></a> <a href=""><button style="border-top-right-radius:7px; border-bottom-right-radius:7px;">Lihat Data Penjualan</button></a>
<div style="margin-top:10px;">
<?php
if(@$_GET['action'] == 'view') {
	include "data_penjualan.php";
} else if(@$_GET['action'] == 'input') {

$tanggal = date('d-m-Y');
$sekarang = date('ymd');
$carikode = mysql_query("select max(no_nota) from tb_penjualan") or die (mysql_error());
$datakode = mysql_fetch_row($carikode);
if($datakode) {
	$nilaikode = substr($datakode[0], 7);
	$kode = (int) $nilaikode;
	$kode = $kode+1;
	$hasilkode = $sekarang.str_pad($kode, 3 , "0", STR_PAD_LEFT);
} else {
	$hasilkode = $sekarang."001";
}

if(@$_SESSION['admin']) {
	$kode_user = @$_SESSION['admin'];
} else if(@$_SESSION['kasir']) {
	$kode_user = @$_SESSION['kasir'];
}
$sql_user = mysql_query("select * from tb_user where kode_user = '$kode_user'") or die (mysql_error());
$data_user = mysql_fetch_array($sql_user); ?>

<title>Transaksi Penjualan</title>
<fieldset class="utama">
<legend>Transaksi Kasir</legend>
	<div style="width:47%; float:left; border:1px solid #999; padding:10px;">
		<table>
			<tr>
				<td>No. Nota</td>
				<td><input type="number" id="nonota" value="<?php echo $hasilkode; ?>" disabled="disabled" /></td>
			</tr>
			<tr>
				<td>Pelanggan</td>
				<td><input type="text" id="pelanggan" /></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td><input style="width:80px" type="text" id="tgljual" class="datepicker" value="<?php echo $tanggal; ?>" /></td>
			</tr>
		</table>
	</div>

	<div style="width:47%; float:right; border:1px solid #999; padding:10px;">
		<div style="padding:28px; font-size:30px; font-weight:bold; color:#f00;">
			Tagihan : Rp. <span id="tagihan">0</span>
		</div>
	</div>

	<table style="clear:both; width:100%;">
		<tr>
			<td>Kode Barang</td>
			<td>Nama Barang</td>
			<td>Stok</td>
			<td>Harga Satuan</td>
			<td>Jumlah Jual</td>
			<td>Harga Akhir</td>
		</tr>
		<tr>
			<td style="width:210px;"><input type="text" id="kodebarang" style="width:170px;" placeholder="Input kode barang dan enter" /></td>
			<td style="width:210px;"><input type="text" id="namabarang" style="width:170px;" disabled="disabled" /></td>
			<td style="width:170px;"><input type="text" id="stokbarang" style="width:130px;" disabled="disabled" /></td>
			<td style="width:230px;"><i>Rp. </i><input type="text" id="hargabarang" style="width:170px;" disabled="disabled" /></td>
			<td style="width:170px;"><input type="text" id="jumlahjual" style="width:130px;" /></td>
			<td><i>Rp. </i><input type="text" id="hargaakhir" style="width:180px;" value="0" disabled="disabled" /></td>
		</tr>
		<tr>
			<td colspan="3" style="padding-top:10x;"><button id="caribarang">Cari Barang</button></td>
			<td><i>Kasir : <span style="color:#f00;" id="kasir"><?php echo $data_user['nama_lengkap']; ?></span></i></td>
			<td colspan="3" align="right" style="padding-top:10px;"><button id="simpanitem">Simpan Item</button> <button id="batalitem">Batal Item</button> <button id="hapussemuaitem">Hapus Semua Item</button></td>
		</tr>
	</table>
	<div style="overflow:auto; max-height:250px; margin:10px 0 20px 0;" >
		<fieldset>
		<legend style="font-size:14px;">Barang yang dijual</legend>
			<table class="data" id="barang_dijual">
				<tbody>
					<tr>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th colspan="2">Harga Satuan</th>
						<th>Jumlah Jual</th>
						<th colspan="2">Harga Akhir</th>
						<th>Opsi</th>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</div>

	<div style="border:1px solid #999; padding:10px; width:25%; display:inline-table;">
		<table>
			<tr>
				<td>Sub Total</td>
				<td>:</td>
				<td><i>Rp. </i><input type="text" id="subtotal" style="width:180px;" disabled="disabled" /></td>
			</tr>
			<tr>
				<td>Diskon</td>
				<td>:</td>
				<td><input type="text" id="persen" value="0" style="width:50px;" />% &nbsp=&nbsp <i>Rp. </i><input type="text" id="diskonharga" value="0" style="width:82px;" /></td>
			</tr>
			<tr>
				<td>Total Harga</td>
				<td>:</td>
				<td><i>Rp. </i><input type="text" id="totalharga" style="width:180px;" disabled="disabled" /></td>
			</tr>
		</table>
	</div>

	<div style="display:inline-table; vertical-align:top;">
		<table>
			<tr>
				<td>Bayar</td>
				<td>:</td>
				<td><i>Rp. </i><input type="text" id="bayar" style="width:180px;" />
			</tr>
			<tr>
				<td>Kembalian</td>
				<td>:</td>
				<td><i>Rp. </i><input type="text" id="kembalian" style="width:180px;" disabled="disabled" />
			</tr>
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
				        	<th>Kode Barang</th>
				            <th>Nama Barang</th>
				            <th>Satuan</th>
				            <th colspan="2">Harga Satuan</th>
				            <th>Stok</th>
				            <th>Masuk Terakhir</th>
				        </tr>
			        </thead>
			        <tbody id="barang">
			        <?php
					$sql = mysql_query("select * from tb_barang") or die (mysql_error());
					$cek = mysql_num_rows($sql);
					if($cek < 1) { ?>
			            <tr>
			            	<td colspan="9" style="padding:10px;">Data tidak ditemukan</td>
			            </tr>
					<?php } else {
						while($data = mysql_fetch_array($sql)) { ?>
						<tr>
							<td><button class="pilih" kd="<?php echo $data['kode_barang']; ?>" nm="<?php echo $data['nama_barang']; ?>" stok="<?php echo $data['stok_sisa']; ?>" hs="<?php echo $data['harga_jual']; ?>">Pilih</button> <?php echo $data['kode_barang']; ?></td>
							<td><?php echo $data['nama_barang']; ?></td>
							<td><?php echo $data['satuan']; ?></td>
							<td>Rp. </td><td align="right" style="border-left:0;"><?php echo number_format($data['harga_jual'], 2, ".", ","); ?></td>
							<td align="right"><?php echo $data['stok_sisa']	; ?></td>
							<td><?php echo $data['tanggal']; ?></td>
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

<div id="hasil"></div>

<script type="text/javascript">

	$(window).load(function(){
		$("#nonota").focus();

		$("#diskonharga").number(true, 2);
		$("#bayar").number(true, 2);
	});

	$("#simpan").click(function() {
		var ke =  $('#barang_dijual tr').length;

		var nonota = $("#nonota").val();
		var tgljual = $("#tgljual").val();
		var pelanggan = $("#pelanggan").val();
		var kasir = $("#kasir").text();
		var subtotal = $("#subtotal").val();
		var diskonpersen = $("#persen").val();
		var diskonharga = $("#diskonharga").val();
		var totalharga = $("#totalharga").val();
		var bayar = $("#bayar").val();
		if(nonota == "") {
			alert("No. Nota tidak boleh kosong");
			$("#nonota").focus();
		} else if(pelanggan == "") {
			alert("Pelanggan tidak boleh kosong");
			$("#pelanggan").focus();
		} else if(tgljual == "") {
			alert("Tanggal jual tidak boleh kosong");
			$("#tgljual").focus();
		} else if(ke == 1) {
			alert("Belum ada barang yang dijual di dalam daftar");
		
		} else if(subtotal == "") {
			alert("Sub total harga kosong, silahkan tambahkan barang");
			$("#subtotal").focus();
		} else if(totalharga == "") {
			alert("Total harga tidak boleh kosong");
			$("#totalharga").focus();
		} else if(bayar == "") {
			alert("Uang pembayaran kosong");
			$("#bayar").focus();
		} else if(bayar < totalharga) {
			alert("Pembayaran belum lunas");
			$("#bayar").focus();
		} else {
			$.ajax({
				url : 'inc/proses_simpan_penjualan.php',
				data : 'nonota='+nonota+'&tgljual='+tgljual+'&pelanggan='+pelanggan+'&kasir='+kasir+'&subtotal='+subtotal+'&diskonpersen='+diskonpersen+'&diskonharga='+diskonharga+'&totalharga='+totalharga,
				type : 'POST',
				success : function(msg) {
					$("#hasil").html(msg);
				}
			});


			for(var i = 1; i < ke; i++) {
				var kodebarang = $("#kodebarang-"+i).text();
				var namabarang = $("#namabarang-"+i).text();
				var hargasatuan = $("#hargasatuan-"+i).text();
				var jumlahjual = $("#jumlahjual-"+i).text();
				var hargaakhir = $("#hargaakhir-"+i).text();
				$.ajax({
					url : 'inc/proses_simpan_barang_terjual.php',
					type : 'post',
					data : 'kodebarang='+kodebarang+'&namabarang='+namabarang+'&jumlahjual='+jumlahjual+'&hargasatuan='+hargasatuan+'&hargaakhir='+hargaakhir+'&nonota='+nonota,
					success : function(msg) {
						$("#hasil").html(msg);
					}
				});
			}

			alert("Penjualan telah tersimpan");
			window.location.href="?page=penjualan&action=input";
		}
	});

	$("#caribarang").click(function() {
		$("#bg-popup").fadeIn(700, function() {
			$("#popup").fadeIn(600);
		});
	});

	$("#kodebarang").keyup(function(e) {
		var kodebarang = $("#kodebarang").val();
		if(e.keyCode == 13) {
			$.ajax({
				url : 'inc/cari_barang_penjualan.php',
				type : 'post',
				data : 'kodebarang='+kodebarang,
				success : function(msg) {
					$("#hasil").html(msg);
				}
			});
		}
	});

	function keluar() {
		$("#popup").fadeOut(400, function() {
			$("#bg-popup").fadeOut(600);
		});
	}

	$("#keluar").click(function() {
		keluar();
	});

	$('.pilih').click(function() {
		var kd = $(this).attr("kd");
		var nm = $(this).attr("nm");
		var stok = $(this).attr("stok");
		var hs = $(this).attr("hs");
		$("#kodebarang").val(kd);
		$("#namabarang").val(nm);
		$("#stokbarang").attr("value", stok);
		$("#stokbarang").val(stok);
		$("#hargabarang").val(hs).number(true, 2);
		keluar();
		$("#jumlahjual").val("");
		$("#hargaakhir").val("0");
		$("#jumlahjual").focus();
	});

	$("#simpanitem").click(function() {
		var num = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
		var ke =  $('#barang_dijual tr').length;

		var kodebarang = $("#kodebarang").val();
		var namabarang = $("#namabarang").val();
		var stokbarang = $("#stokbarang").attr("value");
		var hargabarang = $("#hargabarang").val();
		var jumlahjual = $("#jumlahjual").val();
		var hargaakhir = $("#hargaakhir").val();
		if(kodebarang == "") {
			alert("Kode barang kosong, silahkan cari barang");
			$("#kodebarang").focus();
		} else if(stokbarang == "") {
			alert("Stok barang tidak boleh kosong");
		} else {

			if (!num.test(jumlahjual)) {
				alert("Jumlah jual harus diisi ! (hanya angka)");
				$("#jumlahjual").focus();
				$("#jumlahjual").val("");
				$("hargaakhir").val("");
			} else {
				if((jumlahjual - stokbarang) >= 1) {
					alert("Barang yang dijual tidak boleh melebihi jumlah stok");
				} else if((stokbarang - jumlahjual) == stokbarang) {
					alert("Barang yang dijual tidak boleh kosong (0)");
				} else {
					var newRow = "<tr>" +
					"<td><span id='kodebarang-"+ke+"'>"+kodebarang+"</span></td>" +
					"<td><span id='namabarang-"+ke+"'>"+namabarang+"</span></td>" +
					"<td>Rp. </td>"+
					"<td align='right' style='border-left:0;'><span id='hargasatuan-"+ke+"'>"+hargabarang+"</span></td>" +
					"<td align='center'><span id='jumlahjual-"+ke+"'>"+jumlahjual+"</span></td>" +
					"<td>Rp. </td>"+
					"<td style='text-align:right; border-left:0;'><span class='harga-akhir-tabel' id='hargaakhir-"+ke+"'>"+hargaakhir+"</span></td>" +
					"<td><button class='hapus' ha='"+hargaakhir+"'>Hapus</button></td>"+
					"</tr>";
					$('#barang_dijual > tbody').append(newRow);
					clear();
					
					var ha_tbl = 0;
				    $(".harga-akhir-tabel").each(function(index, element) {
				        ha_tbl += parseInt($(element).text());
				    });
				    $("#subtotal").val(ha_tbl).number(true, 2);

				    $("#totalharga").val($("#subtotal").val()).number(true, 2);
				    $("#tagihan").text($("#subtotal").val()).number(true, 2);
				    // $("#stokbarang").val(stokbarang-jumlahjual);
				}
			}
		}
	});

	$("#barang_dijual").on("click", ".hapus", function() {
		$(event.target).closest("tr").remove();

		var ha_tbl = 0;
	    $(".harga-akhir-tabel").each(function(index, element) {
	        ha_tbl += parseInt($(element).text());
	    });
	    $("#subtotal").val(ha_tbl).number(true, 2)-$(this).attr("ha");

	    $("#totalharga").val($("#subtotal").val()).number(true, 2);
	    $("#tagihan").text($("#subtotal").val()).number(true, 2);
	});

	$("#hapussemuaitem").click(function() {
	    $("#barang_dijual td").parent().remove();

	    $("#subtotal").val("");
	    $("#totalharga").val("");
	    $("#tagihan").text("0");
	});

	$("#batalitem").click(function () {
		$("#kodebarang").val("");
		$("#namabarang").val("");
		$("#stokbarang").val("");
		$("#hargabarang").val("");
		$("#jumlahjual").val("");
		$("#hargaakhir").val("0");
	});
	
	function clear() {
		$("#kodebarang").val("");
		$("#namabarang").val("");
		$("#stokbarang").val("");
		$("#hargabarang").val("");
		$("#jumlahjual").val("");
		$("#hargaakhir").val("0");
	}

	$("#jumlahjual").keyup(function() {
		var hargabarang = $("#hargabarang").val();
		var jumlahjual = $(this).val();
		$("#hargaakhir").val(hargabarang*jumlahjual).number(true, 2);
	});

	$("#persen").keyup(function() {
		var diskonpersen = $(this).val();
		var subtotal = $("#subtotal").val();
		$("#diskonharga").val(subtotal*diskonpersen/100);

		var diskonharga = $("#diskonharga").val();
		$("#totalharga").val(subtotal-diskonharga);
		$("#tagihan").text(subtotal-diskonharga).number(true, 2);
	});

	$("#diskonharga").keyup(function() {
		var diskonharga = $(this).val();
		var subtotal = $("#subtotal").val();
		$("#persen").val(diskonharga/subtotal*100);

		$("#totalharga").val(subtotal-diskonharga);
		$("#tagihan").text(subtotal-diskonharga).number(true, 2);
	});
	
	$("#bayar").keyup(function(){
		var bayar = $(this).val();
		$("#kembalian").val(bayar-$("#totalharga").val()).number(true, 2);
	});

	$("#batal").click(function() {
		$("#kodebarang").val("");
		$("#namabarang").val("");
		$("#stokbarang").val("");
		$("#hargabarang").val("");
		$("#jumlahjual").val("");
		$("#hargaakhir").val("0");

		$("#barang_dijual td").parent().remove();

	    $("#subtotal").val("");
	    $("#totalharga").val("");
	    $("#tagihan").text("0");

	    $("#pelanggan").val("");
	    $("#persen").val("");
	    $("#diskonharga").val("");
	    $("#bayar").val("");
	    $("#kembalian").val("");
	});

</script>

<?php } else if(@$_GET['action'] == "delete") {
	include "delete_penjualan.php";
} ?>
</div>
