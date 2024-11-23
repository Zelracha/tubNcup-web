<?php
// Database connection parameters for MariaDB
$servername = "127.0.0.1";
$username = "root";
$password = ""; // Assuming no password for local development
$dbname = "cafe-form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8
$conn->set_charset("utf8mb4");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $phone_number = $conn->real_escape_string($_POST['number']);
    $pickup_time = $conn->real_escape_string($_POST['timePickup']);
    $payment_method = $conn->real_escape_string($_POST['payment']);
    $cart_items = $conn->real_escape_string($_POST['cart_items']);

    // Prepare SQL statement
    $sql = "INSERT INTO `customer-form` 
            (full_name, phone_number, pickup_time, payment_method, cart_items, order_date) 
            VALUES 
            ('$fullname', '$phone_number', '$pickup_time', '$payment_method', '$cart_items', NOW())";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        // Successful submission
        header('Location: order-confirmation.html');
        exit();
    } else {
        // Error handling
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
} 
?>