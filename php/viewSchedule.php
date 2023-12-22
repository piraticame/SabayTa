<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
require_once('Ascon.php');
require_once 'db.php';

$user = $_SESSION['username'];
$userId = "SELECT id FROM users WHERE username = '$user'";
$result = mysqli_query($conn, $userId);
$userId = mysqli_fetch_assoc($result);
$userId = $userId['id'];
 
$postId = $_POST['post_id'];
$sql = "SELECT * FROM post where id = '$postId'";
$result = mysqli_query($conn, $sql);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
//echo the $posts
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LINKS/CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Document</title>
    <link rel="stylesheet" href="../css/viewsched.css">
</head>
<body>
    <div class="wrapper">
        <div class="header-Container">
            <div class="container">
                <a href="#" class="toggleBox">
                    <img src="../Icons/burger.svg" alt="" class="img1 icon">
                </a>

                <ul class="navItems">
                    <li>
                        <a href="MainPage.php">
                            <i class="fa-solid fa-house" style="--i:1" ></i>
        
                        </a>
                    </li>

                    <li>
                        <a href="Schedule.php">
                            <i class="fa-solid fa-clipboard-list"></i>
                            
                        </a>
                    </li>

                    <li>
                        <a href="Profile.php">
                            <i class="fa-solid fa-user"></i>
                          
                        </a>
                    </li>

                    <li>
                        <a href="logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            
                        </a>
                    </li>
                </ul>
            </div>
            <div class="circleWhite" style="background-color: red">
            <form action="" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                <button name="deletedButton" type="submit" style="background-color: red;">Delete Schedule</button>
                </form>
            </div>
            <?php
            if (isset($_POST['deletedButton'])) {
                $postId = $_POST['post_id'];
                $sql = "UPDATE post SET status = 'Deleted' WHERE id = '$postId'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Done!',
                    text: 'Schedule deleted.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'Schedule.php';
                });
            </script>";
                } else {
                    echo "<script>alert('Schedule Not Deleted!');</script>";
                }
            }
            

            ?>
        </div>

        <?php foreach ($posts as $post): ?>
        <div class="mainContainer">
            <div class="topContainer">
                <div class="top-UserContainer">
                    <h3><?php echo $post['name']; ?></h3>
                    <p class="date" style="margin-left:3%; margin-top:3%" data-timestamp="<?php echo strtotime($post['createdAt']); ?>"></p>

                    <p class="vacant">Joined: <?php echo $post['joinedcount'] ?> out of 6</p>
                </div>
                <div class="top-LocationContainer">
                    <div class="meetTime">
                        <p class="meeting-time">
                            <?php echo $post['meetingTime']; ?>
                        </p>
                    </div>
                    <div class="meetLocation">
                        <div class="locTop">
                            <img src="../Icons/location.svg" alt="" width="15px">
                            <p>Meeting Location</p>
                        </div>
                        <p>
                            <?php echo $post['fromLocation']; ?>
                        </p>
                    </div>

                    <div class="meetLocation">
                        <div class="locTop">
                            <img src="../Icons/location.svg" alt="" width="15px">
                            <p>Destination</p>
                        </div>
                        <p>
                            <?php echo $post['toLocation']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="bottomContainer">
                <div class="pepConnect">
                    <img src="../Icons/radar.svg" alt="" width="25px">
                    <p>People who joined</p>
                </div>
                <?php
                $sql = "SELECT u.id, u.firstname, u.phone, u.profile 
                        FROM joined j
                        JOIN users u ON j.user_id = u.id
                        WHERE j.post_id = '$postId'";

                $result = mysqli_query($conn, $sql);
                $joined = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>

            <div class="userList">
                <?php foreach ($joined as $user): ?>
                    
                    <div class="userCard">
                        <?php
                        $profile = $user['profile'];
                        $decryptedProfile = Ascon::decryptFromHex($secretKey, $profile, "additionalData", "Ascon-128");

                        ?>
                        <img src="<?php echo $decryptedProfile; ?>" alt="" width="100.5px" height="80px" style="object-fit: cover;">
                        <h3><?php 
                        $name = $user['firstname'];
                        $decryptedName = Ascon::decryptFromHex($secretKey, $name, "additionalData", "Ascon-128");
                        
                        echo $decryptedName; ?></h3>
                        <p>Phone: <?php
                        //decryptFromHex
                        $phone = $user['phone'];
                        $decryptedPhone = Ascon::decryptFromHex($secretKey, $phone, "additionalData", "Ascon-128");

                         echo $decryptedPhone; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

                </div>       

            </div>
        </div>
        
        <?php endforeach; ?>
    </div>

    <script>
        var toggleClick = document.querySelector(".toggleBox");
        var container = document.querySelector(".container");
        toggleClick.addEventListener('click', ()=>{
            toggleClick.classList.toggle('active');
            container.classList.toggle('active');
        });
    </script>
    <!-- Add this script to your HTML file -->
<script>
    // Function to format timestamp to worded format of the month
    function formatTimestampToMonthWord(timestamp) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const date = new Date(timestamp * 1000); // Convert seconds to milliseconds
        return new Intl.DateTimeFormat('en-US', options).format(date);
    }

    // Usage example
    document.addEventListener("DOMContentLoaded", function() {
        const dateElements = document.querySelectorAll('.date');
        dateElements.forEach(function(element) {
            const timestamp = element.getAttribute('data-timestamp');
            const formattedDate = formatTimestampToMonthWord(timestamp);
            element.textContent = formattedDate;
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Function to handle the "Delete Schedule" button click
        document.querySelector('[name="deletedButton"]').addEventListener('click', function () {
            // Assuming you have a confirmation before deleting
            if (confirm("Are you sure you want to delete this schedule?")) {
                // Get the post ID from the data attribute
                var postId = <?php echo json_encode($postId); ?>;

                // Use AJAX to communicate with the server
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            // Handle the response from the server
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                // Redirect or update the UI as needed
                                window.location.href = 'Schedule.php';
                            } else {
                                alert('Failed to delete schedule. Please try again.');
                            }
                        } else {
                            alert('Failed to delete schedule. Please try again.');
                        }
                    }
                };

                // Send an AJAX request to delete the schedule
                xhr.open('POST', 'delete_schedule.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('post_id=' + postId);
            }
        });
    });
</script>

</body>
</html>

<script>
        // Function to convert 24-hour time format to 12-hour format
        function convertTo12HourFormat(timeString) {
            // Create a new Date object and set the time
            var date = new Date('2000-01-01T' + timeString);
            
            // Format the time to 12-hour format
            var formattedTime = date.toLocaleTimeString('en-US', {hour: 'numeric', minute: 'numeric', hour12: true});

            return formattedTime;
        }

        // Iterate over the posts and update the meeting time display
        var meetingTimeElements = document.querySelectorAll('.meeting-time');
        meetingTimeElements.forEach(function(element) {
            var originalTime = element.textContent.trim();
            var formattedTime = convertTo12HourFormat(originalTime);
            element.textContent = 'Meeting Time: ' + formattedTime;
        });
    </script>
