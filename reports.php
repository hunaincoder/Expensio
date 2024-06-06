<?php
include('header.php');
checkUser();
userArea();
include('user_header.php');

$cat_id = '';
$sub_sql = '';
$from = '';
$to = '';
if(isset($_GET['category_id']) && $_GET['category_id']>0) {
    $cat_id = get_safe_value($_GET['category_id']);
    $sub_sql = " AND category.id=$cat_id ";
}

if(isset($_GET['from'])) {
    $from = get_safe_value($_GET['from']);
}
if(isset($_GET['to'])) {
    $to = get_safe_value($_GET['to']);
}

if($from !== '' && $to != '') {
    $sub_sql .= " AND expense.expense_date BETWEEN '$from' AND '$to' ";
}

$res = mysqli_query($con, "SELECT sum(expense.price) as price, category.name, expense.payment FROM expense, category WHERE expense.category_id = category.id AND expense.added_by = '".$_SESSION['UID']."' $sub_sql GROUP BY expense.category_id");
?>

	<div class="navbar">
<h2 id="dashboard">Report</h2>
</div>


<div class="upper">
<form type="get">
    From <input type="date" name="from" value="<?php echo $from; ?>" max="<?php echo date('Y-m-d'); ?>" onchange="set_to_date()" id="from_date">
    &nbsp;&nbsp;&nbsp;
    To <input type="date" name="to" value="<?php echo $to; ?>" max="<?php echo date('Y-m-d'); ?>" id="to_date">
    <?php echo getCategory($cat_id, 'reports'); ?>
    <div class="buttons-report">
    <input type="submit" name="submit" value="Submit">
    <a href="reports.php" id="reset-reports">Reset</a>
    </div>
</form>
</div>

<?php
if(mysqli_num_rows($res) > 0) {
?>
<br/><br/>
<div class="lower">
<table id="expense-table" >
    <tr id="header" class="tr-expense">
        <th class="thtd-e">Category</th>
        <th class="thtd-e" >Price</th>
        <th class="thtd-e">Payment</th> <!-- Add this column if needed -->
    </tr>
    <?php 
    $final_price = 0;
    while($row = mysqli_fetch_assoc($res)) {
        $final_price += $row['price']; 
    ?>
    <tr  class="tr-expense">
        <td class="thtd-e"><?php echo $row['name']; ?></td>
        <td class="thtd-e"><?php echo $row['price']; ?></td>
        <td class="thtd-e"><?php echo $row['payment']; ?></td> <!-- Add this field if needed -->
    </tr>
    <?php } ?>
    <tr  class="tr-expense">
        <th class="thtd-e">Total</th>
        <th class="thtd-e"><?php echo $final_price; ?></th>
        <th class="thtd-e"></th>
    </tr>
</table>
</div>

<?php 
} else {
    echo "<b>No data found</b>";
}
?>

