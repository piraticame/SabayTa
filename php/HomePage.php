<?php
require_once('db.php');
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
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="mainContent-container"> 
            <div class="header-Container">
                <img src="../Icons/useplogo.png" alt="">
                <div class="circleWhite">
                    <p>?</p>
                </div>
            </div>
            <img src="../Icons/logoWave.svg" alt="" class="img1" width="375px">

            <div class="mainInfo">
                <img src="../Icons/logo.svg" alt="" class="img2" width="320px">
                <a href="LoginPage.php"><button>Login</button></a>
                <p>Doesn’t have account? <span style="color: white;"><a href="FirstRegister.php">Create Account</a></span></p>
            </div>


            <img src="../Icons/logoWave2.svg" alt="" class="img3" width="375px">
    </div>

</body>
</html>