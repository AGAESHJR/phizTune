
<?php
// Retrieve the form data
$name = $_POST['name'];
$age = $_POST['age'];
$finalEmotion = $_POST['finalEmotion'];

// Connect to the MySQL database
$servername = 'localhost'; // Replace with your server name
$username = 'root'; // Replace with your MySQL username
$password = '1234'; // Replace with your MySQL password
$dbname = 'trial'; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Insert the data into the database
$sql = "INSERT INTO emotions (`name`, `age`, `emotion`) VALUES ('$name','$age','$finalEmotion')";
if ($conn->query($sql) === TRUE) {
    echo 'Data inserted successfully.';
} else {
    echo 'Error inserting data: ' . $conn->error;
}

$conn->close();
?>

