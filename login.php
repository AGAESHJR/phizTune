<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Validate and sanitize the data (you can add more validation as per your requirements)
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    $servername = 'localhost'; // Replace with your server name
    $username = 'root'; // Replace with your MySQL username
    $password = '1234'; // Replace with your MySQL password
    $dbname = 'demo'; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    
    // Execute the statement
    $stmt->execute();
    
    // Bind the result
    $stmt->bind_result($hashedPassword);
    
    // Fetch the result
    $stmt->fetch();
    
    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Login successful
        // Redirect to home.html
        header("Location: home.html");
        exit(); // Terminate the current script to ensure the redirect happens
    } else {
        // Login failed
        echo "Invalid email or password";
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
