<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navigation.php"); ?>


<?php

if (!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) {

    redirect('index.php');


} else {
    $user = \classes\User::find_by_id($_SESSION['user_info']['id']);
}



?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">


            <?php if (isset($user)): ?>
            <div class="col-sm-6 col-sm-offset-3">


                <div class="panel panel-primary">

                    <div class="panel-heading">
                        <?php echo $user->username; ?>
                    </div>


                    <div class="panel-body">

                        <ul class="list-group">
                            <li class="list-group-item">
                                ID : <?php echo $user->id; ?>
                            </li>
                            <li class="list-group-item">
                                Username : <?php echo $user->username; ?>
                            </li>
                            <li class="list-group-item">
                                Email : <?php echo $user->email; ?>
                            </li>
                            <li class="list-group-item">
                                First Name : <?php echo $user->first_name; ?>
                            </li>
                            <li class="list-group-item">
                                Last Name : <?php echo $user->last_name; ?>
                            </li>
                        </ul>





                    </div>



                    <div class="panel-footer">
                        <a href="admin/logout.php" class="btn btn-block btn-danger">Logout</a>

                    </div>


                </div>

                <?php endif; ?>




            </div>





        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->


<?php require_once("includes/footer.php"); ?>
