<?php

// DATABASE CONNECTION
require('includes/db.php');

// FUNCTION CONNECTION
include('includes/function.php');

if(isset($_GET['page'])){
  $page=$_GET['page'];
}else{
  $page=1;
}
$post_per_page=6;
$result=($page-1)*$post_per_page;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <title>Blog Demo | Home</title>
</head>

<body>
  <!-- NAV BAR FROM INCLUDES -->
  <?php include_once("includes/navbar.php"); ?>

  <!-- TOTAL BODY -->
  <div>

    <!-- MAIN -->
    <div class="container m-auto mt-3 row">

      <!-- POSTS -->
      <div class="col-8">
        <?php
        if(isset($_GET['search'])){
          $keyword = $_GET['search'];
          $postQuery = "SELECT * FROM posts WHERE title LIKE '%$keyword%' ORDER BY created_at DESC LIMIT $result,$post_per_page";
        }
        elseif(isset($_GET['subMenu'])){
          $subMenuId=$_GET['subMenu'];
          $postQuery = "SELECT * FROM posts WHERE category_id=$subMenuId ORDER BY created_at DESC LIMIT $result,$post_per_page";
        }
        else{
          $postQuery = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $result,$post_per_page";
        }
        $runPQ = mysqli_query($db, $postQuery);
        while ($post = mysqli_fetch_assoc($runPQ)) {
        ?>
        <div class="card mb-3" style="max-width: 800px;">
          <a href="post.php?id=<?=$post['id']?>" class="text-decoration-none text-dark">
            <div class="row g-0">
              <div class="col-md-5" style="background-image: url('https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg');background-size: cover">
                <!-- <img src="https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg" alt="..."> -->
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h5 class="card-title text-capitalize"><?=$post['title']?></h5>
                  <p class="card-text text-truncate"><?=$post['content']?></p>
                  <p class="card-text"><small class="text-muted">Posted on <?=date('h:i, D, d F Y', strtotime($post['created_at']));?></small></p>
                </div>
              </div>
            </div>
          </a>
        </div>
        <?php
        }
        ?>
      </div>

      <!-- SIDEBAR FROM INCLUDES -->
      <?php include_once("includes/sidebar.php"); ?>
    </div>
    
    <!-- PAGINATION BUTTON -->
    <?php
    if(isset($_GET['search'])){
      $keyword=$_GET['search'];
      $paginationQuery="SELECT * FROM posts WHERE title LIKE '%$keyword%'";
    }
    elseif(isset($_GET['subMenu'])){
      $subMenuId=$_GET['subMenu'];
      $paginationQuery = "SELECT * FROM posts WHERE category_id=$subMenuId";
    }
    else {
      $paginationQuery="SELECT * FROM posts";
    }
    $runPaginationQuery=mysqli_query($db,$paginationQuery);
    $total_posts=mysqli_num_rows($runPaginationQuery);
    $total_pages=ceil($total_posts/$post_per_page);
    ?>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">

        <!-- PREVIOUS --- NEXT BUTTON -->
        <?php

        // PREVIOUS BUTTON
        if($page>1){
          $prevSwitch="";
        }else{
          $prevSwitch="disabled";
        }

        // NEXT BUTTON
        if($page<$total_pages){
          $nextSwitch="";
        }else{
          $nextSwitch="disabled";
        }

        ?>

        <!-- PREVIOUS BUTTON --> 
        <li class="page-item <?=$prevSwitch?>">
          <a class="page-link" href="?<?php if(isset($_GET['search'])){echo "search=$keyword&";} elseif(isset($_GET['subMenu'])){echo "subMenu=$subMenuId&";}?> page=<?=$page-1?>" tabindex="-1" aria-disabled="true">Previous</a>
        </li>

        <!-- PAGE NUMBERED BUTTON -->
        <?php
        for($opage=1;$opage<=$total_pages; $opage++){
          if($page==$opage){
            $activeSwitch = "active";
          }else{
            $activeSwitch = "";
          }
          ?>
          <li class="page-item <?=$activeSwitch?>">
            <a class="page-link" href="?<?php if(isset($_GET['search'])){echo "search=$keyword&";} elseif(isset($_GET['subMenu'])){echo "subMenu=$subMenuId&";}?> page=<?=$opage?>"><?=$opage?></a>
          </li>
          <?php
        }
        ?>

        <!-- NEXT BUTTON -->
        <li class="page-item <?=$nextSwitch?>">
          <a class="page-link" href="?<?php if(isset($_GET['search'])){echo "search=$keyword&";} elseif(isset($_GET['subMenu'])){echo "subMenu=$subMenuId&";}?> page=<?=$page+1?>">Next</a>
        </li>
      </ul>
    </nav>

    <!-- FOOTER FROM INCLUDES -->
    <?php include_once("includes/footer.php"); ?>
  </div>

  <!-- BOOTSTRAP SCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js" integrity="sha512-5qbIAL4qJ/FSsWfIq5Pd0qbqoZpk5NcUVeAAREV2Li4EKzyJDEGlADHhHOSSCw0tHP7z3Q4hNHJXa81P92borQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>