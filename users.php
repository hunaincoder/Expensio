<?php
include('header.php');
checkUser();
adminArea();
include('user_header.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	mysqli_query($con,"delete from users where id=$id");
	
	mysqli_query($con,"delete from expense where added_by=$id");
	echo "<br/>Data deleted<br/>";
}

$res=mysqli_query($con,"select * from users where role='User' order by id desc");
?>
	<div class="navbar">
<h2 id="dashboard">Users</h2>
</div>
<h2>Category</h2>
<a href="manage_user.php" id="add-admin" style="margin-top:1%">Add User</a>
<br/><br/>
<?php
if(mysqli_num_rows($res)>0){
?>

<table id="user" class="table-container-admin">
	<tr  id="header-admin" class="tr-admin">
		<th class="thtd-admin" id="text-bold">ID</td>
		<th class="thtd-admin" id="text-bold">Username</td>
		<td></td>
	</tr>
	<?php while($row=mysqli_fetch_assoc($res)){?>
	<tr  class="tr-admin">
		<td class="thtd-admin" id="text-bold"><?php echo $row['id'];?></td>
		<td class="thtd-admin" id="text-bold"><?php echo $row['username']?></td>
		<td class="thtd-admin icon-admin">
		<div class="con-admin-user">
		<a href="manage_user.php?id=<?php echo $row['id'];?>">
                        <i class='fa-solid fa-plus icon-expense-add'></i>
                    </a>
                    <a href="?type=delete&id=<?php echo $row['id']; ?>">
                        <i class="fa-solid fa-trash fa-flip icon-expense-del"></i>
                    </a>
                </div>
			
			

		</td>
	</tr>
	<?php } ?>
</table>
<?php } 
	else{
		echo "No data found";
	}
?>


