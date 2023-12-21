<?php
session_start();
require_once 'db.php';
include 'Ascon.php';
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
    <link rel="stylesheet" href="../css/mainpage.css">
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
                        <a href="">
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
                        <a href="">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            
                        </a>
                    </li>
                </ul>
            </div>
            <div class="circleWhite">
                <!-- Ward naa diri ang functions na if ma click ang search mo pop up ang input-->
                <input type="text" style="display: none;">
                <img src="../Icons/search.svg" alt="">
            </div>
        </div>

        <div class="mainContainer">
            <div class="card">
                <div class="topCardContainer">
                    <div class="top-leftContainer">
                        <h6>Michael C. Labastida</h6>
                            <div class="status">
                                <p class="waitining">Waiting</p>
                                <p>Meeting Time: 8:30 PM</p>
                            </div>
                    </div>  
                    <div class="top-RighttContainer"> 
                        <button>Sabay Ko</button>
                    </div>
                </div>
                <div class="bottomCardContainer">
                    <div class="bottom-leftContainer">
                        <div class="destinationChart">
                            <img src="../Icons/Destination.svg" alt="">
                            <div class="line"></div>
                            <img src="../Icons/Destination1.svg" alt="">
                        </div>
                        <div class="destinationDetails">
                            <div class="meetinPlace">
                                <div class="cardMeeting">
                                    <img src="../Icons/location.svg" alt="" width="8px">
                                    <p>Meeting Location</p>
                                </div>
                                <p>University of Southeastern Philippines
                                    sa may bakeryhan.
                                </p>
                            </div>
                            <div class="meetinPlace">
                                <div class="cardMeeting">
                                    <img src="../Icons/location.svg" alt="" width="10px">
                                    <p>Destination</p>
                                </div>
                                <p>New Historical Park , sa may jolibee
                                    mo hunong.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-RighttContainer"> 
                        <div class="VacantContainer">
                            <p class="vacant">Vavant</p>
                            <p>5/6</p>
                        </div>
                    </div>
                </div>
            </div>


            
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

<?php



?>