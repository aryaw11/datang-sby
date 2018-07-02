<?php
session_start();
include '../config/koneksi.php';
if(isset($_POST['login_button'])) {
	$user_email = trim($_POST['user_email']);
	$user_password = trim($_POST['password']);
	
	$sql = "SELECT uid, user, pass , role , kec FROM users WHERE email='$user_email'";
	$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);	
		
	if($row['pass']==$user_password){				
		echo "ok";
		$_SESSION['user_session'] = $row['uid'];
		$_SESSION['user'] = $row['user'];
		$_SESSION['role'] = $row['role'];
		if ($row['role']=='kec') {
		$_SESSION['kec'] = $row['kec'];
		}
	} else {				
		echo "email or password does not exist."; // wrong details 
	}		
}
?>