<?php 
	require 'lib/controller.php';
	$perintah = new oop();
	$date = date("Y-m-d");
	$id = $_GET['id'];
	$data   = $perintah->edit("transaksi","kd_transaksi",$id);
	$total  = $perintah->selectSumWhere("transaksi","sub_total","kd_transaksi='$id'");
	$dataDetail = $perintah->edit("detailTransaksi","kd_transaksi",$id);
	$jumlah_barang = $perintah->selectSumWhere("transaksi","jumlah","kd_transaksi='$id'");


?>
<style>
	.col-sm-8{
		background: white;
		padding: 20px;
	}
	@media print{
		table{
			align-content: center;
		}
		.ds{
			display: none !important;
		}
		.tile{
			box-shadow: none;
		}
		hr{
			display: none;
		}
	}
</style>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<h4>Struk Pembayaran</h4>
		<p>Pai INV</p>
		<hr>
            <div class="row">
                  <div class="col-sm-6">Kode Transaksi : <?php echo $id ?> </div>
                  <div class="col-sm-6">
                        <p class="text-right"><span>Tanggal Cetak : <?php echo $date ?> </span></p>
                  </div>
            </div>
		<table class="table table-striped table-bordered" width="80%">
			<tr>
				<td>Kode Antrian</td>
				<td>Nama Barang</td>
                <td>Harga Satuan</td>
				<td>Jumlah</td>
				<td>Sub Total</td>
			</tr>
			<?php foreach ($dataDetail as $d): ?>
				<tr>
					<td><?= $d['kd_pretransaksi']?></td>
					<td><?= $d['nama_barang']?></td>
					<td><?= $d['harga_barang']?></td>
					<td class="text-center"><?= $d['jumlah']?></td>
					<td><?= "Rp.".number_format($d['sub_total']).",-" ?></td>
				</tr>
			<?php endforeach ?>
            <tr>
            	<td colspan="5"></td>
            </tr>
			<tr>
                <td colspan="4" class="text-right">Jumlah Pembelian Barang</td>
                <td><?= $d['jumlah_beli']?></td>
            <tr>
				<td colspan="4" class="text-right">Total</td>
				<td><?php echo "Rp.".number_format($total['sum']).",-" ?></td>
			</tr>
            </tr>
            <tr>
                <td colspan="4" class="text-right">Bayar</td>
                <td><?= $d['bayar']?></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">Kembalian</td>
                <td><?= $d['kembalian']?></td>
            </tr>
		</table>
            <p>Tanggal Beli : <?php echo $date ?> </p>
		<br>
			<a href="#" class="btn btn-info ds" name="print" onclick="window.print()"><i class="fa fa-print"></i> Cetak Struk</a>
			<a href="?page=transaksi" class="btn btn-danger ds">Transasksi Lagi</a>
		<!-- </div> -->
		<div class="col-sm-6"></div>
</div>