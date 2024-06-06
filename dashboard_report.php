<?php
include('header.php');
checkUser();
userArea();
include('user_header.php');
$from='';
$to='';
$sub_sql="";
if(isset($_GET['from'])){
	$from=get_safe_value($_GET['from']);
}
if(isset($_GET['to'])){
	$to=get_safe_value($_GET['to']);
}

if($from!=='' && $to!=''){
	$sub_sql.=" and expense.expense_date between '$from' and '$to' ";
}


$res=mysqli_query($con,"select expense.price,category.name,expense.item,expense.expense_date from expense,category where expense.category_id=category.id  and expense.added_by='".$_SESSION['UID']."' $sub_sql");
?>
<h2>Dashboard Reports</h2>

<?php if($from!='' && $to!=''){ ?>
From <?php echo $from?>
To <?php echo $to?>
<?php } ?>

<?php
if(mysqli_num_rows($res)>0){
?>
<br/><br/>
<div class="container-a">
<table id="admin-tablee" >
	<tr id="header-admin" class="tr-admin">
		<th class="thtd-admin" id="text-bold">Category</th>
		<th class="thtd-admin" id="text-bold">Item</th>
		<th class="thtd-admin" id="text-bold">Expense Date</th>
		<th class="thtd-admin" id="text-bold">Price</th>
	</tr>
	
	<?php 
	$final_price=0;
	while($row=mysqli_fetch_assoc($res)){
	$final_price=$final_price+$row['price'];	
	?>
	<tr class="tr-admin">
		<td class="thtd-admin" id="text-bold"><?php echo $row['name']?></td>
		<td class="thtd-admin" id="text-bold"><?php echo $row['item']?></td>
		<td class="thtd-admin" id="text-bold"><?php echo $row['expense_date']?></td>
		<td class="thtd-admin" id="text-bold"><?php echo $row['price']?></td>
		
	</tr>
	<?php } ?>
	
	<tr class="tr-admin">
		<th></th>
		<th></th>
		<th class="thtd-admin" id="text-bold">Total</th>
		<th class="thtd-admin" id="text-bold"><?php echo $final_price?></th>
	</tr>
	</div>
</table>
<?php } else {
	echo "<b>No data found</b>";
}
?>

