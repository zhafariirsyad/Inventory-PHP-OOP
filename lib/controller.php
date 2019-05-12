<?php 
	
	$username = "root";
    $password = "";
    $database = "db_inven";
    $hostname = "localhost";
    $conn = mysqli_connect($hostname,$username,$password,$database) or die("Connection Corrupt");

    class oop{

    	public function login($username,$password,$level){
    		global $conn;

    		$sql = "SELECT * FROM table_user WHERE username='$username' AND password='$password' AND level='$level'";
    		$query = mysqli_query($conn,$sql);
    		$rows = mysqli_num_rows($query);
    		$assoc = mysqli_fetch_assoc($query);
    		if ($rows > 0) {
    			if ($level == 'Admin') {
					echo "<script>alert('Welcome Admin');document.location.href='PageAdmin.php'</script>";
					$_SESSION['username'] = $username;    
    			}
    			elseif($level == 'Kasir') {
    				echo "<script>alert('Welcome Kasir');document.location.href='PageKasir.php'</script>";    
    				$_SESSION['username'] = $username;
    			}
    			elseif($level == 'Manager') {
    				echo "<script>alert('Welcome Manager');document.location.href='PageManager.php'</script>";    
    				$_SESSION['username'] = $username;
    			}
    		}else{
                mysqli_error($conn);
            }
    	}
    	public function validatehtml($field){
    		$field = htmlspecialchars($field);
    		return $field;
    	}

    	public function check_session(){
    		global $conn;
    		if (!isset($_SESSION['username'])) {
    			return 'false';
    		}
    		else{
    			return 'true';
    		}
    	}

        public function querySelect($sql){
            global $conn;
            $query = mysqli_query($conn,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

    	public function logout(){
            session_destroy();
            header("Location:login.php");
        }

        public function simpan($table,$values,$redirect){
        	global $conn;

        	$sql = "INSERT INTO $table VALUES($values)";
        	$query = mysqli_query($conn,$sql);
        	if ($query) {
        		echo "<script>alert('Berhasil');document.location.href='$redirect'</script>";
        	}
        	else{
        		echo mysqli_error($conn);
        	}
        }

        public function simpann($table,$values,$where,$whereisi,$redirect){
            global $conn;

            $sql = "INSERT INTO $table SET $values WHERE $where = '$whereisi'";
            $query = mysqli_query($conn,$sql);
            if ($query) {
                echo "<script>alert('Berhasil');document.location.href='$redirect'</script>";
            }
            else{
                echo mysqli_error($conn);
            }
        }

        public function data_table($table){
            global $conn;
            $sql = "SELECT * FROM $table";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while ($tampung = mysqli_fetch_assoc($query)) {
                $data[] = $tampung;
            }
            return $data;
        }

        public function delete($table,$where,$whereValues,$redirect){
            global $conn;
            $sql = "DELETE FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($conn,$sql);
            if($query){
                echo "<script>alert('Berhasil');document.location.href='$redirect'</script>";
            }else{
                echo mysqli_error($conn);
            }
        }

        public function sum_where($field,$name,$table,$f1,$v1){
            global $conn;
            $sql = "SELECT SUM($field) AS $name FROM $table WHERE $f1 = '$v1'";
            $query = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($query);
            return $data;
        }

        public function ubah($table,$isi,$where,$whereisi,$redirect){
        	global $conn;
        	$sql = "UPDATE $table SET $isi WHERE $where = '$whereisi'";
        	$query = mysqli_query($conn,$sql);
        	if ($query) {
        		echo "<script>alert('Berhasil');document.location.href='$redirect'</script>";
        	}
        	else{
        		echo mysqli_error($conn);
        		// echo "<script>alert('Failed');document.location.href='$redirect'</script>";
        	}
        }

        public function ubahh($table,$isi,$where,$whereisi){
            global $conn;
            $sql = "UPDATE $table SET $isi WHERE $where = '$whereisi'";
            return $query = mysqli_query($conn,$sql);
            
        }
        
        public function nawal($table,$isi,$where,$whereisi){
            global $conn;
            $sql = "INSERT INTO $table SET $isi WHERE $where = '$whereisi'";
            return $query = mysqli_query($conn,$sql);
            
        }
        public function selectBetween($table,$where,$v1,$v2){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $where BETWEEN '$v1' AND '$v2'";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }
        public function edit($table,$where,$whereValues){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }   

        public function select($table){
            global $conn;
            $sql = "SELECT * FROM $table";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

        public function selectSumWhere($table,$namaField,$where){
            global $conn;
            $sql = "SELECT SUM($namaField) as sum FROM $table WHERE $where";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
            // mamang
        }

        public function selectt($field,$table,$where){
            global $conn;
            $sql = "SELECT $field FROM $table";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }
        public function count($field,$name,$table){
            global $conn;
            $sql = "SELECT COUNT($field) AS $name FROM $table";
            $query = mysqli_query($conn,$sql);
            $assoc = mysqli_fetch_assoc($query);
            return $assoc;
        }

        public function selectWhere($table,$where,$whereValues){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        function query($query){
            global $conn;
            $result = mysqli_query($conn,$query);
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }

        public function select_count($field,$name,$table,$where,$value){
            global $conn;
            $sql = "SELECT COUNT($field) AS $name FROM $table WHERE $where = '$value'";
            $query = mysqli_query($conn,$sql);
            $datas = mysqli_fetch_assoc($query);
            return $datas;
        }

        public function select_field($table,$field,$v1){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $field = '$v1'";
            $query = mysqli_query($conn,$sql);
            $assoc = mysqli_fetch_assoc($query);
            return $assoc;
        }

        public function select_fields($table,$where,$value){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $where = '$value'";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while ($tampung = mysqli_fetch_assoc($query)) {
                $data[] = $tampung;
                }
            return $data;
        }

        public function autokode($table,$field,$pre){
            global $conn;
            $sqlc   = "SELECT COUNT($field) as jumlah FROM $table";
            $querys = mysqli_query($conn,$sqlc);
            $number = mysqli_fetch_assoc($querys);
            if($number['jumlah'] > 0){
                $sql    = "SELECT MAX($field) as kode FROM $table";
                $query  = mysqli_query($conn,$sql);
                $number = mysqli_fetch_assoc($query);
                $strnum = substr($number['kode'], 2,3);
                $strnum = $strnum + 1;
                if(strlen($strnum) == 3){ 
                    $kode = $pre.$strnum;
                }else if(strlen($strnum) == 2){ 
                    $kode = $pre."0".$strnum;
                }else if(strlen($strnum) == 1){ 
                    $kode = $pre."00".$strnum;
                }
            }else{
                $kode = $pre."001";
            }

            return $kode;
        }
    }
 ?>