<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navigation.php"); ?>


<?php


if (isset($_SESSION['user_info'])) { redirect('login.php');}

// var_dump($_SESSION['message']);
if (isset($_POST['reg_btn'])) {



    // $_SESSION['messages']['test'] = "test";
    
    if(empty($_POST['reg_username'])) {
        $session->set_message('username_empty', "Username Should Not Be Empty");
    } else if (strlen($_POST['reg_username']) < 4) {
        $session->set_message('username_len', "Username Should Be Longer Than 3");
    }
    
    if(empty($_POST['reg_email'])) {
        $session->set_message('email_empty', "Email Should Not Be Empty");
    }
    

    if(empty($_POST['reg_password'])) {
        $session->set_message('password_empty', "Password Should Not Be Empty");
    }
    else if(strlen($_POST['reg_password']) < 3) {
        $session->set_message('password_len', "Password Should Be Longer Than 3");
    }


  

    if (!$session->get_all_meassges()) {

        $user = new \classes\User();


        if ($user->register($_POST['reg_username'], $_POST['reg_email'], $_POST['reg_password'], $_POST['reg_fname'], $_POST['reg_lname'], null,  $_POST['reg_about'])) {
            
            // if ($session->set_message('register_successfull', 'registeration was successfull, Login')) {
                // header("Location: login.php");
            // }
            // echo $_SESSION['messages']['register_successfull'];

            // $_SESSION['success'] = 'registeration was successfull, Login';

            // $session->set_custom_msg('reg_success', 'registeration was successfull, Login');
            // var_dump($_SESSION);
            


             header("Location: login.php");
        } else {
            $session->set_message('user_exits', 'username Or password already is there');
        }
 
   
    }

}
?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">

                <div class="panel panel-primary">

                    <div class="panel-heading">Welcome to the Site: Registration</div>
                

                    <div class="panel-body">
                        <?php if ($session->have_any_message()): ?>
                            <div class="alert alert-warning">
                                <?php
                                foreach ($session->get_all_meassges() as $key => $massg) {
                                    echo $massg . "<br>";
                                    $session->remove_message($key);
                                }
                                echo "</br>";
                                ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="post">

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Your First Name ..." name="reg_fname" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Your Last Name ..." name="reg_lname" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter a Username ..." name="reg_username" >
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Enter a Password ..." name="reg_password" required>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter Your Email ..." name="reg_email" required>
                            </div>

              

                            <div class="form-group">
                                <textarea class="form-control" placeholder="Enter Something About Yourself ..." name="reg_about"></textarea>
                            </div>


                            <hr>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block" name="reg_btn">Register</button>
                            </div>



                        </form>


                    </div>

                    <div class="panel-footer">
                        <p class="text-center"><a href="login.php">Have Account? Login</a></p>
                    </div>


                </div>




            </div>





        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->


<?php require_once("includes/footer.php"); ?>
