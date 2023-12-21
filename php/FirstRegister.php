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
    <link rel="stylesheet" href="../css/finalReg.css">
</head>
<body>
    <div class="wrapper">
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="headerContent">
            <a href="HomePage.php"><img src="../Icons/arrowLeft.svg" alt=""></a>
        </div>
        <!-- Your existing HTML code remains unchanged -->
<div class="loginFormDetails">
    <img id="previewImage" src="../Icons/male-user-icon-white.png" alt="">
    <input type="file" id="uploadBtn" accept="image/*" style="display: none;" name="profile" required>
    <i class="fa-solid fa-plus"></i>
    <label for="uploadBtn">Choose File</label>
</div>

<script>
    // Function to handle file input change
    document.getElementById('uploadBtn').addEventListener('change', function (event) {
        var previewImage = document.getElementById('previewImage');

        // Check if a file is selected
        if (event.target.files.length > 0) {
            var selectedFile = event.target.files[0];

            // Validate that the selected file is an image
            if (selectedFile.type.startsWith('image/')) {
                // Read the selected file and update the image preview
                var reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(selectedFile);
            } else {
                // Reset the file input if the selected file is not an image
                event.target.value = '';
                alert('Please choose a valid image file.');
            }
        }
    });
</script>

        <div class="RegisterFormContainer">
            <div class="fNameReg">
                <p>Username</p>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="mNameReg">
                <p>Password</p>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="termsCondition">
                <input type="checkbox" name="" id="" required>
                <p>I agree to the <span style="color: #23ad96;">Terms</span> and  <span style="color: #23ad96;">Conditions</span></p>
            </div>
        </div>

        <div class="footer">
            <button type="submit" name="submit">Create Account</button>
        </div>
    </div>
    </form>
  
</body>
</html>
<?php
require_once('db.php');
require_once('Ascon.php');
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Encrypt user credentials
    $encryptedUsername =  $username;
    $encryptedPassword = Ascon::encryptToHex($secretKey, $password, "additionalData", "Ascon-128");

    // Process file upload
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
        $imgFileName = $_FILES['profile']['name'];

        // Move uploaded file to a server directory
        $uploadDirectory = '../uploads/';
        $targetPath = $uploadDirectory . $imgFileName;

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $targetPath)) {
            // File uploaded successfully

            // Now, you can store $targetPath in the database instead of the entire image content
            // For example: $img = $targetPath;
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'No file uploaded.';
    }

    $encryptedpath = Ascon::encryptToHex($secretKey, $targetPath, "additionalData", "Ascon-128");
    // Insert encrypted data and file path into the database
    $sql = "INSERT INTO users (username, password, profile)
            VALUES ('$encryptedUsername', '$encryptedPassword', '$encryptedpath')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $username;

    // Display SweetAlert notification
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Account made!',
                text: 'Your account has been created.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'FinalRegister.php';
            });
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

?>