<?php
require_once(__ROOT__ . "model/Model.php");
class OrderModel extends Model
{
  

    public function __construct($userID = null)
    {
        $this->db = $this->connect();
        if (!is_null($userID)) {
            $this->getOrdersByUserID($userID);
        }
    }
    public function createOrder($userID, $totalAmount, $status, $cartDetails, $selectedAddressID)
{
    try {
        // Insert order information into Order_table
        $sqlOrder = "INSERT INTO `Order_table` (`UserID`, `AddressID`, `TotalAmount`, `Status`) 
                VALUES ('$userID', '$selectedAddressID', '$totalAmount', '$status')";
        $this->db->query($sqlOrder);

        // Get the last inserted order ID
        $orderID = $this->getLastInsertId();
        echo "orderID";
        

        // Insert order details into OrderDetails for each product in the cart
        foreach ($cartDetails as $product) {
            $productID = $product['ProductID'];
            $quantity = $product['Quantity'];
            $subtotal = $product['Subtotal'];

            $sqlOrderDetails = "INSERT INTO `OrderDetails` (`OrderID`, `ProductID`, `Quantity`, `Subtotal`) 
                               VALUES ('$orderID', '$productID', '$quantity', '$subtotal')";
            $this->db->query($sqlOrderDetails);
        }



        return $orderID; // Return the ID of the created order
    } catch (Exception $e) {
        // Log the exception message
        error_log("Error creating order: " . $e->getMessage());
        return false; // Return false to indicate an error
    }
}

    
private function getLastInsertId()
{
    $result = $this->db->query("SELECT LAST_INSERT_ID() AS last_insert_id");
    
    if ($result && $row = $result->fetch_assoc()) {
        return $row['last_insert_id'];
    }

    return null; // Return null or handle the case where the result is empty
}
public function getOrdersByUserID($userID)
    {
        // Retrieve orders by UserID from Order_table
        $sql = "SELECT * FROM `Order_table` WHERE `UserID` = '$userID'";
        $result = $this->db->query($sql);

        $orders = array();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orderID = $row['OrderId'];
                $orders[] = array(
                    'OrderID' => $orderID,
                    'AddressID' => $row['AddressID'],
                    'TotalAmount' => $row['TotalAmount'],
                    'Status' => $row['Status'],
                    'OrderDetails' => $this->getOrderDetailsByOrderID($orderID)
                );
            }
        }

        return $orders;
    }

    public function getOrderDetailsByOrderID($orderID)
    {
        // Retrieve order details by OrderID from OrderDetails
        $sql = "SELECT * FROM `OrderDetails` WHERE `OrderID` = '$orderID'";
        $result = $this->db->query($sql);

        $orderDetails = array();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orderDetails[] = array(
                    'ProductID' => $row['ProductID'],
                    'Quantity' => $row['Quantity'],
                    'Subtotal' => $row['Subtotal']
                );
            }
        }

        return $orderDetails;
    }
}


