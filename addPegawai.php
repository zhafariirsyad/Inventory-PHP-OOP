<?php 
	require 'lib/controller.php';
	$perintah = new oop();
	$table = "table_user";

	$autokode = $perintah->autokode($table,"kd_user","US");

	if (isset($_POST['simpan'])) {
		$kd_user = $_POST['kd_user'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$re_pass = $_POST['re_pass'];
		$level = $_POST['level'];

		$values = "'$kd_user','$nama','$username','$re_pass','$level'";

		if ($pass != $re_pass) {
			echo "<script>alert('Password Harus Sama !')</script>";
		}
		else{
			$perintah->simpan($table,$values,"?page=t_pegawai");
		}
	}
?>
<form action="" method="post">
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4>Tambah Pegawai <span class="fa fa-user-circle"></span></h4>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Kode User</label>
						<input type="text" name="kd_user" value="<?= $autokode ?>" placeholder="" class="form-control" readonly required> 
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Nama User</label>
						<input type="text" name="nama" value="" placeholder="" class="form-control" required="" autocomplete="off">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" value="" placeholder="" class="form-control" required="" autocomplete="off">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" name="pass" value="" placeholder="" class="form-control" autocomplete="off" required="">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Re-Type Password</label>
						<input type="password" name="re_pass" value="" placeholder="" class="form-control" autocomplete="off" required="">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					<label for="">Level</label>
					<select name="level" id="" class="form-control" required="">
						<option value="">Pilih Level</option>
						<option value="Admin">Admin</option>
						<option value="Kasir">Kasir</option>
					</select>
					</div>
				</div>
				<button type="submit" class="btn btn-info" name="simpan" style="margin-left:1.5%">Simpan <span class="fa fa-save"></span></button>
			</div>
		</div>
	</div>
</div>
</form>