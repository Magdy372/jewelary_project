<?php

define('__ROOT__', "../");
require_once(__ROOT__ . "model/OrderModel.php");
$orderModel = new OrderModel("models/Order");
$orders = $orderModel->getOrders();

$totalSales = array_sum(array_column($orders, 'TotalAmount'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_Order</title>
</head>

<body>
    <?php if (!empty($orders)) : ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Address ID</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order['OrderID'] ?></td>
                    <td><?= $order['AddressID'] ?></td>
                    <td><?= $order['TotalAmount'] ?></td>
                    <td><?= $order['Status'] ?></td>
                    <td>
                        <a href="edit_order.php?order_id=<?= $order['OrderID'] ?>">Edit</a>
                        
                        <a href="delete_order.php?order_id=<?= $order['OrderID'] ?>" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div>
            <h3>Total Sales:</h3>
            <p><?= $totalSales ?></p>
        </div>

    <?php else : ?>
        <p>No orders found for the user.</p>
    <?php endif; ?>
</body>

</html>