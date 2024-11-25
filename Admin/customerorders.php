<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="customerorders.css">
</head>
<body>
<header>
    <img src="icons/tnclogo.PNG" class="logo" alt="">
    <nav>
        <ul>
            <li><a href="../Landing/landing.html">BOOKINGS</a></li>
            <li><a href="booking.html"><b>ORDERS</b></a></li>
        </ul>
    </nav>
</header>

<h1> Orders </h1>
<br>
<table class="table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Full Name</th>
            <th>Phone Number</th>
            <th>Pickup Time</th>
            <th>Mode of Payment</th>
            <th>Cart Items</th>
            <th>Order Date</th>
            <th>Total Price</th>
            <th>Actions</th> <!-- New column for actions -->
        </tr>
    </thead>
    <tbody>
        <?php 
            $servername = "localhost";  // Localhost for XAMPP  
            $username = "root";      // Default username for local MySQL  
            $password = "";         // Assuming no password for local development  
            $dbname = "cafe-form";    // The correct database name  
            $conn = new mysqli($servername, $username, $password, $dbname);  

            $sql = "SELECT * FROM customer_form";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid query: ".$conn->error);
            }
            while ($row = $result->fetch_assoc()){
                echo "<tr id='order-".$row["id"]."'> <!-- Set ID for row to target via JS -->
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["full_name"] . "</td>
                    <td>" . $row["phone_number"] . "</td>
                    <td>" . $row["pickup_time"] . "</td>
                    <td>" . $row["payment_method"] . "</td>
                    <td>" . $row["cart_items"] . "</td>
                    <td>" . $row["order_date"] . "</td>
                    <td>" . $row["total_price"] . "</td>
                    <td>
                        <button class='action-btn complete-btn' style='background-color:rgb(126, 190, 137);' onclick='updateOrderStatus(".$row["id"].", \"complete\")'><b>Complete Order</b></button>
                        <button class='action-btn cancel-btn' style='background-color:rgb(250, 78, 78); margin-top:3px;' onclick='updateOrderStatus(".$row["id"].", \"cancel\")  '><b>Cancel Order</b></button>
                    </td>
                </tr>";
            }
        ?>
    </tbody>
</table>

<script>
// Function to handle order actions (complete/cancel)
function updateOrderStatus(orderId, action) {
    const row = document.getElementById('order-' + orderId);
    
    if (action === "complete") {
        // Change the row's background color to indicate the order is complete
        row.style.backgroundColor = "#d4edda"; // Green background for completed order
        alert('Order ' + orderId + ' marked as complete.');
    } else if (action === "cancel") {
        // Change the row's background color to indicate the order is cancelled
        row.style.backgroundColor = "#f8d7da"; // Red background for cancelled order
        alert('Order ' + orderId + ' cancelled.');
    }
    
    // Remove the row from the table after the action is done
    setTimeout(() => {
        row.style.display = 'none'; // Hide the row after completion
    }, 1000); // Delay to show the action message before removal
}
</script>

</body>
</html>
