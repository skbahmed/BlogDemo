<!-- LIKE DISLIKE HTML -->
<?php
if(isset($_GET['id'])){
    $likeCount = getLikeCount($db,$post_id);
    $dislikeCount = getDislikeCount($db,$post_id);
    ?>
    <a href="includes/add_like.php" class="btn btn-primary text-capitalize" name="addlike"><i class="fa-regular fa-heart"></i> like (<?=count($likeCount)?>)</a>
    <a href="#" class="btn btn-primary text-capitalize" name="adddislike"><i class="fa-regular fa-thumbs-down"></i> dislike (<?=count($dislikeCount)?>) </a>
    <?php
}
?>

<!-- LIKE DISLIKE FUNCTION -->
<?php

function getLikeCount($db,$post_id){
    $query="SELECT * FROM like_count WHERE post_id=$post_id";
    $run = mysqli_query($db, $query);
    $data = array();

    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d;
    }
    return $data;
}

function getDislikeCount($db,$post_id){
    $query="SELECT * FROM dislike_count WHERE post_id=$post_id";
    $run = mysqli_query($db, $query);
    $data = array();

    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d;
    }
    return $data;
}

?>