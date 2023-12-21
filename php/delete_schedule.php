<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

require_once 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'];

    // Perform the deletion logic here
    $deleteSql = "DELETE FROM post WHERE id = '$postId'";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        //alert with js
        echo "<script>alert('Schedule Deleted!');</script>";

        echo json_encode(['success' => true]);
    } else {
        // Provide an error response
         echo "<script>alert('Schedule Not Deleted!');</script>";
        echo json_encode(['success' => false]);
    }
}
?>
