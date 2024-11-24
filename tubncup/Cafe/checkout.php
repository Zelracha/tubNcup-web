<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);   
error_reporting(E_ALL);

// Database connection parameters for MySQL/MariaDB
$servername = "127.0.0.1";  // Localhost for local development
$username = "root";         // Default username for local MySQL
$password = "";             // Assuming no password for local development
$dbname = "cafe-form";      // The correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8 for proper encoding of special characters
$conn->set_charset("utf8mb4");

// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $phone_number = $conn->real_escape_string($_POST['number']);
    $pickup_time = $conn->real_escape_string($_POST['timePickup']);
    $payment_method = $conn->real_escape_string($_POST['payment']);
    $cart_items = $conn->real_escape_string($_POST['cart_items']);  // Cart data (JSON)

    // Prepare SQL statement for inserting order data
    $sql = "INSERT INTO `customer-form` (full_name, phone_number, pickup_time, payment_method, cart_items, order_date) 
            VALUES ('$fullname', '$phone_number', '$pickup_time', '$payment_method', '$cart_items', NOW())";

    // Execute query and check if the data is inserted
    if ($conn->query($sql) === TRUE) {
        // If successful, redirect to the order confirmation page
        header('Location: order-confirmation.html');
        exit();
    } else {
        // If there's an error, show it
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    // Handle case where the form is not submitted correctly
    echo "Invalid request method.";
}
?>
