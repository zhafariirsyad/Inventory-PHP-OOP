<?php 
    require_once 'lib/controller.php';
?>
<div class="col-md-3 col-sm-6 col-xs-6">           
    <div class="panel panel-back noti-box">    
        <div class="text-box" >
            <p class="main-text text-center" style="font-size: 20px;">Transaksi Berhasil</p>
            <?php 
                $sql = "SELECT COUNT(kd_transaksi) AS count FROM table_transaksi";
                $query = mysqli_query($conn,$sql);
                $count = mysqli_fetch_assoc($query);
            ?>
            <p class="main-text text-center"><?php echo $count['count'] ?></p>
            <p class="main-text"></p>
        </div>
     </div>
</div>
<div class="col-md-3 col-sm-6 col-xs-6">           
    <div class="panel panel-back noti-box">    
        <div class="text-box" >
            <p class="main-text text-center" style="font-size: 20px;">Pendapatan</p>
            <?php 
                $sql = "SELECT SUM(total_harga) AS sum FROM table_transaksi";
                $query = mysqli_query($conn,$sql);
                $sum = mysqli_fetch_assoc($query);
            ?>
            <p class="main-text text-center">Rp <?= number_format($sum['sum']) ?> ,-</p>
            <p class="main-text"></p>
        </div>
     </div>
</div>