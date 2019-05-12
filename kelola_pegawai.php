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
		<div class="well well-sm" style="background-color: white">
		<a href="?page=k_pegawai" class="btn btn-primary">Semua Data Pegawai</a>
		<a href="?page=k_pegawai&d_admin" class="btn btn-info">Data Admin <span class="badge"><?= $admin['jumlah'] ?></span></a>
		<a href="?page=k_pegawai&d_kasir" class="btn btn-success">Data Kasir <span class="badge"><?= $kasir['jumlah'] ?></span></a>
		<a href="?page=t_pegawai" class="btn btn-warning">Tambah Pegawai <span class="fa fa-save"></span></a>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4><?= $judul ?></h4>
			</div>
			<div class="panel-body">
				<table class="table table-bordered" id="example">
					<thead>
						<td>Kode Pegawai</td>
						<td>Nama</td>
						<td>Username</td>
						<td>Password</td>
						<td>Level</td>
						<td class="text-center">Action</td>
					</thead>
					<tbody>
						<?php foreach ($datas as $data): ?>
						<tr>
						<td><?= $data['kd_user'] ?></td>
						<td><?= $data['nama_user'] ?></td>
						<td><?= $data['username'] ?></td>
						<td><?= $data['password'] ?></td>
						<td><?= $data['level'] ?></td>
						<td>
							<?php if ($data['level'] != "Manager"): ?>
							<div class="btn-group">
							<a href="?page=k_pegawai&hapus&id=<?= $data['kd_user'] ?>" class="btn btn-danger" onclick="return confirm('Apa Anda Yakin ?')">Hapus</a>
							</div>
							<?php endif ?>
							</div>
						</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>