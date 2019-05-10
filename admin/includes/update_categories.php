<form action="" method="post">
                <div class="form-group">
                    <label for="cat-title">Edit Category</label>

                <?php 
                    if(isset($_GET['edit'])){
                        $cat_id = escape($_GET['edit']);

                        $stmt1 = mysqli_prepare($connection, "SELECT cat_id, cat_title FROM categories WHERE cat_id = ?");
                        mysqli_stmt_bind_param($stmt1, "i", $cat_id);
                        mysqli_stmt_execute($stmt1);
                        mysqli_stmt_bind_result($stmt1, $cat_id, $cat_title);

                        while(mysqli_stmt_fetch($stmt1)):
                           
                ?>    
                <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">


                <?php endwhile; mysqli_stmt_close($stmt1); }  ?>

                <?php 
                    if(isset($_POST['update_category'])){
                        $the_cat_title = escape($_POST['cat_title']);

                        $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ? ");
                        mysqli_stmt_bind_param($stmt, "si", $the_cat_title, $cat_id);
                        mysqli_stmt_execute($stmt);
                        if(!$stmt){
                            die("Query Fail" . mysqli_error($connection));
                        }

                        redirect("categories.php");
                        mysqli_stmt_close($stmt);

                    }

                ?>
                    
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                </div>
        </form>