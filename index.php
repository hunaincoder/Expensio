<?php
include('header.php');
if(isset($_POST['login'])){
	$username=get_safe_value($_POST['username']);
	$password=get_safe_value($_POST['password']);
	
	$res=mysqli_query($con,"select * from users where username='$username'");
	
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
		
		$verify=password_verify($password,$row['password']);
		
		if($verify==1){
			$_SESSION['UID']=$row['id'];
			$_SESSION['UNAME']=$row['username'];
			$_SESSION['UROLE']=$row['role'];
			if($_SESSION['UROLE']=='User'){
				redirect('dashboard.php');
			}else{
				redirect('category.php');
			}
		}else{
			$error_msg = "Please enter valid password";
		}
	}else{
		$error_msg = "Please enter valid username";
	}
		
}
?>
<div class="body bg">

<form method="post">
	
		<div class="right">
		<h2 id="heading"><b>Welcome Back!</b></h2>
	<table>
		<tr>
			<td class="text">Username:</td>
			
		</tr>
		<tr>
		<td><input type="text" name="username" required class="input"></td>
		</tr>
		<tr>
			<td class="text">Password:</td>
			
		</tr>
		<tr>
		<td><input type="password" name="password" required class="input"></td>
		</tr>
		<tr>
			
			<td><input type="submit" name="login" value="Login" class="input btn"></td>
		</tr>
	</table>

	<!-- nice work buddy-->
<!-- Start of Error message added by Ahmed -->
</Message-->
	<?php if(!empty($error_msg)): ?>
    <div class="error-message"><?php echo $error_msg; ?></div>
<?php endif; ?>
</form>
<!-- End of Error message added by Ahmed -->

</div>

<div class="left">
	<div class="image">
<img src="img\laptop.svg" alt="laptopn-image" class="laptop">
	</div>
	

</div>

</div>
<div class="bar bg">
	<img src="img\bar2.svg" alt="" >
	<img src="img\bar3.svg" alt="" class="bar3" >
	</div>

