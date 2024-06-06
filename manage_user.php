<?php
include('header.php');
checkUser();
adminArea();
$msg = "";
$username = "";
$password = "";
$role = "User";
$label = "Add";

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $label = "Edit";
    $id = get_safe_value($_GET['id']);
    $res = mysqli_query($con, "select * from users where id=$id");
    if (mysqli_num_rows($res) == 0) {
        redirect('users.php');
        die();
    }
    $row = mysqli_fetch_assoc($res);
    $username = $row['username'];
    $password = $row['password'];
    $role = $row['role'];
}

if (isset($_POST['submit'])) {
    $username = get_safe_value($_POST['username']);
    $password = get_safe_value($_POST['password']);
    $role = get_safe_value($_POST['role']);
    $type = "add";
    $sub_sql = "";
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $type = "edit";
        $sub_sql = "and id!=$id";
    }

    $res = mysqli_query($con, "select * from users where username='$username' $sub_sql");
    if (mysqli_num_rows($res) > 0) {
        $msg = "Username already exists";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        if ($type == "add") {
            $sql = "insert into users(username,password,role) values('$username','$password','$role')";
        } else {
            $sql = "update users set username='$username', password='$password', role='$role' where id=$id";
        }
        mysqli_query($con, $sql);
        redirect('users.php');
    }
}

include('user_header.php');
?>
<div class="navbar">
    <h2 id="dashboard">Manage Users</h2>
</div>
<h2><?php echo $label ?> Users</h2>
<a href="users.php" id="add-admin" style="margin-top:1%">Back</a>
<br/><br/>
<form method="post">
    <table class="table-container-admin" style="margin-top:3%">
        <tr class="tr-admin">
            <td class="thtd-admin" id="text-bold">Username</td>
            <td class="thtd-admin"><input type="text" name="username" required value="<?php echo $username ?>"></td>
        </tr>
        <tr class="tr-admin">
            <td class="thtd-admin" id="text-bold">Password</td>
            <td class="thtd-admin"><input type="password" name="password" required></td>
        </tr>
        <tr class="tr-admin">
            <td class="thtd-admin" id="text-bold">Role</td>
            <td class="thtd-admin">
                <select name="role" required >
                    <option value="User" <?php echo ($role == 'User') ? 'selected' : '' ?>>User</option>
                    <option value="Admin" <?php echo ($role == 'Admin') ? 'selected' : '' ?>>Admin</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="thtd-admin"></td>
            <td class="thtd-admin"><input type="submit" name="submit" value="Submit"></td>
        </tr>
    </table>
</form>
<?php echo $msg; ?>
