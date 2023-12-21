<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
//destroy session
session_destroy();
header('Location: ../index.php');
?>