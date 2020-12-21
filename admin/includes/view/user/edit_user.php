<?php use classes\User; ?>
<?php
$user = User::find_by_id($_GET['id']);

if (empty($_GET['id'])) {
    redirect("users.php");
}



if (isset($_POST['update_user'])) {

    $form_errors = [];



    if(empty($_POST['username'])) {
        $form_errors['username_empty'] = "Username Should Not Be Empty";
    }
    if(empty($_POST['username'])) {
        $form_errors['username_len'] = "Username Should Be Longer Than 3";
    }

    if(empty($_POST['email'])) {
        $form_errors['email_empty'] = "Email Should Not Be Empty";
    }
    if(empty($_POST['email'])) {
        $form_errors['email_len'] = "Email Should Be Longer Than 3";
    }

    if(empty($_POST['password'])) {
        $form_errors['password_empty'] = "New Password Should Not Be Empty";
    }
    if(empty($_POST['password'])) {
        $form_errors['password_len'] = "New Password Should Be Longer Than 3";
    }


    foreach ($form_errors as $key) {
        if (empty($form_errors[$key])) {
            unset($form_errors[$key]);
        }
    }

    if (empty($form_errors)) {


        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->encrypt_pass();

        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->role = $_POST['role'];
        $user->about = $_POST['about'];
        if (isset($_SESSION['user_info']['access']) && $_SESSION['user_info']['access'] == 3) {
            if ($user->save()) {
                redirect("users.php");
            }
        }

    }









}
?>
<div class="col-sm-12"  style="">
    <h1 class="page-header">
        Add user
        <small>Admin Access</small>
    </h1>

    <p class="pull-right">
        Date Registered : <?php echo $user->creation_date($user->id); ?>
    </p>


    <?php if (isset($form_errors) && !empty($form_errors)): ?>
    <ul class="list-group">
        <?php
        foreach ($form_errors as $key => $form_error) {
            echo "<li class='list-group-item list-group-item-danger'>* $form_error</li>";
        }
        ?>
    </ul>
    <span class="text-danger">

    </span>
    <?php endif; ?>

    <form action="" method="post">

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="Enter Your First Name " value="<?php echo $user->first_name; ?>">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Enter Your Last Name " value="<?php echo $user->last_name; ?>">
        </div>

        <div class="form-group">
            <label for="about">About Yourself</label>
            <textarea class="form-control" name="about" cols="30" rows="10" placeholder="Say Somethings About Yourself"><?php echo $user->about; ?></textarea>
        </div>

        <hr />

        <div class="form-group">
            <label for="role">Choose User Role</label>
            <select class="form-control" name="role" id="">
                <option value="0" "<?php echo $user->role == 0 ? 'default' : '' ; ?>">Subscriber</option>
                <option value="1" "<?php echo $user->role == 1 ? 'default' : '' ; ?>">Editor</option>
                <option value="2" "<?php echo $user->role == 2 ? 'default' : '' ; ?>">Adminstrator</option>
            </select>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Your Username " required value="<?php echo $user->username; ?>">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email " required value="<?php echo $user->email; ?>">
        </div>

        <div class="form-group"">
            <label for="password">New Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Your Password " required>
        </div>

        <br/>
        <br/>
        <br/>

        <div class="form-group">
            <button type="submit" name="update_user" class="btn btn-block btn-primary">Create User</button>
        </div>

    </form>

</div>