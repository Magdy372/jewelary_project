<?php

require_once(__ROOT__ . "controller/Controller.php");
class WishlistController extends Controller
{
    //public $userID;
    //public $productID;


    public function Adding($userID, $productID)
    {
        
        $this->model->addToWishlist($userID, $productID);
        
    }


    public function Display($userID)
    {
        
       $Wishobj =  $this->model->dispalyWish($userID);
        return $Wishobj;
    }


    public function Delete($userID, $productID)
    {
        $this->model->deleteFromWishlist($userID, $productID);
    }
}