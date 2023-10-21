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

    public function __construct($id) {
        if ($id !=""){
			$sql="select * from Product where 	ProductID =$id";
			$Product = mysqli_query($GLOBALS['con'],$sql);
			if ($row = mysqli_fetch_array($Product)){
				$this->ProductName=$row["ProductName"];
				$this->ProductPicture=$row["ProductPicture"];
				$this->Description=$row["Description"];
				$this->Weight=$row["Weight"];
				$this->Size=$row["Size"];
				$this->Price=$row["Price"];
				$this->Availability=$row["Availability"];
				$this->CategoryID=$row["CategoryID"];
			}
		}
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
    static public function editProduct($con, $ProductID, $ProductName, $ProductPicture, $Description, $Weight, $Size, $Price, $Availability, $CategoryID) {
        $ProductID = (int)$ProductID; // Ensure ProductID is an integer
        $ProductName = mysqli_real_escape_string($con, $ProductName);
        $ProductPicture = mysqli_real_escape_string($con, $ProductPicture);
        $Description = mysqli_real_escape_string($con, $Description);
        $Weight = (float)$Weight; // Ensure Weight is a float
        $Size = (float)$Size; // Ensure Size is a float
        $Price = (float)$Price; // Ensure Price is a float
        $Availability = (int)$Availability; // Ensure Availability is an integer
    
        $query = "UPDATE Product SET ProductName = '$ProductName', ProductPicture = '$ProductPicture', Description = '$Description', Weight = $Weight, Size = $Size, Price = $Price, Availability = $Availability, CategoryID = $CategoryID WHERE ProductID = $ProductID";
    
        if (mysqli_query($con, $query)) {
            return true; // Product edited successfully
        } else {
            return false; // Failed to edit the product
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

