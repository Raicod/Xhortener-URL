<?php
    session_destroy();
    $_SESSION['is_Login'] = false;
    header('Location:index.php');
?>