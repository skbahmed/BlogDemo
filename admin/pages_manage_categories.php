<?php include_once("includes/head.php")?>

<body>

    <!-- ======= Header ======= -->
    <?php include_once("includes/navbar.php")?>

    <!-- ======= Sidebar ======= -->
    <?php include_once("includes/sidebar.php")?>

    <main id="main" class="main">

        <?php include_once("includes/breadcrumbs.php")?>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <?php include_once("includes/alerts.php")?>

                    <h5 class="card-title">Categories</h5>
                    <!-- Table with stripped rows -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $allCategories = getAllCategory($db);
                            $count = 1;

                            foreach($allCategories as $allCategory){
                                ?>
                                <tr>
                                    <th scope="row"><?=$count?></th>
                                    <td class="text-capitalize"><?=$allCategory['name']?></td>
                                    <td>

                                        <!-- Button trigger modal -->
                                        <a href="?id=<?=$allCategory['id']?>" class="btn btn-sm btn-warning text-capitalize" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-capitalize" id="staticBackdropLabel">change category name</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../includes/manage_category.php?editCategory=<?=$allCategory['id']?>" method="post">
                                                            <div class="mb-3">
                                                                <label for="categoryName" class="form-label text-capitalize">category name</label>
                                                                <input type="text" class="form-control text-capitalize" name="categoryName" id="categoryName" value="<?=getCategory($db, $allCategory['id'])?>" required>

                                                                <input type="text" name="categoryId" value="<?=$allCategory['id']?>">
                                                                
                                                            </div>
                                                            <div class="border-bottom my-4"></div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary text-capitalize" name="changeCategory">save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="../includes/manage_category.php?removeCategory=<?=$allCategory['id']?>" class="btn btn-sm btn-danger" title="Remove Category" name="removeCategory">Remove <i class="bi bi-x-square"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary text-capitalize" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                        <i class="bi bi-plus-square"></i> add new category
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize" id="staticBackdropLabel">add new category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../includes/manage_category.php" method="post">
                                        <div class="mb-3">
                                            <label for="categoryName" class="form-label text-capitalize">category name</label>
                                            <input type="text" class="form-control text-capitalize" name="categoryName" id="categoryName" required>
                                        </div>
                                        <div class="border-bottom my-4"></div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary text-capitalize" name="addCategory">add category</button>
                                        </div>
                                    </form>
                                </div>
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