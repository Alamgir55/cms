<?php include "includes/admin_header.php"; ?>
<?php
   // 
    $post_count = count_records(get_all_user_posts());
    $comment_count = count_records(get_all_posts_user_comments()); 
    $category_count = count_records(get_all_user_categories()); 
    $post_published_count = count_records(get_all_user_published_posts());
    $post_draft_count = count_records(get_all_user_draft_posts());
    $approved_comments_count = count_records(get_all_user_approved_posts_comments());
    $unapproved_comments_count = count_records(get_all_user_unapproved_posts_comments());

    //$unapproved_comments_count =10;
?>


    <div id="wrapper">
        
        <!-- Navigation -->

<?php include "includes/admin_navigation.php"; ?>       
       

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                             <small>
                                Role: Admin
                            </small>
                            Welcome to admin                            
                            <?php echo strtoupper(get_user_name()); ?>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php echo "<div class='huge'>".$post_count."</div>" ?>
                        
                        <div>Posts</div>
                    </div>
                </div>
            </div>


            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     
                    <?php echo "<div class='huge'>".$comment_count."</div>" ?>

                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php echo "<div class='huge'>".$category_count."</div>" ?>

                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->


    <?php 
        



        

    ?>                
    <div class="row">
        <script type="text/javascript">
          google.charts.load('current', {'packages':['bar']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Data', 'Count'],

              <?php 
                $element_text = ['All Post','Active Posts','Draft', 'Comments', 'Pending Comments','Approved Comments','Categories'];
                $element_count = [$post_count, $post_published_count ,$post_draft_count, $comment_count, $unapproved_comments_count, $approved_comments_count, $category_count];

                for($i = 0;$i < 7; $i++){
                    echo "['{$element_text[$i]}'" . ",". "{$element_count[$i]}],";
                }

              ?>

             // ['Post', 1000],
           
            ]);

            var options = {
              chart: {
                title: '',
                subtitle: '',
              }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        </script>
        <div id="columnchart_material" style="width: auto; height: 500px;"></div>   
    </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 <script src="https://js.pusher.com/4.3/pusher.min.js"></script>

 <script>
        $(document).ready(function(){

            var pusher = new Pusher('8cd8abf7945af91cfe41', {
                cluster: 'us2', 
                encrypt: true
            });

            var notificationChannel = pusher.subscribe('notifications');

            notificationChannel.bind('new_user', function(notification){

                var message = notification.message;

                toastr.success(`${message} just registered`);
                           
            });
        });


 </script>
