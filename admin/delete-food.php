<?php
        //include constants page
        include('../config/constants.php');

       // echo "Delete Food Page";

       if(isset($_GET['id']) && isset($_GET['image_name']))  //either use '&&' or 'AND'
       {
           //process to delete
           //echo "Process to Delete";

           //1.get id and image name 
           $id= $_GET['id'];
           $image_name = $_GET['image_name'];

           //2.remove the image if available
           //check whether the image is available or not and delete only if available
           if($image_name !=="")
           {
                //it has image and need to remove from folder
                //get the image path
                $path = "../images/food/".$image_name;

                //remove image file from folder
                $remove = unlink($path);

                //check whether the image is removed or not
                if($remove==false)
                {
                    //failed to remove image
                    $_SESSION['upload'] = "<div class='error'>Failed to remove image file</div>";
                    //redirect to manage food
                    header('location:'.SITEURL.'admin/manage-food.php');
                    //stop the process
                    die();
                }

           }

           //3.delete food from database
           $sql = "DELETE FROM tbl_food WHERE id=$id";

           //execute the query
           $res = mysqli_query($conn, $sql);

           //check whether the query executed or not set the session message respectively
           if($res==true)
           {
                //food delete
                $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
           }
           else
           {
                    //failed to delete food
                    $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
           }

           //4.redirect to manage food with session message
       }
       else
       {
           //redirect to manage food page
           //echo "Redirect";
           $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
           header('location:'.SITEURL. 'admin/manage-food.php');
       }

?>