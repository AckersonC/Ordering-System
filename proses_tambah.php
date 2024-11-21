<?php
#memulakan fungsi session
session_start();


// Assuming you have a database connection established:
include('connection.php');

// Handle the form submission
if (isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id']; // Assuming you have a hidden input with the item_id
    $quantity = $_POST['quantity'];

    // Check if the item is already in the cart
    $check_query = "SELECT * FROM cart WHERE item_id = '$item_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Item already exists, update the quantity
        $update_query = "UPDATE cart SET quantity = quantity + $quantity WHERE item_id = '$item_id'";
        mysqli_query($conn, $update_query);
    } else {
        // Item doesn't exist, add it to the cart
        $insert_query = "INSERT INTO cart (item_id, quantity) VALUES ('$item_id', $quantity)";
        mysqli_query($conn, $insert_query);
    }

    // Redirect back to the main page or display a success message
    header("Location: your_main_page.php");
}
?>