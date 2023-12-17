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
                <p>Profile</p>
            </div>
        </div>

        <div class="mainContainer">
           <div class="Userprofile-container">
                <div class="backgroundProfile">
                    <img src="../Icons/cutemikey.svg" alt="" class="userprofile">
                    <img src="../Icons/editblack.svg" alt="" width="30px" class="edit">
                </div>
                <h2>Michael C. Labastida</h2>
           </div>
           <div class="userInfo-container">
                <div class="topInfo">
                   <div style="margin-top: 10px; display: flex;">
                        <div class="fname">
                            <p>First Name</p>
                            <input type="text" name="" id="">
                        </div>

                        <div class="lname">
                            <p>Middle Name</p>
                            <input type="text" name="" id="">
                        </div>
                   </div>

                   <div style="margin-top: 10px; display: flex;">
                        <div class="fname">
                            <p>Last Name</p>
                            <input type="text" name="" id="">
                        </div>

                        <div class="gender">
                            <p>Gender</p>
                            <select name="" id="">
                                <option value="Male">Male</option>
                                <option value="Male">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-top: 10px; display: flex;">
                        <div class="fname">
                            <p>Phone Number</p>
                            <input type="text" name="" id="">
                        </div>
                    </div>
                </div>
           </div>

            <div class="lastInfo">
                <div class="lastHeader">
                    <p>Personal Credentials</p>
                    <button>Edit Credentials</button>
                </div>

                <div class="username">
                    <p>Username</p>
                    <input type="text">
                </div>

                <div class="password">
                    <p>Password</p>
                    <input type="text">
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

