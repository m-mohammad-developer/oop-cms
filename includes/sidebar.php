<?php defined('SITE_ROOT') OR die("Access Denied!"); ?>
<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <form action="search.php" method="post">
                        <h4>Blog Search</h4>
                        <div class="input-group">
                            <input type="text" class="form-control" name="search-text">
                            <span class="input-group-btn">
                                
                            </button>
                            <button class="btn btn-default" type="submit" name="search-request">
                                    <span class="glyphicon glyphicon-search"></span>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">                          
                            <?php
                            $cats = classes\Cat::find_all();
                            foreach ($cats as $cat):
                            ?>
                                <li><a href="cat.php?id=<?php echo $cat->id; ?>"><?php echo $cat->title; ?></a>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- /.col-lg-6 -->
                        <!-- <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
<!--                 
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
                         -->
            </div>