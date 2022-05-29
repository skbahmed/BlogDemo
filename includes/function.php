<?php



function getCategory($db,$id){
    $query="SELECT * FROM category WHERE id=$id";
    $run = mysqli_query($db,$query);
    $data = mysqli_fetch_assoc($run);
    return $data['name'];
}

function getAllCategory($db){
    $query="SELECT * FROM category ORDER BY id";
    $run = mysqli_query($db,$query);
    $data = array();
    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d;
    }
    return $data;
}


function getSubMenu($db,$menu_id){
    $query="SELECT * FROM category WHERE parent_menu_id=$menu_id ORDER BY id";
    $run = mysqli_query($db,$query);
    $data = array();

    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d;
    }
    return $data;
}

function getSubMenuNo($db,$menu_id){
    $query="SELECT * FROM category WHERE parent_menu_id=$menu_id";
    $run = mysqli_query($db,$query);
    return mysqli_num_rows($run);
}


function getImagesByPost($db,$post_id){
    $query="SELECT * FROM images WHERE post_id=$post_id";
    $run = mysqli_query($db, $query);
    $data = array();

    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d;
    }
    return $data;
}


function getComments($db,$post_id){
    $query="SELECT * FROM comments WHERE post_id=$post_id ORDER BY commented_at DESC";
    $run = mysqli_query($db, $query);
    $data = array();

    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d;
    }
    return $data;
}


function getAdminInfo($db,$email){
    $query="SELECT * FROM admin WHERE email='$email'";
    $run=mysqli_query($db,$query);
    $data = mysqli_fetch_assoc($run);
    return $data;
}

function getAllAdminInfo($db){
    $query="SELECT * FROM admin ORDER BY id";
    $run = mysqli_query($db,$query);
    $data = array();
    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d;
    }
    return $data;
}

function getAllAdminDesignation($db){
    $query="SELECT * FROM admin_designation ORDER BY id";
    $run = mysqli_query($db,$query);
    $data = array();
    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d;
    }
    return $data;
}



// let user has an id
$user_id = 2;
$query = "SELECT * FROM posts";
$run = mysqli_query($db, $query);
$posts = mysqli_fetch_all($run, MYSQLI_ASSOC);

if(isset($_POST['action'])){
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];

    switch ($action) {
        case 'like':
            $query = "INSERT INTO rating_info (post_id, user_id, rating_action) 
                    VALUES ($post_id, $user_id, '$action')
                    ON DUPLICATE KEY UPDATE rating_action='like'";
            break;
        case 'dislike':
            $query = "INSERT INTO rating_info (post_id, user_id, rating_action) 
                    VALUES ($post_id, $user_id, '$action')
                    ON DUPLICATE KEY UPDATE rating_action='dislike'";
            break;
        case 'unlike':
            $query = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
            break;
        case 'undislike':
            $query = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
            break;
        default:
            break;
    }
    mysqli_query($db, $query);
    exit(0);
}

?>
