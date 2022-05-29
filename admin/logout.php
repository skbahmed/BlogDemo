<?php
session_start();
session_destroy();
header('location:../admin/pages-login.php');
?>