<?php
if($_SESSION['UROLE']=='User'){
	?>

<div class="sidebar">
<div class="top">
	<div class="logo-user">
		<img src="img/logo.svg" style="width: 160px; height: 160px;margin-left: 25px;margin-top: 15px; 
    " alt="" id="logo-user-form">
		
	</div>
	
</div>
<div class="user">
	
	<div id="user-text">
		<p class="bold" class="rowdies-regular" >User</p>
	</div>
</div>
<div class="list">
<ul>
	<li>
		<a href="dashboard.php">
			<i class='bx bxs-dashboard'></i>
			<span class="nav-item p-d" style="font-size: larger">Dashboard</span>
		</a>
	
	</li>

	<li>
		<a href="expense.php">
			<i class='bx bxs-bank'></i>
			<span class="nav-item p-d" style="font-size: larger">Expense</span>
		</a>
		
	</li>

	<li>
		<a href="reports.php">
			<i class='bx bxs-report'></i>
			<span class="nav-item p-d" style="font-size: larger">Report</span>
		</a>
		
	</li>

	<li class="log">
		<a href="logout.php">
			<i class='bx bx-log-out'></i>
			<span class="nav-item p-d" style="font-size: larger">Logout</span>
		</a>
		
	</li>
</ul>
</div>
</div>
<?php

}


else{
	
	?>
<div class="sidebar">
<div class="top">
	<div class="logo-user">
		<img src="img/logo.svg" alt="" style="width: 160px; height: 160px;margin-left: 25px;margin-top: 15px;" id="logo-user-form">
		
	</div>
	
</div>
<div class="user">

	<div id="admin-text">
		<p class="p-d" style="font-size: larger" >Admin</p>
	</div>
</div>
<div class="list">
<ul>
	<li>
	<a href="category.php">
			<i class='bx bxs-dashboard'></i>
			<span class="nav-item p-d" style="font-size: larger" >Category</span>
		</a>
	
	</li>
	
	<li>
		<a href="users.php">
			<i class='bx bxs-bank'></i>
			<span class="nav-item"  class="p-d" style="font-size: larger" >Users</span>
		</a>
		
	</li>
	<li class="log">
		<a href="logout.php">
			<i class='bx bx-log-out'></i>
			<span class="nav-item p-d" style="font-size: larger" >Logout</span>
		</a>
		
	</li>
</ul>
</div>
</div>
	<?php
}
?>


