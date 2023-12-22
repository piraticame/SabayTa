<!-- Include SweetAlert script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>

</body>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

require_once('Ascon.php');
require_once 'db.php';

$user = $_SESSION['username'];

// Check if the form is submitted
if (isset($_POST['view'])) {
    $getid = "SELECT id FROM users WHERE username = '$user'";
    $result = mysqli_query($conn, $getid);
    $userid = mysqli_fetch_assoc($result);
    $userid = $userid['id'];

    $postId = $_POST['post_id'];

    // Check if the user is already in the joined table
    $checkSql = "SELECT * FROM joined WHERE user_id = '$userid' AND post_id = '$postId'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // User is already in the joined table
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'You are already in this schedule.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'MainPage.php';
                    });
                </script>";
        exit;
    } else {
        // Check if joined_count is full
        $postCountSql = "SELECT joinedcount FROM post WHERE id = '$postId'";
        $postCountResult = mysqli_query($conn, $postCountSql);
        $postCount = mysqli_fetch_assoc($postCountResult)['joinedcount'];

        $joinedUsersSql = "SELECT COUNT(*) AS joined_users FROM joined WHERE post_id = '$postId'";
        $joinedUsersResult = mysqli_query($conn, $joinedUsersSql);
        $joinedUsers = mysqli_fetch_assoc($joinedUsersResult)['joined_users'];

        if ($joinedUsers >= 6) {
            echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'The schedule is full. You cannot join.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'MainPage.php';
                        });
                    </script>";
            exit;
        }

        
        $sql = "INSERT INTO joined (user_id, post_id) VALUES ('$userid', '$postId')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Wow!',
                            text: 'You joined this schedule! Please come in the time scheduled.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'Schedule.php';
                        });
                    </script>";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}else{
    echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'You cannot access this page.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'MainPage.php';
                });
            </script>";
    exit;
}
?>
