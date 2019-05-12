<?php 
	session_start();
	
	require 'lib/controller.php';
	$perintah = new oop();
	$table = "table_user";

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$level    = $_POST['level'];

		$perintah->login($username,$password,$level);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Inven</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventory</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
   <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>
<body>
	<form action="" method="post">
		<div class="col-md-4 col-md-offset-4" style="margin-top: 10%;">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h4>Login To PAInv</h4>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="Username">Username</label>
						<input type="text" name="username" id="Username" value="" class="form-control" placeholder="Username">
					</div>
					<div class="form-group">
						<label for="Password">Password</label>
						<input type="password" name="password" id="Password" value="" class="form-control" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="Level">Level</label>
						<select name="level" id="Level" class="form-control">
							<option value="">Pilih Level</option>
							<option value="Admin">Admin</option>
							<option value="Kasir">Kasir</option>
							<option value="Manager">Manager</option>
						</select>
					</div>
					<button type="submit" name="login" class="btn btn-danger btn-block"><i class="fa fa-sign-in"> Sign-In</i></button>
				</div>
			</div>
		</div>
	</form>
	<script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>