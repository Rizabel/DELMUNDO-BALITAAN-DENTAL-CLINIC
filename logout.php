<?php
    session_destroy();
    unset($_SESSION['username']);
    header('Location: admin/login.php');
?>