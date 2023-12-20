<?php

define('__ROOT__', "../");
require_once(__ROOT__ . "model/OrderModel.php");
require_once(__ROOT__ . "controller/OrderController.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['order_id'])) {
    $orderID = $_GET['order_id'];

    // Instantiate the OrderDetails model
    $orderDetailsModel = new OrderDetails($orderID);

    // Instantiate the OrderController and pass the OrderDetails model as an argument
    $orderController = new OrderController($orderDetailsModel);

    // Call the deleteOrder function
    $orderDetailsModel->deleteOrder($orderID);

    // Redirect back to the Order_admin.php page after deletion
    header("Location: Order_admin.php");
    exit();
} else {
    // Redirect to the main page or handle accordingly
    header("Location: Order_admin.php");
    exit();
}
?>
