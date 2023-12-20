<?php
require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "controller/ProductController.php");
?>
<?php

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
            $sqlOrder = "INSERT INTO Order_table (UserID, AddressID, TotalAmount, Status) 
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

                $sqlOrderDetails = "INSERT INTO OrderDetails (OrderID, ProductID, Quantity, Subtotal) 
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
        $sql = "SELECT * FROM Order_table WHERE UserID = '$userID'";
        $result = $this->db->query($sql);

        $orders = array();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orderID = $row['OrderId'];



                $order = array(
                    'OrderID' => $orderID,
                    'AddressID' => $row['AddressID'],
                    'TotalAmount' => $row['TotalAmount'],
                    'Status' => $row['Status'],

                );

                $orders[] = $order;
            }
        }

        return $orders;
    }

    // public function getOrders()
    // {
    //     // Retrieve orders by UserID from Order_table
    //     $sql = "SELECT * FROM Order_table";
    //     $result = $this->db->query($sql);

    //     $orders = array();

    //     if ($result) {
    //         while ($row = $result->fetch_assoc()) {
    //             $orderID = $row['OrderId'];



    //             $order = array(
    //                 'OrderID' => $orderID,
    //                 'AddressID' => $row['AddressID'],
    //                 'TotalAmount' => $row['TotalAmount'],
    //                 'Status' => $row['Status'],

    //             );

    //             $orders[] = $order;
    //         }
    //     }

    //     return $orders;
    // }

    public function updateOrderStatus($orderId, $newStatus)
    {
        try {
            $query = "UPDATE Order_table SET Status = '$newStatus' WHERE OrderID = '$orderId'";
            $result = $this->db->query($query);

            if (!$result) {
                throw new Exception("Error updating order status: " . $this->db->error);
            }

            // Check the number of affected rows
            $affectedRows = $this->db->affected_rows;

            if ($affectedRows == 0) {
                throw new Exception("No rows were updated. Check if the order ID exists.");
            }
        } catch (Exception $e) {
            // Log or handle the exception appropriately
            echo $e->getMessage();
        }
    }

    public function getAllOrders()
    {
       // Retrieve all orders from Order_table
        $sql = "SELECT * FROM Order_table";
        $result = $this->db->query($sql);

        $orders = array();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orderID = $row['OrderId'];



                $order = array(
                    'OrderID' => $orderID,
                    'AddressID' => $row['AddressID'],
                    'TotalAmount' => $row['TotalAmount'],
                    'Status' => $row['Status'],

                );

                $orders[] = $order;
            }
        }

        return $orders;                                  
    }

    public function deleteOrder($OrderID) {
		// Adjust the query based on your database structure
        $sql = "DELETE FROM Order_table WHERE OrderID = $OrderID";
		$this->db->query($sql);
	}
    
}
class OrderDetails extends Model
{
    public $orderID;
    public $productID;
    public $quantity;
    public $subtotal;

    public function __construct($orderID)
    {
        $this->db = $this->connect();

        // If an orderID is provided, load the order details
        if (!is_null($orderID)) {
            $this->orderID = $orderID;
            $this->fetchOrderDetails($orderID);
        }
    }

    public function fetchOrderDetails($orderID)
    {
        // Retrieve order details by OrderID from OrderDetails
        $sql = "SELECT * FROM OrderDetails WHERE OrderID = '$orderID'";
        $result = $this->db->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Set individual attributes for each product in the order
                $this->productID[] = $row['ProductID'];
                $this->quantity[] = $row['Quantity'];
                $this->subtotal[] = $row['Subtotal'];
            }
        }
    }

    // Add a method to get all order details as an array


    // public function getAllOrderDetails()
    // {
    //     $details = array();

    //     foreach ($this->productID as $key => $productID) {
    //         $details[] = array(
    //             'ProductID' => $productID,
    //             'Quantity' => $this->quantity[$key],
    //             'Subtotal' => $this->subtotal[$key],
    //         );
    //     }

    //     return $details;
    // }



}
?>