<?php
require('includes/db.php');
require('includes/function.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"></link>
  <title>Blog Demo | Post</title>
</head>

<body>

  <!-- NAV BAR FROM INCLUDES -->
  <?php include_once("includes/navbar.php"); ?>

  <!-- TOTAL BODY -->
  <div>

    <!-- MAIN -->
    <div class="container m-auto mt-3 row">
      <!-- ALL POSTS -->
      <div class="col-8">
        <?php
        if(isset($_GET['search'])){
          $keyword=$_GET['search'];
          header("location:index.php?search=$keyword");
        }else {
          $post_id=$_GET['id'];
          $postQuery = "SELECT * FROM posts WHERE id=$post_id";
          $runPQ = mysqli_query($db,$postQuery);
          $post = mysqli_fetch_assoc($runPQ);
        }
        ?>
        <!-- SINGLE POST -->
        <div class="card mb-3">
          <div class="card-body">
            <!-- POST HEADER -->
            <h3 class="card-title text-capitalize"><?= $post['title'] ?></h3>
            <span class="badge bg-primary ">Posted on <?= date('h:i, D, d F Y', strtotime($post['created_at'])) ?></span>
            <span class="badge bg-danger text-capitalize"><?=getCategory($db, $post['category_id'])?></span>
            <div class="border-bottom mt-3"></div>
            <!-- POST IMAGE SLIDER-->
            <?php
            $post_images=getImagesByPost($db,$post['id']);
            ?>
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <?php
                $c=1;
                foreach($post_images as $image){
                  if($c>1){
                    $sw = "";
                  }else{
                    $sw="active";
                  }
                  ?>
                <div class="carousel-item my-3 <?=$sw?>" data-bs-interval="3000">
                  <img src="images/<?=$image['image']?>" class="d-block w-100" alt="..." style="height:400px">
                </div>
                  <?php
                  $c++;
                }
                ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <!-- POST CONTENT -->
            <p class="card-text my-3" style="text-align:justify"><?= $post['content'] ?></p>




            <!-- POST REACTION -->
            <a href="#" class="btn btn-primary text-capitalize" name=""><i class="far fa-thumbs-up like-btn" data-id="<?=$post['id']?>"></i></a>
            <a href="#" class="btn btn-primary text-capitalize" name=""><i class="far fa-thumbs-down dislike-btn" data-id="<?=$post['id']?>"></i></a>





            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary text-capitalize" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <?php
            if(isset($_GET['id'])){
              $comments = getComments($db,$post_id);
                ?>
                <i class="far fa-comment"></i> comment (<?=count($comments)?>)
                <?php
            }
            ?>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="staticBackdropLabel">add your comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="includes/add_comment.php" method="post">
                      <div class="mb-3">
                        <label for="name" class="form-label text-capitalize">your name</label>
                        <input type="text" class="form-control text-capitalize" name="name" id="name" aria-describedby="nameHelp" required>
                        <div id="nameHelp" class="form-text">Your name will be visible to others</div>
                      </div>
                      <div class="mb-3">
                        <label for="comment" class="form-label text-capitalize">your comment</label>
                        <input type="text" class="form-control" id="comment" name="comment" required>
                      </div>
                      <input type="hidden" name="post_id" value="<?=$post_id?>">
                      <div class="border-bottom my-4"></div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary text-capitalize" name="addcomment">add comment</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>






            <div class="addthis_inline_share_toolbox mt-3"></div>
          </div>
        </div>
        <div>
          <h4>Related Posts</h4>

          <?php
          $pquery="SELECT * FROM posts WHERE category_id={$post['category_id']} ORDER BY created_at DESC";
          $prun=mysqli_query($db,$pquery);
          while($rpost=mysqli_fetch_assoc($prun)){
            if($rpost['id']==$post_id){
              continue;
            }
            ?>
            <a href="post.php?id=<?=$rpost['id']?>" class="text-decoration-none text-dark">
              <div class="card mb-3" style="max-width: 700px;">
                <div class="row g-0">
                  <div class="col-md-5" style="background-image: url('https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg');background-size: cover">
                  </div>
                  <div class="col-md-7">
                    <div class="card-body">
                      <h5 class="card-title text-capitalize"><?=$rpost['title']?></h5>
                      <p class="card-text text-truncate"><?=$rpost['content']?></p>
                      <p class="card-text"><small class="text-muted"><?=date('h:i, D, d F Y', strtotime($rpost['created_at']));?></small></p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <?php
          }
          ?>
        </div>

      </div>

      <!-- SIDEBAR FROM INCLUDES -->
      <?php include_once("includes/sidebar.php"); ?>

    </div>

    <!-- FOOTER FROM INCLUDES -->
    <?php include_once("includes/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-623b19c0e7d5ad8c"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script type="text/javascript" src="includes/script.js"></script>

    
</body>

</html>