<?php require_once("includes/header.php"); ?>
<?php require_once("includes/navigation.php"); ?>


<?php
$posts = \classes\Post::find_all_where(['status' => 1]);
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Learn Very Easy
                </h1>

                <!-- First Blog Post -->
                <?php if($posts): ?>
                <?php foreach ($posts as $post): ?>
                <h2>
                    <a href="post.php?id=<?php echo $post->id; ?>"><?php echo $post->title;?></a>
                </h2>
                <p class="lead">
                    <?php $user = \classes\User::find_by_id($post->user_id); ?>
                    by <a href="user_posts.php?id=<?php echo $user->id; ?>" title="See User Posts"><?php echo $user->username; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post->creation_date();?></p>
                <hr>
               
                <?php if ($post->have_photo()): ?>
                    <a href="post.php?id=<?php echo $post->id; ?>">
                        <img class="img-responsive" src="<?php echo $post->get_photo_path(); ?>" alt="<?php echo $post->title; ?>">
                    </a>
                <?php endif; ?>
                <hr>
                <p><?php echo substr($post->title, 0, 255); ?> ...</p>

                    <br>
                    <br>
                    <hr>
                <a class="btn btn-primary" href="post.php?id=<?php echo $post->id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php endforeach; ?>

                    <!-- Pager -->
                    <ul class="pager">
                        <li class="previous">
                            <a href="#">&larr; Older</a>
                        </li>
                        <li class="next">
                            <a href="#">Newer &rarr;</a>
                        </li>
                    </ul>

                <?php else: ?>
                <div class="alert alert-warning text-capitalize">No Posts Yet Please come back later.</div>
                <?php endif; ?>
                


            </div>

           
<?php require_once("includes/sidebar.php"); ?>

        </div>
        <!-- /.row -->

        <hr>

        

    </div>
    <!-- /.container -->


<?php require_once("includes/footer.php"); ?>
