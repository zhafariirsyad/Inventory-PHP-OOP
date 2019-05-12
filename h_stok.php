<?php 
	require 'lib/controller.php';
	$perintah = new oop();
?>

<form action="">
	<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4>Data Barang Yang Habis</h4>
			</div>
			<div class="panel-body">
				<a href="#" onclick="window.print()" target="_blank" class="btn btn-primary ds">Print Data <span class="fa fa-file-text-o"></span></a>
				<a href="export_excel.php" target="_blank" class="btn btn-success ds">Export Excel <span class="fa fa-file-excel-o"></span></a>
				<hr class="ds">
				<table border="1" class="table table-bordered table-hovered">
					<thead>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Merek</th>
						<th>Distributor</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Tanggal Masuk</th>
					</thead>
					<?php 
						$no = 1;
						$datas = $perintah->edit("detailbarang","stok_barang",0);
						foreach ($datas as $data) { ?>
						<?php if ($data['stok_barang'] != 0): ?>
							<td colspan="7">Tidak Ada Stok Yang Habis</td>
						<?php else : ?>
							<tbody>
								<td><?= $no++ ?></td>
								<td><?= $data['nama_barang'] ?></td>
								<td><?= $data['merek'] ?></td>
								<td><?= $data['nama_distributor'] ?></td>
								<td><?= $data['harga_barang'] ?></td>
								<td><?= $data['stok_barang'] ?></td>
								<td><?= $data['tanggal_masuk'] ?></td>
							</tbody>
						<?php endif ?>	
					<?php }
					?>
					
				</table>
			</div>
		</div>
	</div>
</div>
</form>