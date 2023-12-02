
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
    // Initialization of class properties based on values from $row
    $this->ProductID = $row["ProductID"];
    $this->ProductName = $row["ProductName"];
    $this->ProductPicture = $row["ProductPicture"];
    $this->Description = $row["Description"];
    $this->Weight = $row["Weight"];
    $this->Size = $row["Size"];
    $this->Price = $row["Price"];
    $this->Availability = $row["Availability"];
    $this->CategoryID = $row["CategoryID"];
    $this->MetalID = $row["MetalID"];
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
    public function getProductID()
    {
        return $this->ProductID;
    }

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

  

    public function addProduct($ProductName, $ProductPictures, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID)
{
    // Escape other string inputs
    $ProductName = $this->db->getConn()->real_escape_string($ProductName);
    $Description = $this->db->getConn()->real_escape_string($Description);

    $escapedProductPictures = array();
    foreach ($ProductPictures as $picture) {
        // Escape each filename
        $escapedPicture = $this->db->getConn()->real_escape_string($picture);
        $escapedProductPictures[] = $escapedPicture;
    }

    $productPicturesString = implode(',', $escapedProductPictures);

    $query = "INSERT INTO Product (ProductName, ProductPicture, Description, Weight, Size, Price, Availability, CategoryID, MetalID) VALUES ('$ProductName', '$productPicturesString', '$Description', $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID)";

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
