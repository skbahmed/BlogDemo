<?php

session_start();

require('db.php');

if(isset($_POST['addPost'])){
    $postTitle=mysqli_real_escape_string($db, $_POST['postTitle']);
    $postCategory=$_POST['postCategory'];
    $postContent=mysqli_real_escape_string($db, $_POST['postContent']);
    $query="INSERT INTO posts(title,content,category_id) VALUES ('$postTitle', '$postContent', '$postCategory')";
    $run=mysqli_query($db, $query);
    
    $postId=mysqli_insert_id($db);
    
    $postImageName=$_FILES['postImage']['name'];
    $postImageTempName=$_FILES['postImage']['tmp_name'];
    foreach($postImageName as $index=>$image){
        if(move_uploaded_file($postImageTempName[$index], "../images/$image")){
            $query="INSERT INTO images(post_id, image) VALUES ('$postId', '$image')";
            $run=mysqli_query($db, $query);
        }
    }

    $_SESSION['message']= "a new post added";
    $_SESSION['msg_type']="success";
    $_SESSION['msg_icon']="bi-check-circle";

    if(mysqli_query($db,$query)){
        header("location:../admin/pages_manage_post.php");
    }else{
        echo "post is not added !";
    }
}



?>