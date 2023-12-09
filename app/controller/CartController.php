<?php

require_once(__ROOT__ . "controller/Controller.php");
class CartController extends Controller
{
    //public $userID;
    //public $productID;


    public function addToCart($userID, $productID)
    {
        $this->model->addToCart($userID, $productID);
    }


    public function Display($userID)
    {
        
       $Cartobj =  $this->model->displayCart($userID);
        return $Cartobj;
    }


    public function Clear($userID)
    {
        
        $Cartobj =  $this->model->clearCart($userID);
        return $Cartobj;
    }

    public function Delete($userID, $productID)
    {
        $this->model->deleteFromCart($userID, $productID);
    }
}