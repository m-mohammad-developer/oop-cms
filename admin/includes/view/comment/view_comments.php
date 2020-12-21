<?php
use classes\Comment;


$comments = Comment::find_all();


?>

<div class="col-lg-12"  style="overflow: auto;">
    <h1 class="page-header">
        All comments
        <small>Administrator Access : 2</small>
    </h1>



    <table class="table table-responsive table-bordered">

        <thead>
            <tr>
                

                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>body</th>
                <th>post_id</th>
                <th>creation_date</th>
                <th>status</th>

            </tr>
        </thead>
        <tbody>
        <?php if($comments): ?>
        <?php foreach ($comments as $comment): ?>
        <tr>
            <td><?php echo $comment->id; ?></td>
            <td><?php echo $comment->author; ?></td>
            <td><?php echo $comment->email; ?></td>
            <td><?php echo $comment->body; ?></td>
            <td>
                <a href="../post.php?id=<?php echo $comment->post_id; ?>" class="btn btn-info">View</a>
            </td>

            <td><?php echo $comment->creation_date($comment->id); ?></td>

            <td><?php echo $comment->status == 0 ? 'Unapproved' : 'Approved'; ?></td>

            <td>
                <form action="" method="post">
                    <input type="hidden" value="<?php echo $comment->id ?>" name="comment_id">
                    <?php if ($comment->status == 0): ?>
                        <button type="submit" class="btn btn-success btn-block" name="approve_comment">Approve</button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-warning btn-block" name="unapprove_comment">Unapprove</button>
                    <?php endif; ?>
                </form>
            </td>

            <td>

                <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $comment->id; ?>">
                    <input type="submit" class="btn btn-danger" name="delete_item_btn" value="Delete">
                </form>

            </td>
        </tr>

        <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning">No Comments</div>
        <?php endif; ?>
        </tbody>


    </table>




<?php
if (isset($_POST['delete_item_btn'])) {

    $comment_id_for_delete = $_POST['delete_id'];
    $comment_to_delete = \classes\Comment::find_by_id($comment_id_for_delete);
    // Admin Access
    if (isset($_SESSION['user_info']['access']) && $_SESSION['user_info']['access'] >= 2) {
        $comment_to_delete->delete();
    }
    redirect("comments.php");

}


if (isset($_POST['approve_comment'])) {

    $post_id = $_POST['comment_id'];
    Comment::change_status($post_id, 1);
    redirect("comments.php");
}

if (isset($_POST['unapprove_comment'])) {

    $post_id = $_POST['comment_id'];
    Comment::change_status($post_id, 0);
    redirect("comments.php");
}
?>


















</div>
