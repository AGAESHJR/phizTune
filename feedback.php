<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $servername = 'localhost';
    $username = 'root';
    $password = '1234';
    $dbname = 'trial';

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "INSERT INTO feedback (`name`, `email`, `message`) VALUES ('$name','$email','$message')";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: aboutus.html');
        exit;
    } else {
        echo 'Error inserting data: ' . $conn->error;
    }

    $conn->close();
}
?>
