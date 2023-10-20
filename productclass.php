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
    
}
?>

