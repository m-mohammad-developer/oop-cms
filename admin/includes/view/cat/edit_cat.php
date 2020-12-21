<?php use classes\Cat; ?>
<?php
if (empty($_GET['id'])) {
    redirect("cats.php");
}

$cat = Cat::find_by_id($_GET['id']);





if (isset($_POST['update_cat'])) {

    $form_errors = [];


    if(empty($_POST['title'])) {
        $form_errors['title_empty'] = "title Should Not Be Empty";
    }
    if(strlen($_POST['title']) <= 3) {
        $form_errors['title_len'] = "title Should Be Longer Than 2";
    }


    foreach ($form_errors as $key) {
        if (empty($form_errors[$key])) {
            unset($form_errors[$key]);
        }
    }

    if (empty($form_errors)) {


        $cat->title = $_POST['title'];
        $cat->description = $_POST['description'];

        if ($cat->save()) {
            redirect("cats.php");
        }

    }









}
?>
<div class="col-sm-6 col-sm-offset-3"  style="">
    <h1 class="page-header">
        Edit cat
        <small>Admin Access</small>
    </h1>


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
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter The Title" value="<?php echo $cat->title; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">About Category</label>
            <textarea class="form-control" name="description" cols="30" rows="10" placeholder="Say Somethings About This category(optional)"><?php echo $cat->description; ?></textarea>
        </div>


        <div class="form-group">
            <button type="submit" name="update_cat" class="btn btn-block btn-primary">Update Cat</button>
        </div>

    </form>

</div>