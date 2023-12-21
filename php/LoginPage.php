<?php
session_start();
require_once('db.php');
include('Ascon.php');

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
    <link rel="stylesheet" href="../css/homepage.css">
</head>
<body>
    <div class="wrapper">
        <div class="headerContent">
            <a href="HomePage.php"><img src="../Icons/arrowLeft.svg" alt=""></a>
        </div>
        <form action="" method="POST">
        <div class="loginFormDetails">
            <h1>Let's Sign you in.</h1>
            <h6 class="welcomeText">Welcome Back!</h6>
            <h6>MEGO You've been missed!</h6>
        </div>
        <div class="loginFormContainer">
            <div class="usernameLog">
                <p>Username</p>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="passwordLog">
                <p>Password</p>
                <input type="password" name="password" id="password" required>
                <p class="forgotPass">Forgot Password</p>
            </div>

            <div class="erroMessage" hidden>
                <p>Wrong username/password</p>
            </div>
        </div>

        <div class="footer">
            <p>Doesn’t have account? <span style="color: white;"><a href="FirstRegister.php">Create Account</a></span></p>
            <button type="submit" name="submit">Login</button>
        </div>
        </form>
    </div>
</body>
</html>
<?php 

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the encrypted password from the database based on the username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Check if the username is found
        if ($row = mysqli_fetch_assoc($result)) {
            // Get the encrypted password from the database 
            $storedPassword = $row['password'];

            // Decrypt the stored password
            $decryptedPassword = Ascon::decryptFromHex($secretKey, $storedPassword, "additionalData", "Ascon-128");

            if (!is_null($decryptedPassword) && $decryptedPassword == $password) {
                // Passwords match, set session and redirect
                $_SESSION['username'] = $username;
                header('Location: MainPage.php');
            } else {
                echo "<script>alert('Incorrect password.');</script>";
            }
        } else {
            echo "<script>alert('Username not found.');</script>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}




?>