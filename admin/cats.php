<?php require_once("includes/view/header.php"); ?>
<?php
// Check Access Level : requires = 2 (adminstrator)
if (!isset($_SESSION['user_info']) || !($_SESSION['user_info']['access'] >= 2)) {
    redirect("index.php");
}
?>
<?php require_once(VIEW_PATH . DS ."navigation.php"); ?>
<?php use classes\cat; ?>

    <div id="wrapper">



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row" style="overflow: auto;">


                    <?php
//                    if (isset($_GET['source'])) {
//                        $source = $_GET['source'];
//                    } else {
//                        $source = '';
//                    }
//                    switch ($source) {
//                        case 'add_cat':
//                            include(VIEW_PATH . DS . 'cat' . DS . 'add_cat.php');
//                            break;
//                        case 'edit_cat':
//                            include(VIEW_PATH . DS . 'cat' . DS . 'edit_cat.php');
//                            break;
//
//                        default:
//                            include(VIEW_PATH . DS . 'cat' . DS . 'view_cats.php');
//                            break;
//                    }
                    include(VIEW_PATH . DS . 'cat' . DS . 'view_cats.php');
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
