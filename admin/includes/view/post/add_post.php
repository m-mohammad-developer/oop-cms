<?php defined('SITE_ROOT') OR die("Access Denied!"); ?>
<?php
if (isset($_POST['create_post'])) {

    $form_errors = [];
    if(empty($_POST['title'])) {
        $form_errors['title'] = "title Should Not Be Empty";
    }

    if(!(($_POST['status'] == 1) || ($_POST['status'] == 0))) {
        $form_errors['status'] = "Choose Right Status";
    }

    foreach ($form_errors as $key) {
        if (empty($form_errors[$key])) {
            unset($form_errors[$key]);
        }
    }

    if (empty($form_errors)) {
        if (isset($_SESSION['user_info']['access']) && $_SESSION['user_info']['access'] >= 1) {

            $post = new \classes\post();

            $post->title = $_POST['title'];
            $post->content = $_POST['content'];
            $post->user_id = $_SESSION['user_info']['id'];
            $post->cat_id = $_POST['cat_id'];
            $post->status = $_POST['status'];
            $post->tags = $_POST['tags'];
            $post->description = $_POST['description'];

            $post->set_post_photo($_FILES['photo']);

            if ($post->save_with_photo()) {
                redirect("posts.php");
            }
        }
    }
}
?>
<div class="col-sm-12"  style="">
    <h1 class="page-header">
        Add post
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
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <br />
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter the title ">
        </div>

        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea class="form-control" name="content" cols="30" rows="20" placeholder="Write Post Content"></textarea>
        </div>
        <hr />
        <div class="form-group">
            <label for="role">Choose Post Category</label>
            <select class="form-control" name="cat_id" id="">
                <?php
                use classes\Cat;
                $cats = Cat::find_all();
                ?>
                <?php foreach ($cats as $cat):?>
                <option value="<?php echo $cat->id; ?>"><?php echo $cat->title; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" name="tags" class="form-control" placeholder="Enter Post Tags " required>
        </div>

        <div class="form-group">
            <label for="description">Post Description</label>
            <textarea class="form-control" name="description" cols="30" rows="5" placeholder="Write Post Description"></textarea>
        </div>


        <div class="form-group">
            <label for="photo">Post Photo(optional)</label>
            <input type="file" name="photo" class="form-control">
        </div>


        <div class="form-group">
            <label for="status">Choose Post Status</label>
            <select class="form-control" name="status" id="">
                <option value="0">Draft</option>
                <option value="1">Published</option>
            </select>
        </div>
        <br />
        <br />


        <div class="form-group">
            <button type="submit" name="create_post" class="btn btn-block btn-primary">Create post</button>
        </div>

        <br />
        <br />
    </form>

</div>