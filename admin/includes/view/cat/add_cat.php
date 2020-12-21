<?php



if (isset($_POST['create_cat'])) {

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

        $cat = new \classes\Cat();

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
        Add cat

        <small>Adminstrator Access</small>
    </h1>


    <?php if (isset($form_errors) && !empty($form_errors)): ?>
    <ul class="list-group">
        <?php
        foreach ($form_errors as $key => $form_error) {
            echo "<li class='list-group-item list-group-item-danger'>* $form_error</li>";
        }
        ?>
    </ul>
    <?php endif; ?>

    <form action="" method="post">


        <br />

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter The Title" required>
        </div>

        <div class="form-group">
            <label for="description">About Category</label>
            <textarea class="form-control" name="description" cols="30" rows="10" placeholder="Say Somethings About This category(optional)"></textarea>
        </div>


        <div class="form-group">
            <button type="submit" name="create_cat" class="btn btn-block btn-primary">Create cat
            </button>
        </div>

    </form>

</div>