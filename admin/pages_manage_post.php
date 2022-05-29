<?php include_once("includes/head.php")?>

<body>

    <!-- ======= Header ======= -->
    <?php include_once("includes/navbar.php")?>

    <!-- ======= Sidebar ======= -->
    <?php include_once("includes/sidebar.php")?>

    <main id="main" class="main">

        <?php include_once("includes/breadcrumbs.php")?>

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-lg-8 bg-light">
                            <div class="card-body">
                                <?php include_once("includes/alerts.php")?>

                                <h5 class="card-title text-capitalize border-bottom text-center">add new post</h5>

                                <form action="../includes/add_post.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <label for="postTitle" class="col-12 col-form-label text-capitalize">title</label>
                                            <input type="text" class="col-12 form-control mb-4 text-capitalize" id="postTitle" name="postTitle" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label class="col-12 col-form-label text-capitalize">add image</label>
                                            <input type="file" class="col-12 form-control mb-4 text-capitalize" name="postImage[]" accept="image/*" multiple>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="postCategory" class="col-12 col-form-label text-capitalize">category</label>
                                            <select class="form-select text-capitalize form-control" aria-label="Default select example" id="postCategory" name="postCategory" required>
                                                <option selected disabled></option>
                                                <?php
                                                $categories = getAllCategory($db);
                                                foreach($categories as $ct){
                                                    ?>
                                                    <option value="<?=$ct['id']?>"><?=$ct['name']?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="postContent" class="col-12 col-form-label text-capitalize">Content</label>
                                            <textarea class="form-control" rows="10" id="postContent" name="postContent" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <input type="submit" class="btn btn-primary text-capitalize px-5 py-2 mt-5" name="addPost" value="add post">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize border-bottom text-center">preview</h5>
                                <!-- POST HEADER -->
                                <h3 class="card-title text-capitalize">"Post Title"</h3>
                                <span class="badge bg-primary ">Posted on "time"</span>
                                <span class="badge bg-danger text-capitalize">"post category"</span>
                                <div class="border-bottom mt-3"></div>
                                <!-- POST IMAGE SLIDER-->
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="assets/img/slides-1.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/slides-2.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/slides-3.jpg" class="d-block w-100" alt="...">
                                        </div>
                                    </div>
    
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <!-- POST CONTENT -->
                                <p class="card-text my-3" style="text-align:justify">"post content : Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae neque dolorem reiciendis ullam, nulla ex possimus ut assumenda provident veniam cum, impedit nostrum quo suscipit libero commodi ab accusantium consequatur explicabo fugiat. Maiores quibusdam eum fuga ad. Sint error a numquam beatae reprehenderit, nisi exercitationem ducimus corporis dolorem odio incidunt!"</p>
    
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include_once("includes/footer.php")?>
    <!-- End Footer -->

    <!-- ======= FOOT ======= -->
    <?php include_once("includes/foot.php")?>
    <!-- End FOOT -->

</body>

</html>