<?php

require_once("Controller.php");
class OrderController extends Controller
{
    public function createOrder($userID,  $totalAmount, $status, $cartDetails, $selectedAddressID)
    {

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
        
        public function getAllOrders()
        {
            return $this->model->getAllOrders();
        }
        public function deleteOrder($OrderID)
        {
            return $this->model->deleteOrder($OrderID);
        }
        public function updateOrderStatus($orderId, $newStatus)
        {
            return $this->model->updateOrderStatus($orderId, $newStatus);
        }
}
?>
