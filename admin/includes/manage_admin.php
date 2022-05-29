<?php

session_start();

require('../../includes/db.php');


// ADD ADMIN
if(isset($_POST['addAdmin'])){
    $adminName=mysqli_real_escape_string($db,$_POST['adminName']);
    $adminDesignation=mysqli_real_escape_string($db,$_POST['adminDesignation']);
    $adminEmail=mysqli_real_escape_string($db,$_POST['adminEmail']);
    $adminPass=mysqli_real_escape_string($db,$_POST['adminPass']);
    $query="INSERT INTO admin(full_name, designation, email, password) VALUES ('$adminName', '$adminDesignation', '$adminEmail', '$adminPass')";

    $_SESSION['message']= $adminName." - added as new - ".$adminDesignation;
    $_SESSION['msg_type']="success";
    $_SESSION['msg_icon']="bi-check-circle";

    if(mysqli_query($db,$query)){
        header("location:../pages_manage_admins.php");
    }else{
        echo $adminName." - is not added !";
    }
}


// REMOVE ADMIN
if(isset($_GET['removeAdmin'])){
    $id=$_GET['removeAdmin'];
    $query="DELETE FROM admin WHERE id=$id";

    $_SESSION['message']= "An admin removed !";
    $_SESSION['msg_type']="danger";
    $_SESSION['msg_icon']="bi-exclamation-octagon";

    if(mysqli_query($db,$query)){
        header("location:../pages_manage_admins.php");
    }else{
        echo "admin is not removed !";
    }
}


//  EDIT CATEGORY
// if(isset($_GET['editCategory'])){
//     $id=$_GET['editCategory'];
// }


?>