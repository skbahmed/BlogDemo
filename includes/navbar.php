<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand text-capitalize" href="#">blog demo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll text-capitalize" style="--bs-scroll-height: 100px;">

                <?php
                $navQuery = "SELECT * FROM menu";
                $runNav =  mysqli_query($db,$navQuery);
                while($menu=mysqli_fetch_assoc($runNav)){
                    $no = getSubMenuNo($db,$menu['id']);
                    if(!$no){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?=$menu['action']?>"><?=$menu['name']?></a>
                        </li>
                        <?php
                    }else{
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?=$menu['action']?>" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?=$menu['name']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <?php
                                $subMenus = getSubMenu($db,$menu['id']);
                                foreach($subMenus as $subMenu){
                                    ?>
                                    <li><a class="dropdown-item" href="index.php?subMenu=<?=$subMenu['id']?>"><?=$subMenu['name']?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                }
                ?>

            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>