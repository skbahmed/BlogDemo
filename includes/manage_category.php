<?php

session_start();

require('db.php');


// ADD CATEGORY
if(isset($_POST['addCategory'])){
    $categoryName=mysqli_real_escape_string($db,$_POST['categoryName']);
    $query="INSERT INTO category(name, parent_menu_id) VALUES ('$categoryName', 3)";

    $_SESSION['message']= $categoryName." - added as new category.";
    $_SESSION['msg_type']="success";
    $_SESSION['msg_icon']="bi-check-circle";

    if(mysqli_query($db,$query)){
        header("location:../admin/pages_manage_categories.php");
    }else{
        echo "category is not added !";
    }
}


// REMOVE CATEGORY
if(isset($_GET['removeCategory'])){
    $id=$_GET['removeCategory'];
    $query="DELETE FROM category WHERE id=$id";

    $_SESSION['message']= " A category removed !";
    $_SESSION['msg_type']="danger";
    $_SESSION['msg_icon']="bi-exclamation-octagon";

    if(mysqli_query($db,$query)){
        header("location:../admin/pages_manage_categories.php");
    }else{
        echo "category is not removed !";
    }
}


//  EDIT CATEGORY
if(isset($_GET['editCategory'])){
    $id=$_GET['editCategory'];
    $nameOfCategory=mysqli_real_escape_string($db,$_POST['categoryName']);
    $query="UPDATE category SET name='$nameOfCategory' WHERE id=$id";

    $_SESSION['message']= " A category updated !";
    $_SESSION['msg_type']="warning";
    $_SESSION['msg_icon']="bi-exclamation-octagon";

    if(mysqli_query($db,$query)){
        header("location:../admin/pages_manage_categories.php");
    }else{
        echo "category is not updated !";
    }
}


?>