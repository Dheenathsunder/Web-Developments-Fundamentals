<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Server-side validation
    $errors = [];

    // Name validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Password validation (at least 6 characters)
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // Phone validation (must be exactly 10 digits)
    if (!preg_match("/^\d{10}$/", $phone)) {
        $errors[] = "Phone number must be exactly 10 digits.";
    }

    // If there are validation errors, display them
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // If no errors, process the data (for example, save it to a database)
        echo "<p style='color:green;'>Form submitted successfully!</p>";
        // Here you can handle the form data, e.g., save to a database
    }
}
?>
