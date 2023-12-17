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
                        <a href="">
                            <i class="fa-solid fa-house" style="--i:1" ></i>
        
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <i class="fa-solid fa-clipboard-list"></i>
                            
                        </a>
                    </li>

                    <li>
                        <a href="">
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
                <img src="../Icons/edit.svg" alt="" width="13px">
                <button>Edit Schedule</button>
            </div>
        </div>

        <div class="mainContainer">
            <div class="topContainer">
                <div class="top-UserContainer">
                    <h3>Michael C. Labastida</h3>
                    <p class="date">Date: January 23, 2003</p>
                    <p class="vacant">Available Vacant: 5 out of 6</p>
                </div>
                <div class="top-LocationContainer">
                    <div class="meetTime">
                        <p>Meeting Time: 8:30 PM</p>
                    </div>
                    <div class="meetLocation">
                        <div class="locTop">
                            <img src="../Icons/location.svg" alt="" width="15px">
                            <p>Meeting Location</p>
                        </div>
                        <p>University of Southeastern Philippines sa may bakeryhan.</p>
                    </div>

                    <div class="meetLocation">
                        <div class="locTop">
                            <img src="../Icons/location.svg" alt="" width="15px">
                            <p>Destination</p>
                        </div>
                        <p>New Historical Park , sa may jolibee mo hunong.</p>
                    </div>
                </div>
            </div>
            <div class="bottomContainer">
                <div class="pepConnect">
                    <img src="../Icons/radar.svg" alt="" width="25px">
                    <p>People who connect</p>
                </div>
                <div class="userList">
                    <div class="userCard">
                        <img src="../Icons/cutemikey.svg" alt="" width="100.5px" height="80px" style="object-fit: cover;">
                        <h3>Michael C. Labastida</h3>
                        <p>Contact Number: 09302241553</p>
                    </div>
                    
                    <div class="userCard">
                        <img src="../Icons/cutemikey.svg" alt="" width="100.5px" height="80px" style="object-fit: cover;">
                        <h3>Michael C. Labastida</h3>
                        <p>Contact Number: 09302241553</p>
                    </div> 

                    <div class="userCard">
                        <img src="../Icons/cutemikey.svg" alt="" width="100.5px" height="80px" style="object-fit: cover;">
                        <h3>Michael C. Labastida</h3>
                        <p>Contact Number: 09302241553</p>
                    </div> 

                    <div class="userCard">
                        <img src="../Icons/cutemikey.svg" alt="" width="100.5px" height="80px" style="object-fit: cover;">
                        <h3>Michael C. Labastida</h3>
                        <p>Contact Number: 09302241553</p>
                    </div> 

                    <div class="userCard">
                        <img src="../Icons/cutemikey.svg" alt="" width="100.5px" height="80px" style="object-fit: cover;">
                        <h3>Michael C. Labastida</h3>
                        <p>Contact Number: 09302241553</p>
                    </div> 
                    <div class="userCard">
                        <img src="../Icons/cutemikey.svg" alt="" width="100.5px" height="80px" style="object-fit: cover;">
                        <h3>Michael C. Labastida</h3>
                        <p>Contact Number: 09302241553</p>
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