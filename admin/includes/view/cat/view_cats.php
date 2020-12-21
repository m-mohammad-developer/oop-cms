<?php
use classes\Cat;


$cats = Cat::find_all();


?>

<div class="col-lg-12"  style="overflow: auto;">
    <a href="?source=add_cat" class="btn btn-primary pull-right">+ New</a>
    <h1 class="page-header">
        All cats
        <small>Admin Access</small>
    </h1>



    <table class="table table-responsive table-bordered">

        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($cats): ?>
        <?php foreach ($cats as $cat): ?>
        <tr>
            <td><?php echo $cat->id; ?></td>
            <td><?php echo $cat->title; ?></td>
            <td><?php echo $cat->description; ?></td>

            <td>
                <a class="btn btn-primary" href="?source=edit_cat&id=<?php echo $cat->id; ?>">Edit</a>
            </td>

            <td>
                <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $cat->id; ?>">
                    <input type="submit" class="btn btn-danger" name="delete_item_btn" value="Delete">
                </form>
<!--                <a class="btn btn-danger" href="?delete=--><?php //echo $cat->id; ?><!--">Delete</a>-->
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning">No Categories, Make a New One</div>
        <?php endif; ?>
        </tbody>


    </table>

<?php
if (isset($_POST['delete_item_btn'])) {
    $cat_id_for_delete = $_POST['delete_id'];
    $cat_to_delete = \classes\cat::find_by_id($cat_id_for_delete);
    // Admin Access
    if (isset($_SESSION['user_info']['access']) && $_SESSION['user_info']['access'] >= 2) {
        $cat_to_delete->delete();
        redirect("cats.php");
    }
}
?>


<?php

if (isset($_GET['source'])) {

    $source = $_GET['source'];

    if ($source == "add_cat") {
        include(VIEW_PATH . DS . 'cat' . DS . 'add_cat.php');
    }

    if ($source == "edit_cat") {
        include(VIEW_PATH . DS . 'cat' . DS . 'edit_cat.php');;
    }



}

?>















</div>
