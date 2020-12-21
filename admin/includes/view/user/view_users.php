<?php
use classes\User;


$users = User::find_all();


?>

<div class="col-lg-12"  style="overflow: auto;">
    <a href="?source=add_user" class="btn btn-primary pull-right">+ New</a>
    <h1 class="page-header">
        All users
        <small>Admin Access</small>
    </h1>



    <table class="table table-responsive table-bordered">

        <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>About</th>
                <th>Username</th>
                <th>Email</th>
                <th>Register Date</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->first_name; ?></td>
            <td><?php echo $user->last_name; ?></td>
            <td><?php echo $user->about; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->creation_date($user->id); ?></td>
            <td>
                <?php
                switch ($user->role) {
                    case '0':
                        echo 'subscriber';
                        break;
                    case '1':
                        echo 'editor';
                        break;
                    case '2':
                        echo 'adminstrator';
                        break;
                    case '3':
                        echo 'Admin';
                        break;
                }
                ?>
            </td>

            <td>

                <a class="btn btn-primary" href="?source=edit_user&id=<?php echo $user->id; ?>">Edit</a>



            </td>

            <td>

                <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $user->id; ?>">
                    <input type="submit" class="btn btn-danger" name="delete_item_btn" value="Delete">
                </form>

            </td>
        </tr>

        <?php endforeach; ?>
        </tbody>


    </table>




<?php
if (isset($_POST['delete_item_btn'])) {

    $user_id_for_delete = $_POST['delete_id'];
    $user_to_delete = \classes\User::find_by_id($user_id_for_delete);
    // Admin Access
    if (isset($_SESSION['user_info']['access']) && $_SESSION['user_info']['access'] == 3) {
        $user_to_delete->delete();
    }
    redirect("users.php");

}


?>


















</div>
