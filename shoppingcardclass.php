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
    $select_query = "SELECT * FROM ShoppingCart WHERE UserID = $userID AND ProductID = $productID";
    $result = mysqli_query($GLOBALS['con'], $select_query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // If product is already in the cart, update quantity and subtotal
            $quantity = $row['Quantity'] + 1;

            // Fetch the product price from the Product table
            $priceQuery = "SELECT Price FROM Product WHERE ProductID = $productID";
            $priceResult = mysqli_query($GLOBALS['con'], $priceQuery);

            if ($priceResult) {
                $priceRow = mysqli_fetch_assoc($priceResult);

                // Check if the product exists
                if ($priceRow) {
                    $productPrice = $priceRow['Price'];

                    // Calculate subtotal
                    $subtotal = $row['Subtotal'] + $productPrice;

                    // Update the cart
                    $update_query = "UPDATE ShoppingCart SET Quantity = $quantity, Subtotal = $subtotal WHERE UserID = $userID AND ProductID = $productID";

                    if (mysqli_query($GLOBALS['con'], $update_query)) {
                        return true; // Return success
                    } else {
                        return false; // Failed to update the product quantity
                    }
                } else {
                    // Handle the case where the product does not exist
                    return false;
                }
            } else {
                // Failed to fetch product price
                return false;
            }
        } else {
            // If the product is not in the cart, insert a new row with Subtotal as ProductPrice
            $insert_query = "INSERT INTO ShoppingCart (UserID, ProductID, Quantity, Subtotal) VALUES ($userID, $productID, 1, (SELECT Price FROM Product WHERE ProductID = $productID))";

            if (mysqli_query($GLOBALS['con'], $insert_query)) {
                return true; // Return success
            } else {
                return false; // Failed to add the product
            }
        }
    } else {
        return false; // Failed to fetch product details
    }
}

    
    static function displayCart($userID)
{
    include_once("productClass.php");

    $select_query = "SELECT * FROM ShoppingCart WHERE UserID = $userID";
    $result = mysqli_query($GLOBALS['con'], $select_query);

    $cartItems = array(); // Initialize an empty array to store cart items

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Append each row to the $cartItems array
            $cartItems[] = $row;
        }

        $products = array(); // Initialize an array to store product details

        foreach ($cartItems as $item) {
            $productID = $item['ProductID'];
            $quantity = $item['Quantity'];

            // Fetch product details from the Product table
            $product_query = "SELECT * FROM Product WHERE ProductID = $productID";
            $product_result = mysqli_query($GLOBALS['con'], $product_query);

            if ($product_result) {
                $product_details = mysqli_fetch_assoc($product_result);

                // Add product details to the products array
                $products[] = array(
                    'ProductID' => $productID,
                    'ProductName' => $product_details['ProductName'],
                    'ProductPrice' => $product_details['Price'],
                    'ProductPicture' => $product_details['ProductPicture'], // Assuming you have a 'ProductPicture' column in the Product table
                    'Quantity' => $quantity,
                    'Subtotal' => $item['Subtotal']
                );
            }
        }

        // Return the array containing product details
        return $products;
    } else {
        // Error handling
        return false;
    }
}

    public static function deleteFromCart($userID, $productID) {
       

        $delete_query = "DELETE FROM ShoppingCart WHERE UserID = $userID AND ProductID = $productID";
        $result = mysqli_query($GLOBALS['con'], $delete_query);
        
        if ($result) {
       
        } else {
           
        }


    }
    public static function clearCart($userID)
    {
        // Use the DELETE query to remove all items from the ShoppingCart for the given user
        $clear_query = "DELETE FROM ShoppingCart WHERE UserID = $userID";
        $result = mysqli_query($GLOBALS['con'], $clear_query);

        if ($result) {
            return true; // Return success
        } else {
            return false; // Failed to clear the cart
        }
    }

   
}
    


