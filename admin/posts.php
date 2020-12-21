<?php require_once("includes/view/header.php"); ?>

<?php
// Check Access Level : requires = 1 (editor)
if (!isset($_SESSION['user_info']) || !($_SESSION['user_info']['access'] >= 1)) {
    redirect("index.php");
}
?>

<?php require_once(VIEW_PATH . DS ."navigation.php"); ?>

<?php use classes\Post; ?>

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
                        case 'add_post':
                            include(VIEW_PATH . DS . 'post' . DS . 'add_post.php');
                            break;
                        case 'edit_post':
                            include(VIEW_PATH . DS . 'post' . DS . 'edit_post.php');
                            break;

                        default:
                            include(VIEW_PATH . DS . 'post' . DS . 'view_posts.php');
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
