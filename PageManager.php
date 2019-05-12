<?php 
    session_start();
    
    if (!isset($_SESSION['username'])) {
        header("location:login.php");
    }
    if (@$_GET['log']=="t") {
    session_destroy();
    ?>
        <script type="text/javascript">window.location.href="login.php"</script>

    <?php
  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventory</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
   <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
</head>
<body style="font-family: 'Titillium Web', sans-serif; ">
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?page=dashboard" style="font-size: 20px !important;">Manager Inventory</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> <?php echo $_SESSION['username']  ?> &nbsp;&nbsp;<a href="?log=t" onclick="return confirm('are you sure?')" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                	<li class="text-center">
                    	<img src="assets/img/find_user.png" class="user-image img-responsive ds"/>
                    </li>    
                    <li class="ds">
                        <a href="?page=k_pegawai" class="ds"><i class="fa fa-user fa-2x ds"></i> Kelola Pegawai</a>
                    </li>
                    <li class="ds">
                        <a href="#"><i class="fa fa-file-text fa-2x ds"></i> Laporan Barang<span class="fa arrow ds"></span></a>
                        <ul class="nav nav-second-level ds">
                            <li>
                                <a href="?page=ls_barang">Semua Barang</a>
                            </li>
                            <li>
                                <a href="?page=h_stok">Habis Stock</a>
                            </li>
                        </ul>
                    </li>
                    <li class="ds">
                        <a href="?page=ls_pegawai"><i class="fa fa-file fa-2x ds"></i> Laporan Pegawai</a>
                    </li>
                    <li class="ds">
                        <a href="?page=lap_trans" class="ds"><i class="fa fa-user fa-2x ds"></i> Transaksi Per Periode</a>
                    </li>
                </ul>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        
                        <?php 
                        @$page = $_GET['page'];
                            switch ($page) {
                                case 'k_pegawai':
                                    require 'kelola_pegawai.php';
                                break;
                                case 't_pegawai':
                                    require 'addPegawai.php';
                                break;
                                case 'edit_pegawai':
                                    require 'edit_pegawai.php';
                                break;
                                case 'ls_barang':
					              	include "lap_semua_barang.php"; 
					            break;
                                case 'h_stok':
                                    include "h_stok.php"; 
                                break;
                                case 'lap_trans':
                                    include "lap_trans_periode.php"; 
                                break;
                                case 'ls_pegawai':
                                    include 'lap_pegawai.php';    
                                break;
                            default:
                                require 'dashboard_manager.php';
                            break;
                            }
                        ?>

                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     
    <style>
    	@media print{
			.ds{
				display: none !important;
			}
    	}
    </style>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
               $('#example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
