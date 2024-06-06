<?php
include('header.php');
checkUser();
adminArea();
$msg="";
$category="";
$label="Add";
if(isset($_GET['id']) && $_GET['id']>0){
	$label="Edit";
	$id=get_safe_value($_GET['id']);
	$res=mysqli_query($con,"select * from category where id=$id");
	if(mysqli_num_rows($res)==0){
		redirect('category.php');
		die();
	}
	$row=mysqli_fetch_assoc($res);
	$category=$row['name'];
}

if(isset($_POST['submit'])){
	$name=get_safe_value($_POST['name']);
	
	$type="add";
	$sub_sql="";
	if(isset($_GET['id']) && $_GET['id']>0){
		$type="edit";
		$sub_sql="and id!=$id";
	}
	
	$res=mysqli_query($con,"select * from category where name='$name' $sub_sql");
	if(mysqli_num_rows($res)>0){
		$msg="Category already exists";
	}else{
		$sql="insert into category(name) values('$name')";
		if(isset($_GET['id']) && $_GET['id']>0){
			$sql="update category set name='$name' where id=$id";
		}
		mysqli_query($con,$sql);
		redirect('category.php');
	}
}

include('user_header.php');
?>
	<div class="navbar">
<h2 id="dashboard">Manage Category</h2>
</div>
<h2><?php echo $label?> Category</h2>
<a href="category.php" id="add-admin">Back</a>
<br/><br/>

<div >
  <form method="post">
    <table class="table-container-admin">
      <tr  class="tr-admin">
        <td class="thtd-admin" id="text-bold">Category</td>
        <td class="thtd-admin"><input type="text" name="name" required value="<?php echo $category?>"></td>
      </tr>
      <tr class="tr-admin">
        <td class="thtd-admin"></td>
        <td class="thtd-admin" ><input type="submit" name="submit" value="Submit"></td>
      </tr>
    </table>
  </form>
</div>

<?php echo $msg;?>

