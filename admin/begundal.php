$("#simpan").click(function() {
		var ke =  $('#data_pelatih tr').length;

		var id_event = <?php echo json_encode($id_event, JSON_HEX_TAG); ?>;
		
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