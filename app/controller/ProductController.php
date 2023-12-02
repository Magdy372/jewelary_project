<?php

require_once(__ROOT__ . "controller/Controller.php");
class ProductController extends Controller
{
    

    public function getProductID($id)
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
    
    public function updateProduct($ProductID,$ProductName, $ProductPictures, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID)
    {
        $ProductID=$_REQUEST['ProductID'];
        $ProductName = $_REQUEST['ProductName'];
        $ProductPictures = $_FILES['ProductPicture']['name'];
       $Description = $_REQUEST['Description'];
       $Weight = $_REQUEST['Weight'];
       $Size = $_REQUEST['Size'];
       $Price = $_REQUEST['Price'];
       $Availability = $_REQUEST['Availability'];
       $CategoryID = $_REQUEST['CategoryID'];
       $MetalID = $_REQUEST['MetalID'];
       $this->model->editProduct($ProductID,$ProductName, $ProductPictures, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID);
    }
    
    public function displayProduct($id)
    {
        
        $this->model->getProductID($id);

      
    }
    public function displayAllProduct()
    {
        
        $this->model->getProducts();

      
    }


 
    public function deleteProduct($id)
    {
        $this->model->deleteProduct($id);
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
