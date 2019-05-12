<?php 
	require 'lib/controller.php';

	$perintah = new oop();

	$autopre = $perintah->autokode("table_pretransaksi","kd_pretransaksi","PT");
	$autotrans = $perintah->autokode("table_transaksi","kd_transaksi","TR");
	$sum = $perintah->sum_where("sub_total","jumlah","table_pretransaksi","kd_transaksi",$autotrans);

	if (isset($_GET['getKode'])) {
		$id = $_GET['id'];
		$data = $perintah->selectWhere("table_barang","kd_barang",$id);
	}

	if (isset($_POST['addCart'])) {
		$kd_transaksi = htmlspecialchars($_POST['kd_transaksi']);
		$kd_pretransaksi = htmlspecialchars($_POST['kd_pretrans']);
		$kd_barang = htmlspecialchars($_POST['kd_barang']);
		$jumlah = htmlspecialchars($_POST['jumlah']);
		$total = htmlspecialchars($_POST['total']);
		$sql = "SELECT * FROM table_pretransaksi WHERE kd_transaksi = '$kd_transaksi' AND kd_barang = '$kd_barang' ";
		$query = mysqli_query($conn,$sql);
		$num = mysqli_num_rows($query);
		$assoc = mysqli_fetch_assoc($query);
		$datas = $perintah->selectWhere("table_barang","kd_barang",$id);
		if ($datas["stok_barang"] < $jumlah) {
			echo "<script>alert('Stok Hanya ada' + $datas[stok_barang])</script>";
		}
		elseif ($jumlah < 0) {
			echo "<script>alert('Jumlah Minimal Pesan 1')</script>";
		}
		elseif ($num > 0) {
			$jumlah = $assoc['jumlah'] + $jumlah;
			$total = $assoc['sub_total'] + $total;
			$isi = "jumlah='$jumlah',sub_total='$total'";
			$insert = $perintah->ubah("table_pretransaksi",$isi,"kd_transaksi = '$kd_transaksi' AND kd_barang",$kd_barang,"?page=transaksi");
		}
		else{
			$values = "'$kd_pretransaksi','$kd_transaksi','$kd_barang','$jumlah','$total'";
			$perintah->simpan("table_pretransaksi",$values,"?page=transaksi");
		}
	}
	if (isset($_GET['delete'])) {
		$id = $_GET['id'];
		$perintah->delete("table_pretransaksi","kd_pretransaksi",$id,"?page=transaksi");
	}
?>
<form action="" method="post">
	<div class="col-sm-5">
		<div class="panel panel-danger">
			<div class="panel-heading" style="height: 50px;">
				<h4 style="margin-top: -5px; ">Transaksi</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="Kode Transaksi">Kode Pre-Transaksi</label>
						<input type="text" readonly class="form-control" name="kd_pretrans" value="<?php echo $autopre ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="Kode Transaksi">Kode Transaksi</label>
						<input type="text" readonly class="form-control" name="kd_transaksi" value="<?php echo $autotrans ?>">
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="text" readonly placeholder="Kode Barang" name="kd_barang" value="<?php echo @$data['kd_barang'] ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4" style="margin-left: -2%;">
					<a type="submit" name="" class="btn btn-danger" data-target="#modaltrans" data-toggle="modal" id="mymodal" >Pilih Barang</a>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Nama Barang</label>
						<input type="text" readonly name="nama_barang" value="<?php echo @$data['nama_barang'] ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Harga Barang</label>
						<input type="number" readonly name="harga" id="harga" class="form-control" value="<?php echo @$data['harga_barang'] ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Stok Barang</label>
						<input type="number" readonly name="stok" id="stok" class="form-control" value="<?php echo @$data['stok_barang'] ?>">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Jumlah</label>
						<input type="number" name="jumlah" required id="jumlah" autocomplete="off" class="form-control">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Total</label>
						<input type="number" readonly id="totals" name="total" class="form-control">
					</div>
				</div>
				<div class="col-md-12">
					<button type="submit" class="btn btn-danger btn-block" name="addCart"><i class="fa fa-shopping-cart"> Add To Cart</i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-7">
		<div class="panel panel-danger">
			<div class="panel-heading" style="height: 50px;">
				<h4 style="margin-top: -5px; ">Antrian Barang</h4>
			</div>
			<div class="panel-body">
				<table class="table" id="tCart">
					<tr>
						<th>Kode Antrian</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Sub Total</th>
						<th>Aksi</th>
					</tr>
					<?php 
						$datas = $perintah->querySelect("SELECT * FROM transaksi WHERE kd_transaksi = '$autotrans'");
						foreach ($datas as $d) { ?>
						<tr>
							<td><?= $d['kd_pretransaksi'] ?></td>
							<td><?= $d['nama_barang'] ?></td>
							<td><?= $d['jumlah'] ?></td>
							<td><?= $d['sub_total'] ?></td>
							<td>
								<a href="?page=transaksi&delete&id=<?php echo $d['kd_pretransaksi'] ?>" class="btn btn-danger">Batal</a>
							</td>
						</tr>
					<?php } ?>
						<tr>
							<td colspan="3">Total Harga</td>
							<td>Rp.<?= number_format($sum['jumlah']) ?></td>		
						</tr>
				</table>
				<hr>
				<?php if ($sum['jumlah'] > 0): ?>
				<a href="?page=pembayaran&id=<?= $autotrans ?>" class="btn btn-danger btn-block">Lanjutkan Pembayaran</a>
			   	<?php endif ?>
				
			</div>
	</div>
	<div class="modal fade model-wide" id="modaltrans">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h4>Pilih Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="barang" class="table table-bordered table-hovered">
						<thead>
							<tr>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Harga</th>
								<th>Stok</th>
							</tr>
						</thead>
						<?php 
							$barang = $perintah->select("table_barang");
							foreach ($barang as $br) { ?>
								<tbody>
									<tr>
										<td>
											<a href="PageKasir.php?page=transaksi&getKode&id=<?php echo $br['kd_barang'] ?>"><?php echo $br['kd_barang'] ?></a>
										</td>
										<td><?= $br['nama_barang']?></td>
										<td><?= $br['harga_barang']?></td>
										<td><?= $br['stok_barang']?></td>
									</tr>
								</tbody>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>	
	<script>
		$(document).ready(function(){

			$('#jumlah').keyup(function(){
	        	var jumlah  = Number($(this).val());
	        	var harba   = Number($('#harga').val());
	        	var stok = Number($('#stok').val());
	        	
	        	var kali = harba * jumlah;
	        	$("#totals").val(kali);
		    });

		});
	</script>	
</form>