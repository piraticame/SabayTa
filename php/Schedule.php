<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
require_once 'ascon.php';
require_once 'db.php';
$username = $_SESSION['username'];
$idSql = "SELECT id FROM users WHERE username = '$username'";
$result = $conn->query($idSql);

if ($result) {
    $row = $result->fetch_assoc();
    $userId = $row['id'];

    // Get posts that the user has joined
    $sqlJoined = "SELECT p.* FROM joined j
                  JOIN post p ON j.post_id = p.id
                  WHERE j.user_id = '$userId' AND p.status !='Deleted' ORDER BY p.createdAt DESC";
    $resultJoined = $conn->query($sqlJoined);

    // Check for query success for joined posts
    if ($resultJoined) {
        $postsJoined = $resultJoined->fetch_all(MYSQLI_ASSOC);

        // Use $postsJoined as needed
    } else {
        // Handle the error
        echo "Error fetching joined posts: " . $conn->error;
        $postsJoined = array(); // Provide an empty array to prevent issues later
    }
} else {
    // Handle the error
    echo "Error fetching user ID: " . $conn->error;
    $postsJoined = array(); // Provide an empty array to prevent issues later
}
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
    <link rel="stylesheet" href="../css/sched.css">
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
                        <a href="Mainpage.php">
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
            <div class="circleWhite">
                <!-- Ward naa diri ang functions na if ma click ang search mo pop up ang input-->
                <i class="fa-solid fa-plus"></i>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal">Create Schedule</button>
            </div>
        </div>

        <div class="mainContainer">
        <?php foreach ($postsJoined as $post): ?>
                <div class="card">
                    <!-- Your card content goes here, replace the static content with dynamic data -->
                    <div class="topCardContainer">
                        <div class="top-leftContainer">
                        <h6><?php echo $post['name']; ?></h6>
                <div class="status">
                    <p class="waiting"><?php echo $post['status']; ?></p>
                    <p class="meeting-time"><?php echo $post['meetingTime']; ?></p>
                </div>
            </div>  
            <form action="viewschedule.php" method="POST">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <div class="top-RighttContainer"> 
                    <button type="submit" name="view">View Schedule</button>
                </div>
            </form>
                    </div>
                    <div class="bottomCardContainer">
                        <div class="bottom-leftContainer">
                            <!-- Destination details, you can replace this with dynamic data -->
                            <div class="destinationChart">
                                <img src="../Icons/Destination.svg" alt="">
                                <div class="line"></div>
                                <img src="../Icons/Destination1.svg" alt="">
                            </div>
                            <div class="destinationDetails">
                                <!-- Meeting place details, replace with dynamic data -->
                                <div class="meetinPlace">
                                    <div class="cardMeeting">
                                        <img src="../Icons/location.svg" alt="" width="8px">
                                        <p>Meeting Location</p>
                                    </div>
                                    <p><?php echo $post['fromLocation']; ?></p>
                                </div>
                                <!-- Destination details, replace with dynamic data -->
                                <div class="meetinPlace">
                                    <div class="cardMeeting">
                                        <img src="../Icons/location.svg" alt="" width="10px">
                                        <p>Destination</p>
                                    </div>
                                    <p><?php echo $post['toLocation']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        $postId = $post['id'];
                        $sqlJoined = "SELECT COUNT(*) AS joinedcount FROM joined WHERE post_id = '$postId'";
                        $result = $conn->query($sqlJoined);
                        $row = $result->fetch_assoc();
                        $count = $row['joinedcount'];

                        ?>
                        <div class="bottom-RighttContainer"> 
                            <div class="VacantContainer">
                                <p class="vacant">Vacant</p>
                                <p><?php echo $count; ?>/6</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            
        </div>
        
    </div>




    <!-- Modal -->
    <form action="" method="POST">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="scheduleContainer">
                        <p>Schedule Name</p>
                        <div class="inputSched">
                            <div><img src="../Icons/book.svg" alt="" width="20px"></div>
                            <input type="text" name="name" id="name" placeholder="Enter Schedule Name" required>
                        </div>
                    </div>

                    <div class="scheduleContainer">
                        <p>Meeting Location</p>
                        <div class="inputSched">
                            <div><img src="../Icons/map.svg" alt="" width="20px"></div>
                            <input type="text" name="fromLocation" id="fromLocation" placeholder="Enter Schedule Name" required>
                        </div>
                    </div>

                    <div class="scheduleContainer">
                        <p>Set Destination</p>
                        <div class="inputSched">
                            <div><img src="../Icons/arrowLoc.svg" alt="" width="20px"></div>
                            <input type="text" name="toLocation" id="toLocation" placeholder="Enter Schedule Name" required>
                        </div>
                    </div>
                    <div class="scheduleContainer">
                        <p>Set Time</p>
                        <div class="inputSched">
                            <div><img src="../Icons/clock-10-512.gif" alt="" width="20px"></div>
                            <input type="time" name="time" id="time" placeholder="Enter Schedule Name" required>
                        </div>
                    </div>


                    <div class="modalBtn">
                        <button class="cancel"  data-bs-dismiss="modal">Cancel</button>
                        <button class="create" name="submit" type="submit">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    <script>
        var toggleClick = document.querySelector(".toggleBox");
        var container = document.querySelector(".container");
        toggleClick.addEventListener('click', ()=>{
            toggleClick.classList.toggle('active');
            container.classList.toggle('active');
        });
    </script>
</body>
</html>

<?php
// Logic for creating a post
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $fromLocation = $_POST['fromLocation'];
    $toLocation = $_POST['toLocation'];
    $time = $_POST['time'];
    $status = "Waiting";
    $joinedcount = 1;
    $username = $_SESSION['username'];
    
    $idSql = "SELECT id FROM users WHERE username = '$username'";
    if ($result = $conn->query($idSql)){
        $row = $result->fetch_assoc();
        $userId = $row['id'];
        $sqlPost = "INSERT INTO post (user_id, name, meetingTime, fromLocation, toLocation, joinedcount, status)
                VALUES ('$userId', '$name', '$time', '$fromLocation', '$toLocation', '$joinedcount', '$status')";
       

    if ($conn->query($sqlPost) === TRUE) {
        // Step 2: Fetch the ID of the newly inserted post
        $postId = $conn->insert_id;

        // Step 3: Insert into the joined table
        $sqlJoined = "INSERT INTO joined (user_id, post_id) VALUES ('$userId', '$postId')";
        if ($conn->query($sqlJoined) === TRUE) {
            // Success
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Post created!',
                    text: 'Your post has been created.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'Schedule.php';
                });
            </script>";
        } else {
            echo "Error inserting into joined table: " . $conn->error;
        }
    } else {
        echo "Error inserting into post table: " . $conn->error;
    }
    };


    
}else{
}


?>
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