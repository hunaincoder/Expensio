<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
   
</head>
<body>
<?php
include('header.php');
checkUser();
adminArea();
include('user_header.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
    $id=get_safe_value($_GET['id']);
    mysqli_query($con,"delete from category where id=$id");
    echo "<br/>Data deleted<br/>";
}

$res=mysqli_query($con,"select * from category order by id desc");
?>
<div class="navbar">
    <h2 id="dashboard">Category</h2>
</div>
<a href="manage_category.php" id="add-admin">Add Category</a>
<br/><br/>
<?php
if(mysqli_num_rows($res)>0){
?>
<div class="container-a">
    <table id="admin-tablee" class="center-table">
        <tr  id="header-admin" class="tr-admin">
            <th class="thtd-admin" id="text-bold">ID</th>
            <th class="thtd-admin" id="text-bold">Name</th>
            <th class="thtd-admin"></th>
        </tr>
        <?php while($row=mysqli_fetch_assoc($res)){?>
        <tr class="tr-admin">
            <td class="thtd-admin" id="text-bold"><?php echo $row['id'];?></td>
            <td class="thtd-admin" id="text-bold"><?php echo $row['name']?></td>
            <td class="thtd-admin icon-admin">
                <div class="con-admin">
                    <a href="manage_category.php?id=<?php echo $row['id'];?>">
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
</div>
<?php } 
else{
    echo "No data found";
}
?>
</body>
</html>
