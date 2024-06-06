<?php
include('header.php');
checkUser();
userArea();
include('user_header.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>=0) {
    $id = get_safe_value($_GET['id']);
    mysqli_query($con, "DELETE FROM expense WHERE id = $id");
}

$res = mysqli_query($con, "SELECT expense.*, category.name FROM expense JOIN category ON expense.category_id = category.id WHERE expense.added_by = '".$_SESSION['UID']."' ORDER BY expense.id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses</title>
</head>
<body>
    <div class="navbar">
    <h2 id="dashboard">Expense</h2>
    </div>
    <div class="main">
        <div class="container">
    
    <a href="manage_expense.php" id="add-expensee">Add Expense</a>
    <br><br>
    </div>
    <?php
    if(mysqli_num_rows($res) > 0) {
    ?>
    <div class="container-e">
    <table id="expense-tablee">
        <tr id="header" class="tr-expense">
            <th class="thtd-e">ID</th>
            <th class="thtd-e">Category</th>
            <th class="thtd-e">Item</th>
            <th class="thtd-e">Price</th>
            <th class="thtd-e">Details</th>
            <th class="thtd-e">Payment</th> 
            <th class="thtd-e">Date</th>
            <th class="thtd-e">Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($res)) { ?>
        <tr class="tr-expense">
            <td class="thtd-e"><?php echo $row['id']; ?></td>
            <td class="thtd-e"><?php echo $row['name']; ?></td>
            <td class="thtd-e"><?php echo $row['item']; ?></td>
            <td class="thtd-e"><?php echo $row['price']; ?></td>
            <td class="thtd-e"><?php echo $row['details']; ?></td>
            <td class="thtd-e"><?php echo $row['payment']; ?></td> 
            <td class="thtd-e"><?php echo $row['expense_date']; ?></td>
            <td class="thtd-e icon-e">
                <div class="con">
                <a href="manage_expense.php?id=<?php echo $row['id']; ?>">
                <i class='fa-solid fa-plus icon-expense-add'></i>
            </a>
                <a href="?type=delete&id=<?php echo $row['id']; ?>">
                <i class="<ba fa-solid fa-trash fa-flip icon-expense-del"></i>
            </a>
            </div>
            </div>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php
    } else {
        echo "No data found";
    }
    ?>
</body>
</html>

