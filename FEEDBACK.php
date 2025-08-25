<?php
// Database connection (update these details based on your setup)
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "car_accessories_managment_database"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback_type = $_POST['feedback-type'];
    $feedback_text = $_POST['feedback'];

    // (Optional) Fetch user ID from the users table based on the email address (assuming users table exists)
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        
        // Insert the feedback into the feedback table
        $sql = "INSERT INTO feedback (user_id, feedback_type, feedback) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $feedback_type, $feedback_text);

        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

    } else {
        echo "No user found with the provided email.";
    }
    
    // Close connections
    $stmt->close();
    $conn->close();
}

?>
