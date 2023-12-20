<?php

define('__ROOT__', "../");
require_once(__ROOT__ . "model/OrderModel.php");
require_once(__ROOT__ . "controller/OrderController.php");
$orderModel = new OrderModel();
$orders = $orderModel->getOrders();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['new_status'];

    // Update the order status in the database
    $orderModel->updateOrderStatus($orderId, $newStatus);
    // Redirect or display a success message as needed
    header("Location: Order_admin.php");
    exit();
}

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

                        <form method="post">
                            <input type="hidden" name="order_id" value="<?= $order['OrderID'] ?>">
                            <select name="new_status">
                                <option value="Cancelled">Cancelled</option>
                                <option value="Done">Done</option>
                                <option value="Pending">Pending</option>
                            </select>
                            <button type="submit" name="update_status">Update</button>
                        </form>

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