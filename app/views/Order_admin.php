<?php

define('_ROOT_', "../");
require_once(_ROOT_ . "model/OrderModel.php");
$orderModel = new OrderModel("models/Order");
$orders = $orderModel->getOrders();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>

<body>
    <?php if (!empty($orders)) : ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Address ID</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order['OrderID'] ?></td>
                    <td><?= $order['AddressID'] ?></td>
                    <td><?= $order['TotalAmount'] ?></td>
                    <td><?= $order['Status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No orders found for the user.</p>
    <?php endif; ?>
</body>

</html>