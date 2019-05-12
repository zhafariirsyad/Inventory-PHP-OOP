<?php 
	require_once 'lib/controller.php';

	$perintah = new oop();

?>
<form action="" method="post">
	<div class="col-md-12">
		<table class="table table-striped table-hovered table-bordered" id="struk" border="1">
			<thead>
				<tr>
					<th>Kode Transaksi</th>
					<th>Kode User</th>
					<th>Jumlah Beli</th>
					<th>Total Harga</th>
					<th>Bayar</th>
					<th>Kembalian</th>
					<th>Tanggal Beli</th>
				</tr>
			</thead>
			<?php 
				$datas = $perintah->select("table_transaksi");
				foreach ($datas as $struk) { ?>
					<tbody>
						<tr>
							<td><a href="?page=v_struk&kd_transaksi=<?= $struk['kd_transaksi'] ?>"><?= $struk['kd_transaksi'] ?></a></td>
							<td><?= $struk['kd_user'] ?></td>
							<td><?= $struk['jumlah_beli'] ?></td>
							<td><?= $struk['total_harga'] ?></td>
							<td><?= $struk['bayar'] ?></td>
							<td><?= $struk['kembalian'] ?></td>
							<td><?= $struk['tanggal_beli'] ?></td>
						</tr>
					</tbody>
			<?php }
			?>
			
		</table>
	</div>	
</form>