<div class="pagetitle">
    <?php
        $adminMenuQuery = "SELECT * FROM admin_menu";
        $runAdminMenu = mysqli_query($db, $adminMenuQuery);
        $adminMenu=mysqli_fetch_assoc($runAdminMenu);
        ?>
            <h1 class="text-capitalize"><?=$adminMenu['name']?></h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
</div>
<!-- End Page Title -->