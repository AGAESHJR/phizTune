<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $genre = $_POST["genre"];
    $password = $_POST["password"];
    
    // Validate and sanitize the data (you can add more validation as per your requirements)
    $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
    $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $dob = filter_var($dob, FILTER_SANITIZE_STRING);
    $genre = filter_var($genre, FILTER_SANITIZE_STRING);
    
    $servername = 'localhost'; // Replace with your server name
    $username = 'root'; // Replace with your MySQL username
    $password = '1234'; // Replace with your MySQL password
    $dbname = 'demo'; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Connect to the database (replace host, username, password, and dbname with your database details)
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, dob, genre, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $dob, $genre, $hashedPassword);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful
        echo "<script>
                alert('Registration successful. You can now login.');
                window.location.href = 'login.html';
              </script>";
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
