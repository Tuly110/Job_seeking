<?php
    session_start();
    include "../Mentor/forms/connect.php";
    unset($_SESSION['user']);
    unset($_SESSION['user_admin']);
    header ("location: index.php");
?>