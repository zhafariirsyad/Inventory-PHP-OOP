<?php 
	require 'lib/controller.php';

	$perintah = new oop();
	$table = "table_barang";
	$data = $perintah->select("table_merek");
	$datad = $perintah->select("table_distributor");
	$autokode = $perintah->autokode($table,"kd_barang","BR");

	if (isset($_POST['simpan'])) {
		$kd_barang = htmlspecialchars($_POST['kd_barang']);
		$n_barang = htmlspecialchars($_POST['barang']);
		$merek = htmlspecialchars($_POST['merek']);
		$dist = htmlspecialchars($_POST['dist']);
		$harga = htmlspecialchars($_POST['harga']);
		$stok = htmlspecialchars($_POST['stok']);
		$gambar = $_FILES['gambar'];
		$ket = htmlspecialchars($_POST['ket']);
		$tanggal = date("Y-m-d H:i:s");

		$nama_file = $_FILES['gambar']['name'];
		$tmpFile = $_FILES['gambar']['tmp_name'];
		move_uploaded_file($tmpFile, "img/$nama_file");

		$values = "'$kd_barang','$n_barang','$merek','$dist','$tanggal','$harga','$stok','$nama_file','$ket'";

		$perintah->simpan($table,$values,"?page=barang");

	}

	if (isset($_GET['edit'])) {
		$autokode = $_GET['id'];
		$edit = $perintah->selectWhere($table,"kd_barang",$_GET['id']);
	}

	if (isset($_POST['update'])) {
		$kd_barang = htmlspecialchars($_POST['kd_barang']);
		$n_barang = htmlspecialchars($_POST['barang']);
		$merek = htmlspecialchars($_POST['merek']);
		$dist = htmlspecialchars($_POST['dist']);
		$harga = htmlspecialchars($_POST['harga']);
		$stok = htmlspecialchars($_POST['stok']);
		$gambar = $_FILES['gambar']['error'] == 4 ? null : $_FILES['gambar'];
		$ket = htmlspecialchars($_POST['ket']);
		$tanggal = date("Y-m-d H:i:s");
		$nama_file = $_FILES['gambar']['name'];
		$tmpFile = $_FILES['gambar']['tmp_name'];
		move_uploaded_file($tmpFile, "img/$nama_file");
		$isi = !is_null($gambar) ? "gambar='$nama_file'," : "";
		$isi .= "kd_barang='$kd_barang',nama_barang='$n_barang',kd_merek='$merek',kd_distributor='$dist',tanggal_masuk='$tanggal',harga_barang='$harga',stok_barang='$stok',keterangan='$ket'";

		$perintah->ubah($table,$isi,"kd_barang",$_GET['id'],"?page=barang");
	}

	if (isset($_GET['hapus'])) {
		$autokode = $_GET['id'];
		$perintah->delete($table,"kd_barang",$autokode,"?page=barang");
	}

?>
<form action="" method="post" enctype="multipart/form-data">
	<h2 style="margin-left: 14px;">Input barang</h2>
	<hr>
	<div class="col-md-6">
		<div class="form-group">
			<label for="Kode barang">Kode Barang</label>
			<input type="text" readonly class="form-control" name="kd_barang" value="<?php echo $autokode ?>" id="Kode barang">
		</div>
		<div class="form-group">
			<label for="Nama barang">Nama Barang</label>
			<input type="text" required autocomplete="off" class="form-control" name="barang" value="<?php echo @$edit['nama_barang'] ?>" id="Nama barang">
		</div>
		<div class="form-group">
			<label for="merek barang">Kode Merek</label>
			<select name="merek" id="" class="form-control" value="" required>
				<?php if (isset($_GET['edit'])): ?>
					<option value="<?php echo @$edit['kd_merek'] ?>"><?php echo @$edit['kd_merek'] ?></option>
				<?php endif ?>
				<?php if (!isset($_GET['edit'])): ?>
					<option value="">--Pilih Merek--</option>
				<?php endif ?>
				<?php 
					foreach ($data as $datas) { ?>
						<option value="<?php echo $datas['kd_merek'] ?>"><?php echo $datas['kd_merek'] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label for="Distributor barang">Kode Distributor</label>
			<select name="dist" id="" class="form-control" required>
				<?php if (isset($_GET['edit'])): ?>
					<option value="<?php echo @$edit['kd_distributor'] ?>"><?php echo @$edit['kd_distributor'] ?></option>
				<?php endif ?>
				<?php if (!isset($_GET['edit'])): ?>
					<option value="">--Pilih Distributor--</option>
				<?php endif ?>
				<?php 
					foreach ($datad as $datas) { ?>
						<option value="<?php echo $datas['kd_distributor'] ?>"><?php echo $datas['kd_distributor'] ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="harga">Harga Barang</label>
			<input type="number" name="harga" required value="<?php echo @$edit['harga_barang'] ?>" class="form-control">
		</div>
		<div class="form-group">
			<label for="stok">Stok Barang</label>
			<input type="number" name="stok" required value="<?php echo @$edit['stok_barang'] ?>" class="form-control">
		</div>
		<div class="form-group">
			<label for="gambar">Gambar Barang</label>
			<input type="file" name="gambar" class="form-control">
			
		</div>
		<div class="form-group">
			<label for="ket">Keterangan Barang</label>
			<textarea name="ket" required id="alamat" cols="10" rows="3" class="form-control"><?php echo @$edit['keterangan'] ?></textarea>
		</div>
		
		<?php if (isset($_GET['edit'])): ?>
			<button type="submit" name="update" class="btn btn-info btn-block">Update</button>
		<?php endif ?>
		<?php if (!isset($_GET['edit'])): ?>
			<button type="submit" name="simpan" class="btn btn-info btn-block">Simpan</button>
		<?php endif ?>
	</div>
	<div class="col-md-12" style="margin-top: 5%;">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="barang">
	            <thead>
	                <tr>
	                    <th>No</th>
	                    <th>Kode Barang</th>
	                    <th>Nama Barang</th>
	                    <th>Kode Merek</th>
	                    <th>Kode Distributor</th>
	                    <th>Harga</th>
	                    <th>Stok</th>
	                    <th>Gambar</th>
	                    <th>Keterangan</th>
	                    <th>Tanggal Masuk</th>
	                    <th>Aksi</th>
	                </tr>
	            </thead>
	            <?php 
	            	$data = $perintah->select("table_barang");
	            	$no = 1;
	            	foreach ($data as $d) { ?>
	            		<tbody>
	            			<tr>
	            				<td><?= $no++ ?></td>
	            				<td><?= $d['kd_barang']?></td>
	            				<td><?= $d['nama_barang']?></td>
	            				<td><?= $d['kd_merek']?></td>
	            				<td><?= $d['kd_distributor']?></td>
	            				<td><?= "Rp ".number_format($d['harga_barang']) ?></td>
	            				<td><?= $d['stok_barang']?></td>
	            				<td><img src="img/<?php echo $d['gambar'] ?>" class="img-circle" width="100" height="100" alt=""></td>
	            				<td><?= $d['keterangan']?></td>
	            				<td><?= $d['tanggal_masuk']?></td>
	            				<td colspan="2">
		        					<div class="btn-group">
				            			<a href="?page=barang&edit&id=<?= $d['kd_barang'] ?>" class="btn btn-info"><i>Edit</i></a>
										<a onclick="return confirm('Yakin Ingin Menghapus?')" href="?page=barang&hapus&id=<?= $d['kd_barang'] ?>" class="btn btn-danger"><i>Hapus</i></a>
									</div>
	            				</td>
	            			</tr>
	            		</tbody>
	            <?php } ?>
	        </table>    
		</div>
	</div>
</form>	