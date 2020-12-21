<?php require_once("includes/view/header.php"); ?>


<?php
// Check Access Level : requires = 3 (admin)
if (!isset($_SESSION['user_info']) || $_SESSION['user_info']['access'] != 3) {
    redirect("index.php");
}
?>

<?php require_once(VIEW_PATH . DS ."navigation.php"); ?>
<?php use classes\User; ?>

    <div id="wrapper">



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row" style="overflow: auto;">


                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_user':
                            include(VIEW_PATH . DS . 'user' . DS . 'add_user.php');
                            break;
                        case 'edit_user':
                            include(VIEW_PATH . DS . 'user' . DS . 'edit_user.php');
                            break;

                        default:
                            include(VIEW_PATH . DS . 'user' . DS . 'view_users.php');
                            break;
                    }
                    ?>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php require_once(VIEW_PATH . DS ."footer.php"); ?>
