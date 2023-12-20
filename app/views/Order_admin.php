<?php

define('__ROOT__', "../");
require_once(__ROOT__ . "model/OrderModel.php");
require_once(__ROOT__ . "controller/OrderController.php");

$model = new OrderModel();
$ordercontroller = new OrderController($model);

$orders = $ordercontroller->getAllOrders();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['new_status'];

    $orders=$ordercontroller->updateOrderStatus($orderId, $newStatus);

    header("Location: Order_admin.php");
    exit();
}


$totalSales = array_sum(array_column($orders, 'TotalAmount'));

if (isset($_POST['deleteOrder'])) {
    // Check if the 'OrderID' key exists and is not empty in $_POST
    if (isset($_POST['OrderID']) && !empty($_POST['OrderID'])) {
        $OrderID = $_POST['OrderID'];
        $ordercontroller->deleteOrder($OrderID);
        // Redirect back to the Admins.php page after deletion
        header("Location: Order_admin.php");
        exit();
    } else {
        echo "Error: OrderID is not provided or is empty.";       
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_Order</title>
    <link rel="stylesheet" href="../../css/Order_admin.css">

</head>

<body>

                <div class="navbar">
                <img src="../../img/alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
                <a href="admin.php">Admin Dashboard</a>
                <a href="Order_admin.php">Orders</a>
                <a href="crud.php">Product</a>
                <a href="usercrud.php">Users</a>
                <a href="Admins.php">Admins</a>

            </div>


    <?php if (!empty($orders)) : ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Address ID</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order['OrderID'] ?></td>
                    <td><?= $order['AddressID'] ?></td>
                    <td><?= $order['TotalAmount'] ?></td>
                    <td><?= $order['Status'] ?></td>
                    <td>

                        <form method="post">
                            <input type="hidden" name="order_id" value="<?= $order['OrderID'] ?>">
                            <select name="new_status">
                                <option value="Cancelled">Cancelled</option>
                                <option value="Done">Done</option>
                                <option value="Pending">Pending</option>
                            </select>
                            <button type="submit" name="update_status">Update</button>
                        </form>

                        <form method="post" style="display: inline;">
                        <input type="hidden" name="OrderID" value="<?= $order['OrderID'] ?>">

                                        <button type="submit" name="deleteOrder">Delete</button>
                                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="Details">
            <h3>Total Sales:</h3>
            <p><?= $totalSales ?></p>
        </div>

    <?php else : ?>
        <p>No orders found for the user.</p>
    <?php endif; ?>
</body>

</html>