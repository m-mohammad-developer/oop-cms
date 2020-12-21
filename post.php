

<?php

use classes\Comment;

require_once("includes/header.php"); ?>
<?php require_once("includes/navigation.php"); ?>



<?php



if (!isset($_GET['id'])) {
    redirect("index.php");
}

//try {
//    $post = \classes\Post::find_by_id($_GET['id']);
//} catch (Exception $e) {
//    print($e);
//}

    $post = \classes\Post::find_by_id($_GET['id']);


?>

<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <?php if (!$post): ?>

                    <div class="alert alert-warning text-center text-capitalize">Post Not Find Go to <a href="index.php">Home</a></div>

                <?php else:  ?>

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    <?php $user = \classes\User::find_by_id($post->user_id); ?>
                    by <a href="user_posts.php?id=<?php echo $user->id; ?>" title="See User Posts"><?php echo $user->username; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post->creation_date(); ?></p>

                <hr>

                <!-- Preview Image -->
                <?php if ($post->have_photo() ): ?>
                <img class="img-responsive" src="<?php echo $post->get_photo_path(); ?>" alt="<?php echo $post->title; ?>">
                <?php endif; ?>
                <hr>

                <!-- Post Content -->

                    <p class="lead"><?php echo $post->content; ?></p>

                <hr>


                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                <!-- Blog Comments -->

                    
                <?php
                if (isset($_POST['send_comment'])) {
                    $comment = new Comment();
                    $comment->author = $_POST['comment_author'];  
                    $comment->email = $_POST['comment_email'];  
                    $comment->body = $_POST['comment_body'];  
                    $comment->post_id = $_GET['id'];

                    if ($comment->create()) {
                        $session->set_message('comment_success', 'comment sent successfuly after aproving by admins will apear here.');
                    }
                }
                
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <?php if ($session->check_for_message('comment_success')) : ?> 
                    <div class="alert alert-success">
                        <?php 
                        
                            echo $session->check_for_message('comment_success');
                            $session->remove_message('comment_success');
                            //unset($_SESSION['message']['comment_success']);
                        
                        ?>
                    </div>
                    <?php endif; ?>
                    <h4>Leave a Comment:</h4>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Your Name" required name="comment_author">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter Your Email" required name="comment_email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" placeholder="Write your comment" required name="comment_body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="send_comment">SEND</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php $comments = \classes\Comment::find_all_approved_comments_by_post_id($_GET['id']);?>

                <?php if ($comments): ?>
                    <?php foreach ($comments as $comment): ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <small><?php echo $comment->creation_date($comment->id); ?></small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>
                    <?php endforeach; ?>
                <?php else: ?>
                <div class="alert alert-warning text-capitalize">no comments for this post!!! Write the first one</div>
                <?php endif; ?>

            <?php endif; ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
                    
            

            </div>
            

        
        
        </div>
        <!-- /.row -->
        

        <hr>


    </div>
    <!-- /.container -->


<?php require_once("includes/footer.php"); ?>