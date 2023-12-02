<?php
  require_once(__ROOT__ . "model/Model.php");
?>

<?php
class Categories extends Model
{
    public $CategoryID;
    public $CategoryName;

    public function __construct($CateoryName)
    {
        $this->db = $this->connect();
    }

    // Setters
    public function setCategoryID($CategoryID)
    {
        $this->CategoryID = $CategoryID;
    }

    public function setCategoryName($CategoryName)
    {
        $this->CategoryName = $CategoryName;
    }

    // Getters
    public function getCategoryID()
    {
        return $this->CategoryID;
    }

    public function getCategoryName()
    {
        return $this->CategoryName;
    }
   
}

class Metal extends Model
{
    private $metalID;
    private $metalName;

    public function __construct()
    {
        $this->db = $this->connect();
    }

    // Setters
    public function setMetalID($metalID)
    {
        $this->metalID = $metalID;
    }

    public function setMetalName($metalName)
    {
        $this->metalName = $metalName;
    }

    // Getters
    public function getMetalID()
    {
        return $this->metalID;
    }

    public function getMetalName()
    {
        return $this->metalName;
    }
   
}


class Product extends Model
{
    public $ProductID;
    public $ProductName;
    public $ProductPicture;
    public $Description;
    public $Weight;
    public $Size;
    public $Price;
    public $Availability;
    public $CategoryID;
    public $MetalID;

    public function __construct()
    {
        
 $this->db = $this->connect();
        
    }
    public function setProductID($ProductID)
    {
        $this->ProductID = $ProductID;
    }

    public function setProductName($ProductName)
    {
        $this->ProductName = $ProductName;
    }

    public function setProductPicture($ProductPicture)
    {
        $this->ProductPicture = $ProductPicture;
    }

    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    public function setWeight($Weight)
    {
        $this->Weight = $Weight;
    }

    public function setSize($Size)
    {
        $this->Size = $Size;
    }

    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    public function setAvailability($Availability)
    {
        $this->Availability = $Availability;
    }

    public function setCategoryID($CategoryID)
    {
        $this->CategoryID = $CategoryID;
    }

    public function setMetalID($MetalID)
    {
        $this->MetalID = $MetalID;
    }

    // Getter methods
  
    public function getProductName()
    {
        return $this->ProductName;
    }

    public function getProductPicture()
    {
        return $this->ProductPicture;
    }

    public function getDescription()
    {
        return $this->Description;
    }

    public function getWeight()
    {
        return $this->Weight;
    }

    public function getSize()
    {
        return $this->Size;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function getAvailability()
    {
        return $this->Availability;
    }
    public function getCategoryID()
    {
        $this->CategoryID;
    }

    public function getMetalID()
    {
        $this->MetalID ;
    }
    public function getCategoryName($categoryID) {
        $query = "SELECT CategoryName FROM Categories WHERE CategoryID = $categoryID";
        $result = $this->db->query($query);

        if ($result && $result->num_rows > 0) {
            $category = $result->fetch_assoc();
            return $category['CategoryName'];
        } else {
            return "Category not found";
        }
    }

    public function getMetalName($metalID) {
        $query = "SELECT MetalName FROM Metal WHERE MetalID = $metalID";
        $result = $this->db->query($query);

        if ($result && $result->num_rows > 0) {
            $metal = $result->fetch_assoc();
            return $metal['MetalName'];
        } else {
            return "Metal not found";
        }
    }
    public function addProduct($ProductName, $ProductPictures, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID)
    {
        $ProductName = $ProductName;
    
        $Description = $Description;
        $Weight = $Weight;
        $Size = $Size;
        $Price = $Price;
        $Availability = $Availability;

        $ProductPictures = implode(',', $ProductPictures);

        $query = "INSERT INTO Product (ProductName, ProductPicture, Description, Weight, Size, Price, Availability, CategoryID, MetalID) 
                  VALUES ('$ProductName', '$ProductPictures', '$Description', $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID)";
    

        if ($this->db->query($query)) {
            return true; // Product added successfully
            
        } else {
            return false; // Failed to add product
        }
    }
    public function uploadProductPictures($files) {
        $targetDirectory = "../uploads/";
        $uploadedFiles = [];

        foreach ($files['ProductPicture']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($files['ProductPicture']['name'][$key]);

            if (move_uploaded_file($tmp_name, $targetDirectory . $fileName)) {
                $uploadedFiles[] = $fileName;
            } else {
                echo "Failed to upload the product picture: {$fileName}<br>";
            }
        }

        return implode(',', $uploadedFiles);
    }

    public function getProducts()
    {
        $sql = "SELECT * FROM Product ";

		$result = $this->db->query($sql);
		if ($result->num_rows > 0){
			return $result;
		}
		else {
			return false;
		}
    }
    

    public  function editProduct( $ProductID,$ProductName, $ProductPicture, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID)
    {
        $ProductID = $ProductID;
        $ProductName =  $ProductName;
        $ProductPicture = implode(',', $ProductPicture);
        $Description =  $Description;
        $Weight = $Weight;
        $Size = $Size;
        $Price = $Price;
        $Availability =$Availability;

        $query = "UPDATE Product SET ProductName = '$ProductName', ProductPicture = '$ProductPicture', Description = '$Description', Weight = $Weight, Size = $Size, Price = $Price, Availability = $Availability, CategoryID = $CategoryID, MetalID = $MetalID WHERE ProductID = $ProductID";

        if ($this->db->query($query)) {
            return true; // Product edited successfully
        } else {
            return false; // Failed to edit the product
        }
    }

    public function deleteProduct($ProductID)
    {
        $ProductID = intval($ProductID);
        $conn = $this->db->getConn(); // Retrieve the database connection once
    
        $deleteWishlistQuery = "DELETE FROM Wishlist WHERE ProductID = $ProductID;";
        $deleteShoppingCartQuery = "DELETE FROM ShoppingCart WHERE ProductID = $ProductID";
    
        mysqli_autocommit($conn, false);
    
        if ($this->db->query($deleteWishlistQuery) && $this->db->query($deleteShoppingCartQuery)) {
            $query = "DELETE FROM Product WHERE ProductID = $ProductID";
            if ($this->db->query($query)) {
                mysqli_commit($conn);
                mysqli_autocommit($conn, true);
                return true;
            }
        }
    
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        return false;
    }
    

    public function getProductID($ProductID)
    {
        $ProductID = (int)$ProductID;
        $query = "SELECT * FROM Product WHERE ProductID = $ProductID";

        $result = $this->db->query($query);
        if ($result) {
            $productData = $this->db->fetchRow($result);
            return $productData;
        } else {
            return false;
        }
    }

    public function getProductsByCategory($CategoryID)
    {
        $CategoryID = (int)$CategoryID;
        $query = "SELECT * FROM Product WHERE CategoryID = $CategoryID";

        $result = $this->db->query($query);
        $products = [];

        if ($result) {
            while ($product = $this->db->fetchRow($result)) {
                $products[] = $product;
            }
        }

        return $products;
    }

    public function getProductsByMetal($MetalID)
    {
        $MetalID = (int)$MetalID;
        $query = "SELECT * FROM Product WHERE MetalID = $MetalID";

        $result = $this->db->query($query);
        $products = [];

        if ($result) {
            while ($product = $this->db->fetchRow($result)) {
                $products[] = $product;
            }
        }

        return $products;
    }
    public function getAllMetals()
    {
        $query = "SELECT MetalID, MetalName FROM Metal";
        $result = $this->db->query($query);
        $metals = [];

        if ($result) {
            while ($metal = $this->db->fetchRow($result)) {
                $metals[] = $metal;
            }
        }

        return $metals;
    }

    public function getAllCategories()
    {
        $query = "SELECT CategoryID, CategoryName FROM Categories";
        $result = $this->db->query($query);
        $categories = [];

        if ($result) {
            while ($category = $this->db->fetchRow($result)) {
                $categories[] = $category;
            }
        }

        return $categories;
    }
}

?>
