<?php 
	require 'lib/controller.php';
	$perintah = new oop();
	$date = date("Y-m-d");
	$id = $_GET['id'];
	$summ = $perintah->sum_where("sub_total","jumlah","table_pretransaksi","kd_transaksi",$id);
	$jumlah_beli = $perintah->sum_where("jumlah","jumlah","table_pretransaksi","kd_transaksi",$id);
	$nama_kasir = $perintah->select_field("table_user","username",$_SESSION['username']);

	$sql = "SELECT SUM(sub_total) AS total FROM table_pretransaksi WHERE kd_transaksi = '$id'";
	$query = mysqli_query($conn,$sql);
	$sum = mysqli_fetch_array($query);
	$totals = $sum['total'];

	$sql1 = "SELECT SUM(jumlah) AS j_beli FROM table_pretransaksi WHERE kd_transaksi = '$id'";
	$query1 = mysqli_query($conn,$sql1);
	$sum1 = mysqli_fetch_array($query1);
	$j_beli = $sum1['j_beli'];

	// echo $id;
	// echo $sum['total'];
	// echo $sum1['j_beli'];
	// echo $nama_kasir['kd_user'];

	if (isset($_POST['simpan'])) {
		$kd_transaksi = $_POST['kd_transaksi'];
		$total = $_POST['total'];
		$bayar = $_POST['bayar'];
		$kembali = $_POST['angsulan'];
		if ($total > $bayar) {
			echo "<script>alert('Uangmu Kurang Mas Mba')</script>";
		}
		else{
			// $values = "'$id','$nama_kasir[kd_user]','$jumlah_beli[jumlah]','$total','$date'";
			// $perintah->simpan("table_transaksi","'$id','$nama_kasir[kd_user]','$jumlah_beli[jumlah]','$total','$date'","?page=struk_bayar&id=$id");
			$sql = "INSERT INTO table_transaksi SET kd_transaksi = '$id',kd_user = '$nama_kasir[kd_user]',jumlah_beli = '$j_beli',total_harga='$totals',bayar='$bayar',kembalian='$kembali',tanggal_beli = '$date'";
			$query = mysqli_query($conn,$sql);
			if ($query) {
				echo "<script>alert('Berhasil');document.location.href='?page=struk_bayar&id=$id'</script>";
			}
			else{
				mysqli_error($conn);
				echo "<script>alert('Gagal')</script>";
			}
		}
	}
?>
<form action="" method="post">
<div class="col-md-8 col-md-offset-2">
	<div class="row">
		<div class="panel panel-danger">
			<div class="panel-heading main-color-bg">
				<h4 class="text-center">Pembayaran</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<div class="form-group">
					<label for="">Kode Transaksi</label>
					<input type="text" name="kd_transaksi" value="<?= $id ?>" placeholder="" class="form-control" readonly="true" required>
					</div>
				</div> 
				<div class="col-md-12">
					<label for="">Total Harga</label>
					<input type="text" name="total" id="total_harga" value="<?= $summ['jumlah'] ?>" placeholder="" class="form-control" readonly="true" required>
				</div>
				<div class="col-md-12">
					<label for="">Bayar</label>
					<input type="number" name="bayar" id="bayaran" min="1" value="" placeholder="" class="form-control" required="true" autocomplete="off">
				</div>
				<div class="col-md-12">
					<label for="">Kembalian</label>
					<input type="number" name="angsulan" id="kembalian" value="" placeholder="" class="form-control" readonly="true" required>
					<br>
				</div>
				<div class="col-md-8">
					<button type="submit" class="btn btn-danger btn-block" name="simpan">Selesai</button>
				</div>
				<div class="col-md-4">
					<a href="?page=transaksi" class="btn btn-info btn-block">Kembali</a>
				</div>
			</div>

		</div>
	</div>
</div>
</form>
<script>
	$(document).ready(function(){
		$('#bayaran').keyup(function(){
			var bayar = Number($(this).val());
			var total = Number($('#total_harga').val());
			var kurang = bayar - total;
			$("#kembalian").val(kurang);
		});
	});
</script>