<?php require_once("includes/view/header.php"); ?>


<?php
// Check Access Level : requires = 2 (administrator)
if (!isset($_SESSION['user_info']) || $_SESSION['user_info']['access'] < 2) {
    redirect("index.php");
}
?>

<?php require_once(VIEW_PATH . DS ."navigation.php"); ?>
<?php use classes\Comment; ?>

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
                        //
                        //
                        default:
                            include(VIEW_PATH . DS . 'comment' . DS . 'view_comments.php');
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