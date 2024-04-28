<?php
// Handle GET request to retrieve user profile data

// Database connection (example using PDO)
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Assuming you have a session or token for authenticated user
    // Retrieve user data based on user ID or unique identifier (e.g., session ID)
    $userId = $_SESSION['userId']; // Example session variable holding user ID
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    // Fetch user data
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return JSON response with user profile data
    echo json_encode(array("success" => true, "data" => $userData));
} catch(PDOException $e) {
    // Handle database connection/error
    echo json_encode(array("success" => false, "message" => "Error: " . $e->getMessage()));
}
?>
