<div class="col-4">
    <!-- <div class="card mb-3">
        <h5 class="card-header">Featured</h5>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card mb-3">
        <h5 class="card-header">Featured</h5>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div> -->

    <?php
    if(isset($_GET['id'])){
        ?>
        <div class="card mb-3">
            <h5 class="card-header">Comments</h5>
            <?php
            $comments = getComments($db,$post_id);
            if(count($comments)<1){
                ?>
                <div class="card-body">
                    <p class="card-text text-center">no available comments</p>
                </div>
                <?php
            }
            foreach($comments as $comment){
                ?>
                <div class="card-body">
                    <h5 class="card-title text-capitalize"><?=$comment['name']?></h5>
                    <p class="card-text"><small class="text-muted"><?=date('h:i, D, d F Y', strtotime($comment['commented_at']));?></small></p>
                    <p class="card-text" style="text-align:justify"><?=$comment['comment']?></p>
                    <a href="#" class="btn btn-primary text-capitalize">reply</a>
                    <div class="border-bottom mt-3"></div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
</div>