<?php
include('header.php');
checkUser();
userArea();
$msg = "";
$category_id = "";
$item = "";
$price = "";
$details = "";
$payment = ""; 
$expense_date = date('Y-m-d');
$label = "Add";

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $label = "Edit";
    $id = get_safe_value($_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM expense WHERE id = $id");
    if(mysqli_num_rows($res) == 0) {
        redirect('expense.php');
        die();
    }
    $row = mysqli_fetch_assoc($res);
    $category_id = $row['category_id'];
    $item = $row['item'];
    $price = $row['price'];
    $details = $row['details'];
    $payment = $row['payment']; 
    $expense_date = $row['expense_date'];
    if($row['added_by'] != $_SESSION['UID']) {
        redirect('expense.php');
    }
}

if(isset($_POST['submit'])) {
    $category_id = get_safe_value($_POST['category_id']);
    $item = get_safe_value($_POST['item']);
    $price = get_safe_value($_POST['price']);
    $details = get_safe_value($_POST['details']);
    $payment = get_safe_value($_POST['payment']); 
    $expense_date = get_safe_value($_POST['expense_date']);
    $added_on = date('Y-m-d h:i:s');
    
    $type = "add";
    $sub_sql = "";
    if(isset($_GET['id']) && $_GET['id'] > 0) {
        $type = "edit";
        $sub_sql = "AND id != $id";
    }
    
    $added_by = $_SESSION['UID'];
    $sql = "INSERT INTO expense (category_id, item, price, details, added_on, expense_date, added_by, payment) 
            VALUES ('$category_id', '$item', '$price', '$details', '$added_on', '$expense_date', '$added_by', '$payment')"; 

    if(isset($_GET['id']) && $_GET['id'] > 0) {
        $sql = "UPDATE expense 
                SET category_id = '$category_id', item = '$item', price = '$price', details = '$details', expense_date = '$expense_date', payment = '$payment' 
                WHERE id = $id"; 
    }
    mysqli_query($con, $sql);
    redirect('expense.php');
}

include('user_header.php');
?>
	<div class="navbar">
<h2 id="dashboard">Manage Expense</h2>
</div>
<div class="main-manage-expense">
<h2><?php echo $label; ?> Expense</h2>
<a href="expense.php">Back</a>
<br/><br/>

<form method="post">
    <table id="expense-table" style="top:50%; border-radius:5px">
        <tr  class="tr-expense">
            <td class="thtd-e"><b>CATEGORY</b></td>
            <td class="thtd-e"><?php echo getCategory($category_id); ?></td>
        </tr>
        <tr class="tr-expense">
            <td class="thtd-e"><b>ITEM</b></td>
            <td class="thtd-e "><input type="text" name="item" required value="<?php echo $item; ?>"></td>
        </tr>
        <tr class="tr-expense">
            <td class="thtd-e"><b>PRICE</b></td>
            <td class="thtd-e "><input type="text" name="price" required value="<?php echo $price; ?>"></td>
        </tr>
        <tr class="tr-expense">
            <td class="thtd-e"><b>DETAILS</b></td>
            <td class="thtd-e "><input type="text" name="details" required value="<?php echo $details; ?>"></td>
        </tr>
        <tr class="tr-expense">
            <td class="thtd-e"><b>PAYMENT</b></td>
            <td class="thtd-e "><input type="text" name="payment" required value="<?php echo $payment; ?>"></td> <!-- Add this row -->
        </tr>
        <tr class="tr-expense">
            <td class="thtd-e"><b>EXPENSE DATE</b></td>
            <td class="thtd-e "><input type="date" name="expense_date" required value="<?php echo $expense_date; ?>"></td>
        </tr>
        <tr>
            <td class="thtd-e"></td>
            <td class="thtd-e"><input type="submit" name="submit" value="Submit"></td>
        </tr>
    </table>
</form>

<?php echo $msg; ?>

</div>
