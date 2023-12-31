<?php 

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['username'])){
}else{
    header('Location: FirstRegister.php');
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
    <link rel="stylesheet" href="../css/regsiterFirst.css">
</head>
<body>
    <div class="wrapper">
        <div class="headerContent">
            <a href="HomePage.html"><img src="../Icons/arrowLeft.svg" alt=""></a>
        </div>
        <form action="" method="POST">
        <div class="loginFormDetails">
            <h1>Create New Account.</h1>
            <h6 class="welcomeText">Hallo!</h6>
            <h6>MEGO I'm glad your here!<h6>
        </div>
        <div class="RegisterFormContainer">
            <div class="fNameReg">
                <p>First Name</p>
                <input type="text" name="firstname" id="firstname">
            </div>

            <div class="mNameReg">
                <p>Middle Name</p>
                <input type="text" name="middlename" id="middlename">
            </div>

            <div class="lNameReg">
                <p>Last Name</p>
                <input type="text" name="lastname" id="lastname">
            </div>

            <div class="GenderPhoneContainer">
                <div class="phoneNumber">
                    <p>Phone Number</p>
                    <input type="text" name="phone" id="phone">
                </div>

                <div class="gender">
                    <p>Gender</p>
                    <select name="gender" id="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="footer">
            <button type="submit">Continue</button>
        </div>
        </form>
    </div>
</body>
</html>
<?php
require_once('db.php');
require_once('Ascon.php');
// Assuming your table has columns: username, password, firstname, middlename, lastname, phone, gender

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['phone']) && isset($_POST['gender'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    // Decrypt the session username
    $user = $_SESSION['username'];

    // Encrypt other user details
    $encryptedFirstname = Ascon::encryptToHex($secretKey, $firstname, "additionalData", "Ascon-128");
    $encryptedMiddlename = Ascon::encryptToHex($secretKey, $middlename, "additionalData", "Ascon-128");
    $encryptedLastname = Ascon::encryptToHex($secretKey, $lastname, "additionalData", "Ascon-128");
    $encryptedPhone = Ascon::encryptToHex($secretKey, $phone, "additionalData", "Ascon-128");
    $encryptedGender = Ascon::encryptToHex($secretKey, $gender, "additionalData", "Ascon-128");

    // Update user details based on the decrypted session username
    $sql = "UPDATE users 
            SET firstname='$encryptedFirstname', middlename='$encryptedMiddlename', lastname='$encryptedLastname', phone='$encryptedPhone', gender='$encryptedGender'
            WHERE username = '$user'";

if ($conn->query($sql) === TRUE) {
    // Display SweetAlert notification
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Registration Successful!',
        text: 'Your profile details has been added.',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'LoginPage.php';
    });
  </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}


?>