<?php 
	require 'lib/controller.php';

	$perintah = new oop();
	$table = "table_merek";
	$autokode = $perintah->autokode($table,"kd_merek","MR");


	if (isset($_POST['simpan'])) {
		$kd_merek = htmlspecialchars($_POST['kd_merek']);
		$merek = htmlspecialchars($_POST['merek']);
		$values = "'$kd_merek','$merek'";
		$redirect = "?page=merek";

		$perintah->simpan($table,$values,$redirect);
	}

	if (isset($_GET['edit'])) {
		$autokode = $_GET['id'];
		$edit = $perintah->selectWhere($table,"kd_merek",$autokode);
	}

	if (isset($_POST['update'])) {
		$kd_merek = htmlspecialchars($_POST['kd_merek']);
		$merek = htmlspecialchars($_POST['merek']);
		$isi = "kd_merek = '$kd_merek',merek='$merek'";
		$redirect = "?page=merek";
		$perintah->ubah($table,$isi,"kd_merek",$_GET['id'],$redirect);
	}

	if (isset($_GET['hapus'])) {
		$autokode = $_GET['id'];
		$redirect = "?page=merek";
		$perintah->delete($table,"kd_merek",$autokode,$redirect);
	}

?>
<form action="" method="post">
	<h2 style="margin-left: 14px;">Input Merek</h2>
	<hr>
	<div class="col-md-4">
		<div class="form-group">
			<label for="Kode Merek">Kode Merek</label>
			<input type="text" readonly class="form-control" name="kd_merek" value="<?php echo $autokode ?>" id="Kode Merek">
		</div>
		<div class="form-group">
			<label for="Nama Merek">Nama Merek</label>
			<input type="text" autocomplete="off" required class="form-control" name="merek" value="<?php echo @$edit['merek'] ?>" id="Nama Merek">
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
	        <table class="table table-striped table-bordered table-hover" id="merek">
	            <thead>
	                <tr>
	                    <th>No</th>
	                    <th>Kode Merek</th>
	                    <th>Nama Merek</th>
	                    <th>Aksi</th>
	                </tr>
	            </thead>
	            <?php 
	            	$data = $perintah->select("table_merek");
	            	$no = 1;
	            	foreach ($data as $datas) { ?>
	            		<tbody>
			            	<tr>
			            		<td><?= $no++; ?></td>
			            		<td><?= $datas['kd_merek'] ?></td>
			            		<td><?= $datas['merek'] ?></td>
			            		<td colspan="2">
			            			<div class="btn-group">
				            			<a href="?page=merek&edit&id=<?= $datas['kd_merek'] ?>" class="btn btn-info"><i>Edit</i></a>
										<a onclick="return confirm('Yakin Ingin Menghapus?')" href="?page=merek&hapus&id=<?= $datas['kd_merek'] ?>" class="btn btn-danger"><i>Hapus</i></a>
									</div>
			            		</td>
			            	</tr>
			            </tbody>
	            <?php } ?>
	        </table>
	    </div>        
	</div>
</form>