<?php

require_once("Controller.php");
class OrderController extends Controller
{
public function createOrder($userID,  $totalAmount, $status, $cartDetails,$selectedAddressID)
    {
      
            // Validate and sanitize input if necessary

            // Get user ID from the session
            $userID = $_SESSION['UserID'];
            $totalAmount = $_SESSION['cartDetails']['sum'];
            $status = 'Pending';
            $selectedAddressID = $_REQUEST['selectedAddressID'];


            // Create the order and get the order ID
            $orderID = $this->model->createOrder($userID, $totalAmount, $status, $_SESSION['cartDetails'],$selectedAddressID);

        }
        public function getOrdersByUserID($userID){
           return $this->model->getOrdersByUserID($userID);
        }  
        public function deleteOrder($orderID)
        {
            // Add validation or other logic if needed
    
            // Call the deleteOrder method in the model
            $this->model->deleteOrder($orderID);
        }
    }
        ?>
