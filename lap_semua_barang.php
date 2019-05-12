<?php
	require 'lib/controller.php';
	$perintah = new oop();

	$datas = $perintah->select("table_barang");
	$merek = $perintah->select("table_merek");
	$dist = $perintah->select("table_distributor");

  ?>
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4>Data Semua Barang</h4>
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
					<tbody>
						<?php
						 $no = 1;
						 foreach ($datas as $data): ?>
						<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $data['nama_barang'] ?></td>
						<?php foreach ($merek as $mereks): ?>
							<?php if ($data['kd_merek'] == $mereks['kd_merek']): ?>
						<td><?= $mereks['merek'] ?></td>
							<?php endif ?>
						<?php endforeach ?>
						<?php foreach ($dist as $distri): ?>
							<?php if ($data['kd_distributor'] == $distri['kd_distributor']): ?>
						<td><?= $distri['nama_distributor'] ?></td>
							<?php endif ?>
					    <?php endforeach ?>
						<td><?= $data['harga_barang'] ?></td>
						<td><?= $data['stok_barang'] ?></td>
						<td><?= $data['tanggal_masuk'] ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>