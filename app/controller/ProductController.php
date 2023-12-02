<?php

require_once(__ROOT__ . "controller/Controller.php");
class ProductController extends Controller
{
    public function index()
    {
        
       
        $this->model->getProducts();

     
    }

    public function show($id)
    {
       
        
        $this->model->getProductID($id);

    }

   
    public function insertProduct()
    {
        $ProductName = $_REQUEST['ProductName'];
         $ProductPictures = $_FILES['ProductPicture']['name'];
        $Description = $_REQUEST['Description'];
        $Weight = $_REQUEST['Weight'];
        $Size = $_REQUEST['Size'];
        $Price = $_REQUEST['Price'];
        $Availability = $_REQUEST['Availability'];
        $CategoryID = $_REQUEST['CategoryID'];
        $MetalID = $_REQUEST['MetalID'];
        $this->model->addProduct($ProductName, $ProductPictures, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID);
    }
    
    public function updateProduct($id, $data)
    {
        $ProductID = (int)$_REQUEST['ProductID'];
        $ProductName = mysqli_real_escape_string($this->db->getConn(), $_REQUEST['ProductName']);
        $ProductPicture = mysqli_real_escape_string($this->db->getConn(), $_REQUEST['ProductPicture']);
        $Description = mysqli_real_escape_string($this->db->getConn(), $_REQUEST['Description']);
        $Weight = (float)$_REQUEST['Weight'];
        $Size = (float)$_REQUEST['Size'];
        $Price = (float)$_REQUEST['Price'];
        $Availability = (int)$_REQUEST['Availability'];
        $CategoryID = (int)$_REQUEST['CategoryID'];
        $MetalID = (int)$_REQUEST['MetalID'];
        $this->model->updateProduct($ProductID, $ProductName, $ProductPicture, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID);
    }
    
    public function displayProduct($id)
    {
        
        $this->model->getProductID($id);

      
    }
    public function displayAllProduct($id)
    {
        
        $this->model->getProducts($id);

      
    }


 
    public function deleteProduct($id)
    {
        // Example: Process deletion of a product
        $productModel = new Product();
        $result = $productModel->deleteProduct($id);

        if ($result) {
            // Product deleted successfully
            header("Location: /products"); // Redirect to product list page
            exit();
        } else {
            // Failed to delete product
            // You might want to handle the error and show a message to the user
        }
    }

public function displayAllCategories()
{
    
    $this->model->getAllCategories();

  
}
public function displayAllMetals()
{
    
    $this->model->getAllMetals();

  
}
}


?>
