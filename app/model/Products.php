<?php
  require_once(__ROOT__ . "model/Model.php");
?>

<?php
class Categories extends Model
{
    public $CategoryID;
    public $CategoryName;

    public function __construct($CategoryName)
    {
        $this->CategoryName = $CategoryName;
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

    public function __construct($metalID, $metalName)
    {
        $this->metalID = $metalID;
        $this->metalName = $metalName;
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

    public function addProduct($ProductName, $ProductPictures, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID)
    {
        $ProductName = mysqli_real_escape_string($this->db->getConn(), $ProductName);
    
        $Description = mysqli_real_escape_string($this->db->getConn(), $Description);
        $Weight = $Weight;
        $Size = $Size;
        $Price = $Price;
        $Availability = $Availability;

        $ProductPictures = implode(',', array_map([$this->db, 'real_escape_string'], $ProductPictures));

        $query = "INSERT INTO Product (ProductName, ProductPicture, Description, Weight, Size, Price, Availability, CategoryID, MetalID) 
                  VALUES ('$ProductName', '$ProductPictures', '$Description', $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID)";
    

        if ($this->db->query($query)) {
            return true; // Product added successfully
        } else {
            return false; // Failed to add product
        }
    }

    public function getProducts()
    {
        $query = "SELECT * FROM Product";

        $result = $this->db->query($query);
        $products = [];

        if ($result) {
            while ($product = $this->db->fetchRow($result)) {
                $products[] = $product;
            }
        }

        return $products;
    }

    public  function editProduct($ProductID, $ProductName, $ProductPicture, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID)
    {
        $ProductID = (int)$ProductID;
        $ProductName = mysqli_real_escape_string($this->db->getConn(), $ProductName);
        $ProductPicture = mysqli_real_escape_string($this->db->getConn(), $ProductPicture);
        $Description = mysqli_real_escape_string($this->db->getConn(), $Description);
        $Weight = (float)$Weight;
        $Size = (float)$Size;
        $Price = (float)$Price;
        $Availability = (int)$Availability;

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

        $deleteWishlistQuery = "DELETE FROM Wishlist WHERE ProductID = $ProductID";
        $deleteShoppingCartQuery = "DELETE FROM ShoppingCart WHERE ProductID = $ProductID";

        mysqli_autocommit($this->db->getConn(), false);

        if ($this->db->query($deleteWishlistQuery) && $this->db->query($deleteShoppingCartQuery)) {
            $query = "DELETE FROM Product WHERE ProductID = $ProductID";
            if ($this->db->query($query)) {
                mysqli_commit($this->db->getConn());
                mysqli_autocommit($this->db->getConn(), true);
                return true;
            }
        }

        mysqli_rollback($this->db->getConn());
        mysqli_autocommit($this->db->getConn(), true);
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
