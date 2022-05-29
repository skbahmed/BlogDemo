<?php
if(isset($_SESSION['message'])){
    ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible fade show mt-4 mb-0 text-capitalize" role="alert">
        <i class="bi <?=$_SESSION['msg_icon']?> me-1"></i>
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}
?>