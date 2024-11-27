<?php
// Step 1: Connect to MySQL
$servername = "localhost";
$username = "root";  // MySQL username
$password = "";      // MySQL password (default is empty)
$dbname = "employee_db"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    // Simple form validation
    if (empty($name) || empty($email) || empty($position) || empty($salary)) {
        $error_message = "All fields are required.";
    } else {
        // Insert data into MySQL table
        $sql = "INSERT INTO employees (name, email, position, salary) 
                VALUES ('$name', '$email', '$position', '$salary')";
        
        if ($conn->query($sql) === TRUE) {
            $success_message = "Employee registered successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}

// Step 3: Close MySQL connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
</head>
<body>
    <h1>Employee Information</h1>

    <!-- Display Error or Success Message -->
    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    if (isset($success_message)) {
        echo "<p style='color: green;'>$success_message</p>";
    }
    ?>

    <!-- Employee Registration Form -->
    <form method="POST" action="employee_info.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="position">Position:</label><br>
        <input type="text" id="position" name="position"><br><br>

        <label for="salary">Salary:</label><br>
        <input type="text" id="salary" name="salary"><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>