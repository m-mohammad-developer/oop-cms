<?php require_once("includes/view/header.php"); ?>
<?php require_once(VIEW_PATH . DS . "navigation.php"); ?>

<div id="wrapper">


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Blank Page
                        <small>Subheading</small>
                    </h1>
                    <pre>
                        <?php

                        $arr = ["username" => 'ali', "password" => '12345'];

                        $array = [];
                        foreach ($arr as $key => $val) {
                            $array[] = "$key = $val";
                        }
                        var_dump(implode(" and ", array_values($array)));
                        print_r($array);

                        ?>
</pre>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php require_once(VIEW_PATH . DS . "footer.php"); ?>
