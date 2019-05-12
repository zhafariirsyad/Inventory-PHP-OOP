<?php 
	require 'lib/controller.php';

	$perintah = new oop();
	$table = "table_distributor";
	$autokode = $perintah->autokode($table,"kd_distributor","DS");

	if (isset($_POST['simpan'])) {
		$kd_dist = htmlspecialchars($_POST['kd_distributor']);
		$n_dist = htmlspecialchars($_POST['distributor']);
		$alamat = htmlspecialchars($_POST['alamat']);
		$no_telp = htmlspecialchars($_POST['no_telp']);
		$values = "'$kd_dist','$n_dist','$alamat','$no_telp'";

		$perintah->simpan($table,$values,"?page=dist");
	}

	if (isset($_GET['edit'])) {
		$autokode = $_GET['id'];
		$edit = $perintah->selectWhere($table,"kd_distributor",$autokode);
	}

	if (isset($_POST['update'])) {
		$kd_dist = htmlspecialchars($_POST['kd_distributor']);
		$n_dist = htmlspecialchars($_POST['distributor']);
		$alamat = htmlspecialchars($_POST['alamat']);
		$no_telp = htmlspecialchars($_POST['no_telp']);
		$isi = "kd_distributor='$kd_dist',nama_distributor='$n_dist',alamat='$alamat',no_telp='$no_telp'";

		$perintah->ubah($table,$isi,"kd_distributor",$_GET['id'],"?page=dist");
	}

	if (isset($_GET['hapus'])) {
		$autokode = $_GET['id'];
		$perintah->delete($table,"kd_distributor",$autokode,"?page=dist");
	}
?>
<form action="" method="post">
	<h2 style="margin-left: 14px;">Input Distributor</h2>
	<hr>
	<div class="col-md-4">
		<div class="form-group">
			<label for="Kode distributor">Kode Distributor</label>
			<input type="text" readonly class="form-control" name="kd_distributor" value="<?php echo $autokode ?>" id="Kode distributor">
		</div>
		<div class="form-group">
			<label for="Nama distributor">Nama Distributor</label>
			<input type="text" autocomplete="off" class="form-control" required name="distributor" value="<?php echo @$edit['nama_distributor'] ?>" id="Nama distributor">
		</div>
		<div class="form-group">
			<label for="alamat">Alamat Distributor</label>
			<textarea name="alamat" id="alamat" required cols="20" rows="5" class="form-control"><?php echo @$edit['alamat'] ?></textarea>
		</div>
		<div class="form-group">
			<label for="notelp">No Telepon</label>
			<input type="number" autocomplete="off" required class="form-control" name="no_telp" value="<?php echo @$edit['no_telp'] ?>" id="notelp">
		</div>
		
		<?php if (isset($_GET['edit'])): ?>
			<button type="submit" name="update" class="btn btn-info btn-block">Update</button>
		<?php endif ?>
		<?php if (!isset($_GET['edit'])): ?>
			<button type="submit" name="simpan" class="btn btn-info btn-block">Simpan</button>
		<?php endif ?>

	</div>
	<div class="col-md-8">
		<div class="table-responsive">
			 <table class="table table-striped table-bordered table-hover" id="distributor">
	            <thead>
	                <tr>
	                    <th>No</th>
	                    <th>Kode Distributor</th>
	                    <th>Nama</th>
	                    <th>Alamat</th>
	                    <th>No Telp</th>
	                    <th>Aksi</th>
	                </tr>
	            </thead>
	            <?php 
	            	$data = $perintah->select("table_distributor");
	            	$no = 1;
	            	foreach ($data as $datas) { ?>
	            		<tbody>
			            	<tr>
			            		<td><?= $no++ ?></td>
			            		<td><?= $datas['kd_distributor'] ?></td>
			            		<td><?= $datas['nama_distributor'] ?></td>
			            		<td><?= $datas['alamat'] ?></td>
			            		<td><?= $datas['no_telp'] ?></td>
			            		<td colspan="2">
			            			<div class="btn-group">
				            			<a href="?page=dist&edit&id=<?= $datas['kd_distributor'] ?>" class="btn btn-info"><i>Edit</i></a>
										<a onclick="return confirm('Yakin Ingin Menghapus?')" href="?page=dist&hapus&id=<?= $datas['kd_distributor'] ?>" class="btn btn-danger"><i>Hapus</i></a>
									</div>
			            		</td>
			            	</tr>
			            </tbody>
	            <?php } ?>
	            
	         </table>
	    </div>        
		</div>
	</div>
</form>