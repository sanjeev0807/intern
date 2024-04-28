<?php
// Handle POST request for user login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data sent via AJAX
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection settings
    $servername = "your_servername";
    $username = "your_username";
    $dbpassword = "your_password";
    $dbname = "your_database_name";

    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
        
        // Set PDO to throw exceptions on error
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare SQL statement to retrieve user by email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        
        // Bind parameters and execute SQL statement
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password if user exists
        if ($user && password_verify($password, $user['password'])) {
            // Return JSON response indicating successful login
            echo json_encode(array("success" => true));
        } else {
            // Return JSON response indicating login failed
            echo json_encode(array("success" => false, "message" => "Invalid email or password"));
        }
    } catch(PDOException $e) {
        // Handle database connection/error
        echo json_encode(array("success" => false, "message" => "Database error: " . $e->getMessage()));
    }
}
?>
