<?php
// Handle POST request for user registration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data sent via AJAX
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: Ensure password is hashed for security

    // Database connection (example using PDO)
    $servername = "your_servername";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement with prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, dob, contact, email, password) VALUES (:firstName, :lastName, :dob, :contact, :email, :password)");

        // Bind parameters and execute SQL statement
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Note: Use hashed password for security

        // Execute the prepared statement
        $stmt->execute();

        // Return JSON response indicating success
        echo json_encode(array("success" => true));
    } catch(PDOException $e) {
        // Handle database connection/error
        echo json_encode(array("success" => false, "message" => "Error: " . $e->getMessage()));
    }
}
?>
