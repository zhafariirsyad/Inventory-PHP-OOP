<?php 
	error_reporting(0);
	require_once 'lib/controller.php';

	$perintah = new oop();

	if (isset($_POST['cari'])) {
		$date1 = $_POST['date1'];
		$date2 = $_POST['date2'];
		$data = $perintah->selectBetween("periode","tanggal_beli",$date1,$date2);
	}
?>
<form action="" method="post">
	<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4>Laporan Transaksi Per-Periode</h4>
			</div>
			<div class="panel-body">
				<a href="#" onclick="window.print()" target="_blank" class="btn btn-primary ds">Print Data <span class="fa fa-file-text-o"></span></a>
				<a href="export_excel.php" target="_blank" class="btn btn-success ds">Export Excel <span class="fa fa-file-excel-o"></span></a>
				<hr class="ds">
				<div class="col-md-3">
				<input type="date" name="date1" value="" class="form-control">
				</div>
				<div class="col-md-3">
				<input type="date" name="date2" value="" class="form-control">
				</div>
				<div class="col-md-1">
					<button type="submit" class="btn btn-primary" name="cari">Cari <span class="fa fa-search"></span></button>
				</div>
				<br>
				<br>
				<hr>
				<table border="1" class="table table-bordered table-hovered" style="margin-top: 2% !important;">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Transaksi</th>
							<th>Nama Kasir</th>
							<th>Jumlah Beli</th>
							<th>Total Harga</th>
							<th>Bayar</th>
							<th>Kembalian</th>
							<th>Tanggal Beli</th>
						</tr>	
					</thead>
					<tbody>
					<?php 
						$no = 1;
						foreach ($data as $d) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $d['kd_transaksi']?></td>
								<td><?= $d['nama_user']?></td>
								<td><?= $d['jumlah_beli']?></td>
								<td><?= $d['total_harga']?></td>
								<td><?= $d['bayar']?></td>
								<td><?= $d['kembalian']?></td>
								<td><?= $d['tanggal_beli']?></td>
							</tr>	
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</form>