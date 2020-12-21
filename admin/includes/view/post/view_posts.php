<?php
use classes\Post;

if (isset($_SESSION['user_info']['access']) && $_SESSION['user_info']['access'] == 3) {
    $posts = Post::find_all();
} else {
    $posts = Post::find_the_query("select * from oop.posts where user_id = ?", [$_SESSION['user_info']['id']]);
}

?>

<div class="col-lg-12"  style="overflow: auto;">
    <a href="?source=add_post" class="btn btn-primary pull-right">+ New</a>
    <h1 class="page-header">
        All posts
        <small>Admin Access</small>
    </h1>



    <table class="table table-responsive table-bordered">

        <thead>
            <tr>
<!--                <th>Photo</th>-->
                <th>Id</th>
                <th>Title</th>
                <th>Content</th>
                <th>User Created</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Description</th>
                <th>Creation Date</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $post): ?>
        <tr style="overflow: auto;">
<!--                --><?php //if (!empty($post->photo)): ?>
<!--            <td>-->
<!--                <img class="img-thumbnail" width="50%" src="../--><?php //echo $post->get_photo_path(); ?><!--" alt="">-->
<!--            --><?php //else: ?>
<!--                <small>No photo</small>-->
<!--            --><?php //endif; ?>
<!--                </td>-->

            <td><?php echo $post->id; ?></td>
            <td><?php echo $post->title; ?></td>
            <td><?php echo substr($post->content, 0, 60); ?> ...</td>
            <td><?php echo $post->user_id; ?></td>

            <td>
                <?php $cat = \classes\Cat::find_by_id($post->cat_id); echo $cat->title; ?>
            </td>

            <td><?php echo $post->tags; ?></td>
            <td><?php echo $post->description; ?></td>
            <td><?php echo $post->creation_date(); ?></td>

            <td>
                <?php echo $post->status == 0 ? 'ِDraft' : 'Published'; ?>
            </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" value="<?php echo $post->id ?>" name="post_id">
                    <?php if ($post->status == 0): ?>
                    <button type="submit" class="btn btn-success btn-block" name="publish_post">Publish</button>
                    <?php else: ?>
                    <button type="submit" class="btn btn-warning btn-block" name="draft_post">Draft</button>
                    <?php endif; ?>
                </form>
            </td>


            <td>
                <a class="btn btn-primary" href="?source=edit_post&id=<?php echo $post->id; ?>">Edit</a>
            </td>

            <td>

                <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $post->id; ?>">
                    <input type="submit" class="btn btn-danger" name="delete_item_btn" value="Delete">
                </form>

            </td>
        </tr>

        <?php endforeach; ?>
        </tbody>


    </table>




<?php
if (isset($_POST['delete_item_btn'])) {
    $post_id_for_delete = $_POST['delete_id'];
    $post_to_delete = Post::find_by_id($post_id_for_delete);
    // Admin Access
    if (isset($_SESSION['user_info']['access']) && $_SESSION['user_info']['access'] == 3) {

        $post_to_delete->delete_with_photo();
    }
    redirect("posts.php");

}


if (isset($_POST['publish_post'])) {

    $post_id = $_POST['post_id'];
    Post::change_status($post_id, 1);
    redirect("posts.php");
}

if (isset($_POST['draft_post'])) {

    $post_id = $_POST['post_id'];
    Post::change_status($post_id, 0);
    redirect("posts.php");
}


?>


















</div>
