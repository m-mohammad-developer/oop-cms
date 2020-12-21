<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navigation.php"); ?>


<?php

if (isset($_SESSION['user_info'])) {
    if ($_SESSION['user_info']['access'] == 0) {
        redirect('profile.php');
    } else {
        redirect('admin/');
    }

}

$error = '';
if (isset($_POST['login_btn'])) {



    if ($session->login($_POST['login_username'], $_POST['login_password'])) {
        if ($_SESSION['user_info']['access'] == 0) {
            redirect('profile.php');
        }
        redirect("admin");

    } else {
        $session->set_message('login_error', "Username or Password is Wrong!! Try Again");
    }





}


// var_dump($_SESSION);
// var_dump($session->check_for_custom_message('reg_success'));
// var_dump($session->check_for_message('register_successfull'));
// var_dump($_SESSION['messages']['register_successfull']);
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">


            <div class="col-sm-6 col-sm-offset-3">

                <div class="panel panel-primary">

                    <div class="panel-heading">Welcome to the Site: Login</div>

                    <div class="panel-body">
                        <?php if ($session->check_for_custom_message('reg_success')): ?>
                            <div class="alert alert-success">
                                <?php 
                                echo $session->check_for_message('reg_success');
                                $session->remove_message('reg_success');
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($session->check_for_message('login_error')): ?>
                            <div class="alert alert-warning">
                                <?php 
                                echo $session->check_for_message('login_error');
                                $session->remove_message('login_error');
                                ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="post">

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Your Username ..." name="login_username" required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Enter Your password ..." name="login_password" required>
                            </div>


                            <hr>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block" name="login_btn">Login</button>
                            </div>



                        </form>


                    </div>

                    <div class="panel-footer">
                        <p class="text-center"><a href="#">Forgot Password?</a></p>
                    </div>


                </div>




            </div>





        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->


<?php require_once("includes/footer.php"); ?>
