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

                    <h5 class="card-title">Admins</h5>
                    <!-- Table with stripped rows -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Admin Name</th>
                                <th scope="col">Admin Email</th>
                                <th scope="col">Admin Designation</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $allAdmins = getAllAdminInfo($db);
                            $count = 1;

                            foreach($allAdmins as $allAdmin){
                                ?>
                                <tr>
                                    <th scope="row"><?=$count?></th>
                                    <td class="text-capitalize"><?=$allAdmin['full_name']?></td>
                                    <td class="text-lowercase"><?=$allAdmin['email']?></td>
                                    <td class="text-capitalize"><?=$allAdmin['designation']?></td>
                                    <td>
                                        <a href="includes/manage_admin.php?removeAdmin=<?=$allAdmin['id']?>" class="btn btn-sm btn-danger" title="Remove Admin" name="removeAdmin">Remove <i class="bi bi-x-square"></i></a>
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
                        <i class="bi bi-plus-square"></i> add new admin
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize" id="staticBackdropLabel">add new admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="includes/manage_admin.php" method="post">
                                        <div class="mb-3">
                                            <label for="adminName" class="form-label text-capitalize mt-3">admin name</label>
                                            <input type="text" class="form-control text-capitalize" name="adminName" id="adminName" required>
                                            <label for="adminDesignation" class="col-12 col-form-label text-capitalize">designation</label>
                                            <select class="form-select text-capitalize form-control" aria-label="Default select example" name="adminDesignation" id="adminDesignation" required>
                                                <option selected disabled></option>
                                                <?php
                                                $designations = getAllAdminDesignation($db);
                                                foreach($designations as $designation){
                                                    ?>
                                                    <option value="<?=$designation['name']?>"><?=$designation['name']?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <label for="adminEmain" class="form-label text-capitalize mt-3">admin email</label>
                                            <input type="email" class="form-control text-lowercase" name="adminEmail" id="adminEmail" aria-describedby="emailHelp" required>
                                            <div id="emailHelp" class="form-text">This email will be used to login.</div>
                                            <label for="adminPass" class="form-label text-capitalize mt-3">admin password</label>
                                            <input type="password" class="form-control" name="adminPass" id="adminPass" aria-describedby="passHelp" required>
                                            <div id="passHelp" class="form-text">Please don't forget your password.</div>
                                        </div>
                                        <div class="border-bottom my-4"></div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary text-capitalize" name="addAdmin">add admin</button>
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