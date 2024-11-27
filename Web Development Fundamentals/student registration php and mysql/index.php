<?php
// Step 1: Connect to the MySQL Database
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$dbname = "student_db";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Handle Form Submission and Insert Data into the Database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password

    // Simple form validation
    if (empty($name) || empty($email) || empty($password)) {
        $error_message = "All fields are required.";
    } else {
        // Prepare SQL query to insert data
        $sql = "INSERT INTO students (name, email, password) VALUES ('$name', '$email', '$password')";
        
        // Execute the query
        if ($conn->query($sql) === TRUE) {
            $success_message = "New record created successfully!";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Step 3: Close the Database Connection
$conn->close();
?>

