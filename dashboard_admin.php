<?php 
    require 'lib/controller.php';
?>
<form action="" method="post">
    <div class="col-md-3 col-sm-6 col-xs-6">           
    	<div class="panel panel-back noti-box">    
            <div class="text-box" >
                <p class="main-text text-center" style="font-size: 20px;">Jumlah Barang</p>
                <?php 
                    $sql = "SELECT COUNT(kd_barang) AS count FROM table_barang";
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
                <p class="main-text text-center" style="font-size: 20px;">Jumlah Merek</p>
                <?php 
                    $sql = "SELECT COUNT(kd_merek) AS count FROM table_merek";
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
            <div class="text-box">
                <p class="main-text text-center" style="font-size: 20px;">Jumlah Distributor</p>
                <?php 
                    $sql = "SELECT COUNT(kd_distributor) AS count FROM table_distributor";
                    $query = mysqli_query($conn,$sql);
                    $count = mysqli_fetch_assoc($query);
                ?>
                <p class="main-text text-center"><?php echo $count['count'] ?></p>
                <p class="main-text"></p>
            </div>
         </div>
    </div>
</form>