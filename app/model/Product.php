<?php
require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "controller/ProductController.php");
?>
<?php


class Product extends Model {
    private $productName;
    private $description;
    private $productPicture;
    private $price;
    private $productType;
    private $optionsValues;
    public function __construct($productID = null)
    {
        $this->db = $this->connect();

        // If a productID is provided, load the product data
        if (!is_null($productID)) {
            $this->readProduct($productID);
        }
    }
    public function readProduct($productID)
    {
        $sql = "SELECT * FROM `product` WHERE id = $productID";
        $result = $this->db->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            
            $this->productName = $row['ProductName'];
            $this->description = $row['Description'];
            $this->productPicture = $row['ProductPicture'];
            $this->price = $row['Price'];


            return true; // Product found and attributes set
        } else {
            return false; // Product not found
        }
    }
    public function getAllProducts() {
        $sql = "SELECT * FROM product";
        $result = $this->connect()->query($sql);
        $products = [];
        while ($row = $this->connect()->fetchRow($result)) {
            $products[] = $row;
        }
        return $products;
    }
    public function getProductTypeName($productTypeId) {
        $productTypeId =$productTypeId;

        $sql = "SELECT Type FROM product_type WHERE ID = $productTypeId";
        $result = $this->connect()->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $row = $this->connect()->fetchRow($result);
            return $row['Type'];
        } else {
            return 'Unknown'; // Default value if the product type is not found
        }
    }
     public function getProductById($productId) {
        $productId = $productId;
        $sql = "SELECT * FROM product WHERE id = $productId";
        $result = $this->connect()->query($sql);
        $row = $this->connect()->fetchRow($result);
        return $row;
    }
    public function getProductSOVValues($productId) {
    $productId =($productId);

    $sql = "SELECT `Product_Type_S_O`, `Value` 
            FROM `product_s_o_v` 
            WHERE `Product_ID` = '$productId'";

    $result = $this->connect()->query($sql);
    
    $sovValues = [];
    while ($row = $this->connect()->fetchRow($result)) {
        $sovValues[] = $row;
    }

    return $sovValues;
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
    
    public function addProduct($productName, $description, $ProductPicture, $price, $productType, $optionsValues) {
        // Insert into product table
        $insertProductQuery = "INSERT INTO `product` (`ProductName`, `Description`, `ProductPicture`, `Price`, `Product_Type`) 
                               VALUES (?, ?, ?, ?, ?)";
    
        // Log SQL query
        error_log("SQL query (product): $insertProductQuery");
    
        // Use prepared statement for product insert
        $stmtProduct = $this->connect()->prepare($insertProductQuery);
        $stmtProduct->bind_param("ssssi", $productName, $description, $ProductPicture, $price, $productType);
    
        // Execute the product insert
        $resultProductInsert = $stmtProduct->execute();
    
        if ($resultProductInsert) {
            // Get the last inserted product ID
            $productId = $stmtProduct->insert_id;
          
    
            // Close the prepared statement
            $stmtProduct->close();
    
            // Insert values into product_s_o_v for each option
            foreach ($optionsValues as $optionId => $optionValue) {
                $insertOptionQuery = "INSERT INTO `product_s_o_v` (`Product_ID`, `Product_Type_S_O`, `Value`) 
                                      VALUES (?, ?, ?)";
    
                // Log SQL query for options
                error_log("SQL query (options): $insertOptionQuery");
    
                // Use prepared statement for options insert
                $stmtOption = $this->connect()->prepare($insertOptionQuery);
                $stmtOption->bind_param("iss", $productId, $optionId, $optionValue);
    
                // Execute the options insert
                $resultOptionInsert = $stmtOption->execute();
    
                if (!$resultOptionInsert) {
                    // Log an error if the option insert fails
                    error_log("Error inserting option: " . $stmtOption->error);
                    return;
                }
    
                // Close the prepared statement for options
                $stmtOption->close();
            }
        } else {
            // Log an error if the product insert fails
            error_log("Error inserting product: " . $stmtProduct->error);
        }
    }
    
    
    
    

    
    public function updateProduct($productId, $productName, $description, $productPicture, $price, $optionsValues) {
        $productId = $productId;
        $productName = $productName;
        $description = $description;
       
        $price = $price;
 

        // Update product table
        $updateProductQuery = "UPDATE `product` 
                               SET `ProductName` = '$productName', `Description` = '$description', 
                                   `ProductPicture` = '$productPicture', `Price` = '$price' 
                                    
                               WHERE `id` = '$productId'";

        $this->connect()->query($updateProductQuery);

        // Delete existing options for the product
        $deleteOptionsQuery = "DELETE FROM `product_s_o_v` WHERE `Product_ID` = '$productId'";
        $this->connect()->query($deleteOptionsQuery);

        // Insert new values into product_s_o_v for each option
        foreach ($optionsValues as $optionId => $optionValue) {
            $optionValue = $optionValue;

            $insertOptionQuery = "INSERT INTO `product_s_o_v` (`Product_ID`, `Product_Type_S_O`, `Value`) 
                                  VALUES ('$productId', '$optionId', '$optionValue')";

            $this->connect()->query($insertOptionQuery);
        }
    }

    public function deleteProduct($productId) {
       

        // Delete product from product_s_o_v
        $deleteSOVQuery = "DELETE FROM product_s_o_v WHERE Product_ID = '$productId'";
        $this->connect()->query($deleteSOVQuery);

        // Delete product from product
        $deleteProductQuery = "DELETE FROM product WHERE id = '$productId'";
        $this->connect()->query($deleteProductQuery);
    }
    public function getAllProductTypes() {
        $sql = "SELECT * FROM product_type";
        $result = $this->connect()->query($sql);
        $productTypes = [];
        while ($row = $this->connect()->fetchRow($result)) {
            $productTypes[] = $row;
        }
        return $productTypes;
    }
    public function getOptionsForType($productType) {
        $productType = ($productType);

        $sql = "SELECT options.ID, options.Name 
                FROM product_type_s_o
                INNER JOIN options ON product_type_s_o.Options = options.ID
                WHERE product_type_s_o.Product_Type = $productType";

        $result = $this->connect()->query($sql);
        $options = [];
        while ($row = $this->connect()->fetchRow($result)) {
            $options[] = $row;
        }
        return $options;
    }


    function displaybytype($typeid = null) {
    
        if ($typeid !== null) {
            $query = "SELECT * FROM product WHERE Product_Type = '$typeid'";
        } else {
            $query = "SELECT * FROM product";
        }

        $categoryResult = $this->connect()->query($query);

       
        if (!$categoryResult) {
            die("Error in SQL query: " . mysqli_error($this->connect()));
        }

       
        $products = [];
        while ($row = mysqli_fetch_assoc($categoryResult)) {
            $products[] = $row;
        }

        return $products;
    }


     // Setters
     public function setProductName($productName) {
        $this->productName = $this->real_escape_string($productName);
    }

    public function setDescription($description) {
        $this->description = $this->real_escape_string($description);
    }

    public function setProductPicture($productPicture) {
        $this->productPicture = implode(',', $productPicture);
    }

    public function setPrice($price) {
        $this->price = $this->real_escape_string($price);
    }

    public function setProductType($productType) {
        $this->productType = $this->real_escape_string($productType);
    }

    public function setOptionsValues($optionsValues) {
        $this->optionsValues = $optionsValues;
    }

    // Getters
    public function getProductName() {
        return $this->productName;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getProductPicture() {
        return $this->productPicture;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getProductType() {
        return $this->productType;
    }

    public function getOptionsValues() {
        return $this->optionsValues;
    }
}
?>