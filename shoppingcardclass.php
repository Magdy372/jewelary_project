<?php
class ShoppingCart
{
    private $userID;
    private $productID;
     // Use a static property to store the total price

    public function __construct($userID, $productID)
    {
        $this->userID = $userID;
        $this->productID = $productID;
    }

    public static function addToCart($userID, $productID)
    {
        $userID = $userID;
        $productID = $productID;
        $check = false;
        $cartItems = array();

        $select_query = "SELECT * FROM ShoppingCart WHERE UserID = $userID";
        $result = mysqli_query($GLOBALS['con'], $select_query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Append each row to the $cartItems array
                $cartItems[] = $row;
            }

            foreach ($cartItems as $element) {
                if ($element['ProductID'] == $productID) {
                    $check = true;
                    break;
                }
            }

         

                if ($check) {
                    echo "Product is already in the cart ;)";
                } else {
                    $query = "INSERT INTO ShoppingCart (UserID, ProductID) VALUES ($userID, $productID)";

                    if (mysqli_query($GLOBALS['con'], $query)) {
                        // Calculate the total price after adding the product
                       
                        return true ;// Return the updated total price
                    } else {
                        return false; // Failed to add the product
                    }
                }
            } else {
                return false; // Failed to fetch product price
            }
        }
    


    
    static function dispalyCart($userID){
       
        include_once ("productClass.php");

        $select_query = "SELECT * FROM ShoppingCart WHERE UserID = $userID";
        $result = mysqli_query($GLOBALS['con'], $select_query);

        $shoppingcart = array(); // Initialize an empty array to store wishlist items
        $finallarr = array(); // Initialize an empty array to store Product objects
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Append each row to the $wishlistItems array
                $shoppingcart[] = $row;
            }
            
            // Loop through $wishlistItems to create Product objects and store them in $finallarr
            foreach ($shoppingcart as $element) {
                $obj = new Product($element['ProductID']);
                $finallarr[] = $obj;
            }
            return $finallarr;
        } else {
            // Error handling
        }
    
    }
    
    public static function deleteFromCart($userID, $productID) {
        // Implement the code to delete the item with $productID from the wishlist of the user with $userID.
        // You can use SQL queries to perform the deletion.
        // Return true if the item is successfully deleted, or false if there's an error.

        $delete_query = "DELETE FROM ShoppingCart WHERE UserID = $userID AND ProductID = $productID";
        $result = mysqli_query($GLOBALS['con'], $delete_query);
        
        if ($result) {
            // Successfully removed from the wishlist
        } else {
            // Error handling
        }


    }
    


}