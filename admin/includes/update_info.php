<?php

require('../../includes/db.php');

if(isset($_POST['updateInfo'])){
    $adminId=mysqli_real_escape_string($db,$_POST['admin_id']);
    $fullName=mysqli_real_escape_string($db,$_POST['fullName']);
    $about=mysqli_real_escape_string($db,$_POST['about']);
    $designation=mysqli_real_escape_string($db,$_POST['adminDesignation']);
    $country=mysqli_real_escape_string($db,$_POST['country']);
    $address=mysqli_real_escape_string($db,$_POST['address']);
    $phone=mysqli_real_escape_string($db,$_POST['phone']);

    if(empty($_FILES['profileImage']['name'])){
        $profileImageName='admin.png';
    }else{
        $profileImageName=time() . '_' . $_FILES['profileImage']['name'];
    }
    $profileImageTmpName=$_FILES['profileImage']['tmp_name'];
    $imageFolder='../images/' . $profileImageName;
    move_uploaded_file($profileImageTmpName, $imageFolder);

    $query="UPDATE admin SET full_name='$fullName',about='$about',designation='$designation',country='$country',address='$address',phone='$phone',profile_image='$profileImageName' WHERE id=$adminId";

    if(mysqli_query($db,$query)){
        header("location:../users-profile.php");
    }else{
        echo "Information not updated !";
    }
}

?>