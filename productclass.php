<?php
$con = mysqli_connect("172.232.216.8", "root", "Omarsalah123o","Jewelry_project");

//categories
class Categories {
    public $CategoryID;
    public $CategoryName;

    public function __construct($CategoryName) {
        $this->CategoryName = $CategoryName;
    }
}


class Product {
    public $ProductID;
    public $ProductName;
    public $ProductPicture;
    public $Description;
    public $Weight;
    public $Size;
    public $Price;
    public $Availability;
    public $CategoryID;

    public function __construct($ProductName, $ProductPicture, $Description, $Weight, $Size, $Price, $Availability, $CategoryID) {
        $this->ProductName = $ProductName;
        $this->ProductPicture = $ProductPicture;
        $this->Description = $Description;
        $this->Weight = $Weight;
        $this->Size = $Size;
        $this->Price = $Price;
        $this->Availability = $Availability;
        $this->CategoryID = $CategoryID;
    }

    static public function addProduct($con, $ProductName, $ProductPicture, $Description, $Weight, $Size, $Price, $Availability, $CategoryID) {
        $ProductName = mysqli_real_escape_string($con, $ProductName);
        $ProductPicture = mysqli_real_escape_string($con, $ProductPicture);
        $Description = mysqli_real_escape_string($con, $Description);
        $Weight = $Weight;
        $Size = $Size;
        $Price = $Price;
        $Availability = $Availability;
    
        $query = "INSERT INTO Product (ProductName, ProductPicture, Description, Weight, Size, Price, Availability, CategoryID) VALUES ('$ProductName', '$ProductPicture', '$Description', $Weight, $Size, $Price, $Availability, $CategoryID)";
    
        if (mysqli_query($GLOBALS['con'], $query)) {
            return true; // Product added successfully
        } else {
            return false; // Failed to add product
        }
    }
    static public function getProducts($con) {
        $query = "SELECT * FROM Product";
    
        $result = mysqli_query($con, $query);
        $products = [];
    
        if ($result) {
            while ($product = mysqli_fetch_assoc($result)) {
                $products[] = $product;
            }
        }
    
        return $products;
    }

    
    
    // Edit an existing product
    static public function editProduct($con, $ProductID, $ProductName, $ProductPictures, $Description, $Weight, $Size, $Price, $Availability, $CategoryID) {
        $ProductID = intval($ProductID);
        $ProductName = mysqli_real_escape_string($con, $ProductName);
        $ProductPictures = implode(',', $ProductPictures); // Convert array to a comma-separated string
        $Description = mysqli_real_escape_string($con, $Description);
        $Weight = $Weight;
        $Size = $Size;
        $Price = $Price;
        $Availability = $Availability;

        $query = "UPDATE Product SET ProductName='$ProductName', ProductPicture='$ProductPictures', Description='$Description', Weight=$Weight, Size='$Size', Price=$Price, Availability=$Availability, CategoryID=$CategoryID WHERE ProductID=$ProductID";

        if (mysqli_query($con, $query)) {
            return true; // Product updated successfully
        } else {
            return false; // Failed to update product
        }
    }

    // Delete a product by ProductID
    static public function deleteProduct($con, $ProductID) {
        $ProductID = intval($ProductID);

        $query = "DELETE FROM Product WHERE ProductID = $ProductID";

        if (mysqli_query($con, $query)) {
            return true; // Product deleted successfully
        } else {
            return false; // Failed to delete product
        }
    }
}

?>

