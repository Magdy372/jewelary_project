<?php
require_once(__ROOT__ . "model/Model.php");
class OrderModel extends Model
{
  

    public function __construct()
    {
        $this->db = $this->connect();
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

        // Clear the user's cart after creating the order
        // You might have a method in ShoppingCart class for this
        // ShoppingCart::clearCart($userID);

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

}
