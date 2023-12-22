<?php
$servername = "localhost";
$name = "u657994792_sabayta_admin";
$password = "\$s%2Z6c+qKKgptM";

$conn = new mysqli($servername, $name, $password);

//$sql = "CREATE DATABASE IF NOT EXISTS u657994792_sabayta";
//
//if ($conn->query($sql) === TRUE) {
//    $select = mysqli_select_db($conn, "u657994792_sabayta");
//}

mysqli_select_db($conn, "u657994792_sabayta");

// create tables
$sql2 = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NULL,
    middlename VARCHAR(255) NULL,
    lastname VARCHAR(255) NULL,
    gender VARCHAR(255) NULL,
    phone VARCHAR(255) NULL,
    birthdate DATE NULL,
    profile VARCHAR(255) NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql2) === TRUE) {
    $sql3 = "CREATE TABLE IF NOT EXISTS post (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED NOT NULL,
        name VARCHAR(255) NOT NULL,
        meetingTime TIME NOT NULL,
        fromLocation VARCHAR(255) NULL,
        toLocation VARCHAR(255) NULL,
        joinedcount INT(6) UNSIGNED NOT NULL,
        status VARCHAR(255) NOT NULL,
        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    if ($conn->query($sql3) === TRUE) {
        $sql4 = "CREATE TABLE IF NOT EXISTS joined (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(6) UNSIGNED NOT NULL,
            post_id INT(6) UNSIGNED NOT NULL,
            createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (post_id) REFERENCES post(id)
        )";
//        if ($conn->query($sql4) === TRUE) {
//            $sqlEnableEventScheduler = "SET GLOBAL event_scheduler = ON;";
//            $conn->query($sqlEnableEventScheduler);
//
//            $sqlCreateEvent = "
//                CREATE EVENT IF NOT EXISTS update_post_status_event
//                ON SCHEDULE EVERY 1 MINUTE -- Adjust the frequency as needed
//                DO
//                BEGIN
//                    UPDATE post SET status = 'Done' WHERE meetingTime < CURTIME() AND status <> 'Done' AND status <> 'Deleted';
//                END;
//            ";
//
//            if ($conn->query($sqlCreateEvent) === TRUE) {
//                $sqlCreateEventDeleted = "
//            CREATE EVENT IF NOT EXISTS update_post_status_deleted_event
//            ON SCHEDULE EVERY 1 MINUTE -- Adjust the frequency as needed
//            DO
//            BEGIN
//                UPDATE post SET status = 'Deleted'
//                WHERE TIMESTAMPDIFF(HOUR, CONCAT(CURDATE(), ' ', meetingTime), NOW()) >= 2
//                AND status NOT IN ('Deleted', 'Done');
//            END;
//                ";
//                $conn->query($sqlCreateEventDeleted);
//            } else {
//                echo "Error creating trigger: " . $conn->error;
//            }
//        } else {
//            echo "Error creating joined table: " . $conn->error;
//        }
    } else {
        echo "Error creating post table: " . $conn->error;
    }
} else {
    echo "Error creating users table: " . $conn->error;
}

// users who joined the post
?>
