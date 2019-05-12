<?php 
	require 'lib/controller.php';

	$perintah = new oop();
	$judul = "Semua Pegawai";
	$datas = $perintah->select("table_user");
	$admin = $perintah->select_count("kd_user","jumlah","table_user","level","Admin");
	$kasir = $perintah->select_count("kd_user","jumlah","table_user","level","Kasir");

	if (isset($_GET['d_admin'])) {
		$judul = "Semua Admin";
		$datas = $perintah->select_fields("table_user","level","Admin");
	}
	if (isset($_GET['d_kasir'])) {
		$judul = "Semua Kasir";
		$datas = $perintah->select_fields("table_user","level","Kasir");
	}
	if (isset($_GET['hapus'])) {
		$id = $_GET['id'];
		$perintah->delete("table_user","kd_user",$id,"?page=k_pegawai");
	}

?>
<div class="col-md-12">
	<div class="row">
		<div class="well well-sm ds" style="background-color: white">
		<a href="?page=ls_pegawai" class="btn btn-primary ds">Semua Data Pegawai</a>
		<a href="?page=ls_pegawai&d_admin" class="btn btn-info ds">Data Admin <span class="badge"><?= $admin['jumlah'] ?></span></a>
		<a href="?page=ls_pegawai&d_kasir" class="btn btn-success ds">Data Kasir <span class="badge"><?= $kasir['jumlah'] ?></span>
		</a>
		<a href="#" onclick="window.print()" target="_blank" class="btn btn-primary ds">Print Data <span class="fa fa-file-text-o"></span></a>
		<a href="export_excel.php" target="_blank" class="btn btn-success ds">Export Excel <span class="fa fa-file-excel-o"></span></a>
		<hr class="ds">
		</div>
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4><?= $judul ?></h4>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<td>Kode Pegawai</td>
						<td>Nama</td>
						<td>Username</td>
						<td>Password</td>
						<td>Level</td>
					</thead>
					<tbody>
						<?php foreach ($datas as $data): ?>
						<tr>
						<td><?= $data['kd_user'] ?></td>
						<td><?= $data['nama_user'] ?></td>
						<td><?= $data['username'] ?></td>
						<td><?= $data['password'] ?></td>
						<td><?= $data['level'] ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>