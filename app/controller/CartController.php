<?php

require_once(__ROOT__ . "controller/Controller.php");
class CartController extends Controller
{
    public $userID;
    public $productID;


    public function addToCart($userID, $productID)
    {
        //$userID = $_REQUEST['userID'];
       // $productID = $_REQUEST['productID'];
       
       
        $this->model->addToCart($userID, $productID);

    }
}