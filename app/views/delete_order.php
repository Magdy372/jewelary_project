<?php
// delete_order.php

define('_ROOT_', "../");
require_once(_ROOT_ . "controller/OrderController.php");
require_once(_ROOT_ . "model/OrderModel.php"); // Adjust the path as needed

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['order_id'])) {
    $orderID = $_GET['order_id'];

    // Instantiate the OrderDetails model
    $orderDetailsModel = new OrderDetails($orderID);

    // Instantiate the OrderController and pass the OrderDetails model as an argument
    $orderController = new OrderController($orderDetailsModel);

    // Call the deleteOrder function
    $orderController->deleteOrder($orderID);

    // Redirect back to the Order_admin.php page after deletion
    header("Location: Order_admin.php");
    exit();
} else {
    // Redirect to the main page or handle accordingly
    header("Location: Order_admin.php");
    exit();
}
?>