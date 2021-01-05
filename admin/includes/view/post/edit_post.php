<?php defined('SITE_ROOT') OR die("Access Denied!"); ?>
<?php
if (empty($_GET['id'])) {
    redirect("posts.php");
}
$post = \classes\Post::find_by_id($_GET['id']);

if (isset($_POST['update_post'])) {

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
        if (isset($_SESSION['user_info']['access']) && $_SESSION['user_info']['id'] == $post->user_id && $_SESSION['user_info']['access'] >= 1) {



            $post->title = $_POST['title'];
            $post->content = $_POST['content'];
            //$post->user_id = $_SESSION['user_info']['id'];
            $post->cat_id = $_POST['cat_id'];
            $post->status = $_POST['status'];
            $post->tags = $_POST['tags'];
            $post->description = $_POST['description'];

            if (isset($_FILES['photo'])) {
                $post->set_post_photo($_FILES['photo']);
            }


            if ($post->save_with_photo()) {
                redirect("posts.php");
            }

//        print_r($post->errors);
        } else {
            $access_error = "You are Not Allowed";
        }
    }

}
?>
<div class="col-sm-12"  style="">
    <?php if (isset($access_error)):?>
        <div class="alert alert-danger text-center"><h1><?php echo $access_error;?></h1></div>
    <?php endif; ?>
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

        
        <div class="img-responsive text-center" style="width: 100%" >
            <img class="img-thumbnail" width="50%" src="../<?php echo $post->get_photo_path(); ?>" alt="">
        </div>



        <br />

        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter the title " value="<?php echo $post->title; ?>">
        </div>

        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea class="form-control" name="content" cols="30" rows="20" placeholder="Write Post Content"><?php echo $post->content; ?></textarea>
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
                    <option <?php if ($cat->id == $post->cat_id) echo "selected";?> value="<?php echo $cat->id; ?>"><?php echo $cat->title; ?></option>

                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" name="tags" class="form-control" placeholder="Enter Post Tags " required  value="<?php echo $post->tags; ?>">
        </div>

        <div class="form-group">
            <label for="description">Post Description</label>
            <textarea class="form-control" name="description" cols="30" rows="5" placeholder="Write Post Description"><?php echo $post->description; ?></textarea>
        </div>


        <div class="form-group">
            <label for="photo">Post Photo(optional)</label>
            <input type="file" name="photo" class="form-control">
        </div>


        <div class="form-group">
            <label for="status">Choose Post Status</label>
            <select class="form-control" name="status" id="">
                <?php
                if ($post->status == 0)
                ?>

                <option <?php if ($post->status == 0) echo "selected";?> value="0">Draft</option>
                <option <?php if ($post->status == 1) echo "selected";?> value="1">Published</option>
            </select>
        </div>
        <br />
        <br />


        <div class="form-group">
            <button type="submit" name="update_post" class="btn btn-block btn-primary">Update post</button>
        </div>

        <br />
        <br />
    </form>

</div>