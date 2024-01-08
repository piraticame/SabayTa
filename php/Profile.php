<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
require_once('Ascon.php');
require_once 'db.php';

$user = $_SESSION['username'];
$users = "SELECT * FROM users WHERE username = '$user'";
$result = mysqli_query($conn, $users);
$users = mysqli_fetch_assoc($result);
$row = mysqli_num_rows($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updates = array();

    if (!empty($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
        $encryptedFirstname = Ascon::encryptToHex($secretKey, $firstname, "additionalData", "Ascon-128");
        $updates[] = "firstname = '" . mysqli_real_escape_string($conn, $encryptedFirstname) . "'";
    }
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
        $_SESSION['username'] = $username;
        $updates[] = "username = '" . mysqli_real_escape_string($conn, $username) . "'";
    }

    if (!empty($_POST['middlename'])) {
        $encryptedMiddlename = Ascon::encryptToHex($secretKey, $_POST['middlename'], "additionalData", "Ascon-128");
        $updates[] = "middlename = '" . mysqli_real_escape_string($conn, $encryptedMiddlename) . "'";
    }

    if (!empty($_POST['lastname'])) {
        $encryptedLastname = Ascon::encryptToHex($secretKey, $_POST['lastname'], "additionalData", "Ascon-128");
        $updates[] = "lastname = '" . mysqli_real_escape_string($conn, $encryptedLastname) . "'";
    }

    if (!empty($_POST['gender'])) {
        $encryptedGender = Ascon::encryptToHex($secretKey, $_POST['gender'], "additionalData", "Ascon-128");
        $updates[] = "gender = '" . mysqli_real_escape_string($conn, $encryptedGender) . "'";
    }

    if (!empty($_POST['phone'])) {
        $encryptedPhone = Ascon::encryptToHex($secretKey, $_POST['phone'], "additionalData", "Ascon-128");
        $updates[] = "phone = '" . mysqli_real_escape_string($conn, $encryptedPhone) . "'";
    }
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $encryptedPassword = Ascon::encryptToHex($secretKey, $password, "additionalData", "Ascon-128");
        $updates[] = "password = '" . mysqli_real_escape_string($conn, $encryptedPassword) . "'";
    }

    if (!empty($updates)) {
        $updateSql = "UPDATE users SET " . implode(', ', $updates) . " WHERE username = '$user'";
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            echo "<p style='color: white;'>.<p>";
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Saved!',
                    text: 'Your profile has been updated.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'Profile.php';
                });
            </script>";
        } else {
            echo "<p style='color: white;'>.<p>";
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'Profile.php';
                });
            </script>";
        }
    }else{
        
        echo "<p style='color: white;'>.<p>";
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong! Please try again.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'Profile.php';
            });
        </script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Document</title>
    <link rel="stylesheet" href="../css/profile.css">
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
            <div class="circleWhite">
                <p>Profile</p>
            </div>
        </div>

        <div class="mainContainer">
            <form action="" method="POST">
                <div class="Userprofile-container">
                    <div class="backgroundProfile">
                        <img src="<?php
                        $userprofile = $users['profile'];
                        $decryptedProfile = Ascon::decryptFromHex($secretKey, $userprofile, "additionalData", "Ascon-128");
                        echo $decryptedProfile;
                        ?>"  alt="" class="userprofile">
                     
                    </div>
                    <h2 style="text-align:center;">
                        <?php
                        $fname = $users['firstname'];
                        $mname = $users['middlename'];
                        $lname = $users['lastname'];
                        $phone = $users['phone'];
                        $username = $users['username'];
                        $password = $users['password'];
                        $gender = $users['gender'];
                        $defname = $fname;
                        $demname = $mname;
                        $delname = $lname;
                        $dephone = $phone;
                        $depassword = $password;
                        $decryptedGender = Ascon::decryptFromHex($secretKey, $gender, "additionalData", "Ascon-128");

                        $decryptedFname = Ascon::decryptFromHex($secretKey, $defname, "additionalData", "Ascon-128");
                        $decryptedMname = Ascon::decryptFromHex($secretKey, $demname, "additionalData", "Ascon-128");
                        $decryptedLname = Ascon::decryptFromHex($secretKey, $delname, "additionalData", "Ascon-128");
                        $decryptedPhone = Ascon::decryptFromHex($secretKey, $dephone, "additionalData", "Ascon-128");
                        $decryptedPass = Ascon::decryptFromHex($secretKey, $depassword, "additionalData", "Ascon-128");
                        
                        echo $decryptedFname . " " . $decryptedMname . " " . $decryptedLname;
                        ?>
                    </h2>
                </div>
                <div class="userInfo-container">
                    <div class="topInfo">
                        <div style="margin-top: 10px; display: flex;">
                            <div class="fname">
                                <p>First Name</p>
                                <input type="text" name="firstname" id="firstname" value="<?php echo $decryptedFname; ?>">
                            </div>
                            <div class="lname">
                                <p>Middle Name</p>
                                <input type="text" name="middlename" id="middlename" value="<?php echo $decryptedMname; ?>">
                            </div>
                        </div>
                        <div style="margin-top: 10px; display: flex;">
                            <div class="fname">
                                <p>Last Name</p>
                                <input type="text" name="lastname" id="lastname" value="<?php echo $decryptedLname; ?>">
                            </div>
                            <div class="gender">
                                <p>Gender</p>
                                <select name="gender" id="gender">
                                <option value="Male" <?php echo ($decryptedGender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($decryptedGender == 'Female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                            </div>
                        </div>
                        <div style="margin-top: 10px; display: flex;">
                            <div class="fname">
                                <p>Phone Number</p>
                                <input type="text" name="phone" id="phone" value="<?php echo $decryptedPhone; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lastInfo">
                    <div class="lastHeader">
                        <p>Personal Credentials</p>
                        <button type="submit" name="submit">Edit Credentials</button>
                    </div>
                    <div class="username">
                        <p>Username</p>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="password">
                        <p>Password</p>
                        <input type="password" name="password" id="password" value="<?php $depassword ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>

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
