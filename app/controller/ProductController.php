<?php

require_once("Controller.php");
class ProductController extends Controller
{
    

   

    public function insertProduct($productName, $description, $ProductPictures, $price, $productType, $optionsValues)
    {
        $productName = $_REQUEST['productName'];
        $description = $_REQUEST['description'];
        $ProductPictures = $this->model->uploadProductPictures($_FILES); // Call the uploadProductPictures method
        $price = $_REQUEST['price'];
        $optionsValues = $_REQUEST['options'];
    
        if (isset($_SESSION["Type"])) {
            $productType = $_SESSION["Type"];
            $this->model->addProduct($productName, $description, $ProductPictures, $price, $productType, $optionsValues);
        } else {
            echo "Error: Product type not set.";
        }
    }
    
    
    public function updateProduct($productId,$productName, $description, $productPicture, $price,$optionsValues)
    {
       
        $productName = $_REQUEST['productName'];
        $description = $_REQUEST['description'];
        $ProductPictures = $this->model->uploadProductPictures($_FILES);
        $price = $_REQUEST['price'];
      
        $optionsValues = $_REQUEST['options'];
       $this->model->updateProduct($productId,$productName, $description, $productPicture, $price, $optionsValues);
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
    
}


?>




