<?php
  require_once(__ROOT__ . "views/View.php");
?>
<?php
Class ProductView extends View
{function addProductForm()
    {
        $form = '
        <form name="productForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="ProductName">Product Name:</label>
            <input type="text" name="ProductName" id="ProductName" required>
            <span id="nameError" class="error"></span><br>
    
            <label for="ProductPictures">Product Pictures:</label>
            <input type="file" name="ProductPicture[]" multiple="multiple" accept=".jpg, .jpeg, .png, .gif" required enctype="multipart/form-data">
            <span id="pictureError" class="error"></span><br>
    
            <label for="Description">Description:</label>
            <textarea name="Description" id="Description" required></textarea>
            <span id="descriptionError" class="error"></span><br>
    
            <label for="Weight">Weight:</label>
            <input type="number" name="Weight" id="Weight" required>
            <span id="weightError" class="error"></span><br>
    
            <label for="Size">Size:</label>
            <input type="number" name="Size" id="Size">
            <span id="sizeError" class="error"></span><br>
    
            <label for="Price">Price:</label>
            <input type="number" name="Price" id="Price" required>
            <span id="priceError" class="error"></span><br>
    
            <label for="Availability">Availability:</label>
            <select name="Availability">
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select><br>';
            $con = mysqli_connect("172.232.216.8", "root", "Omarsalah123o", "Jewelry_project");
        // Fetch and display metal names and IDs
        $metalQuery = "SELECT MetalID, MetalName FROM Metal";
        $metalResult = mysqli_query($con, $metalQuery);
    
        if ($metalResult) {
            $form .= '<select name="MetalID">';
            while ($metal = mysqli_fetch_assoc($metalResult)) {
                $form .= "<option value='{$metal['MetalID']}'>{$metal['MetalName']}</option>";
            }
            $form .= '</select>';
        }
    
        $form .= '<label for="CategoryID">Category:</label>
        <select name="CategoryID" id="CategoryID">';
    
        // Fetch and display category names and IDs
         $categoryQuery = "SELECT CategoryID, CategoryName FROM Categories";
    $categoryResult = mysqli_query($con, $categoryQuery);

    if ($categoryResult) {
        while ($category = mysqli_fetch_assoc($categoryResult)) {

            $form .= "<option value='{$category['CategoryID']}'>{$category['CategoryName']}</option>";
        }
    }
        $form .= '</select><br>
            <input type="submit" name="submit" value="Submit" style="background-color: #0056b3; color: #fff; padding: 10px 20px; border: none; cursor: pointer; position: relative; top: 50%; left: 40%;">
        </form>
        </div>';
    
        return $form;
    }
    
public function output() {
    $products = $this->model->getProducts();

    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Product Management</title>
        <!-- Include any necessary styles or scripts here -->
    </head>
    <body>
        <div class="container">
            <h2>Product Management</h2>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Product Pictures</th>
                    <th>Description</th>
                    <th>Weight</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>MetalID</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>';

    if ($products !== false) {
        foreach ($products as $product) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product['ProductName']) . '</td>';

            $productPictures = explode(',', $product['ProductPicture']);
            if (!empty($productPictures[0])) {
                $imageSrc = "../uploads/" . htmlspecialchars($productPictures[0]);
            } else {
                $imageSrc = "uploads/default.jpg";
            }

            echo '<td><img src="' . $imageSrc . '" width="80" height="80"></td>';
            echo '<td>' . htmlspecialchars($product['Description']) . '</td>';
            echo '<td>' . htmlspecialchars($product['Weight']) . '</td>';
            echo '<td>' . htmlspecialchars($product['Size']) . '</td>';
            echo '<td>' . htmlspecialchars($product['Price']) . '</td>';
            echo '<td>' . htmlspecialchars($product['Availability']) . '</td>';

            // Assuming you have a method to get MetalName and CategoryName
            $metalName = $this->model->getMetalName($product['MetalID']);
            $categoryName = $this->model->getCategoryName($product['CategoryID']);

            echo '<td>' . htmlspecialchars($metalName) . '</td>';
            echo '<td>' . htmlspecialchars($categoryName) . '</td>';
            
            echo '<td>';
            echo '<a class="edit-button" href="editproduct.php?edit_id=' . htmlspecialchars($product['ProductID']) . '">Edit</a> ';

            // Form for delete using GET
            echo '<form method="GET" action="crud.php" onsubmit="return confirm(\'Are you sure you want to delete this product?\');">';
            echo '<input type="hidden" name="action" value="delete_product">';
            echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($product['ProductID']) . '">';
            echo '<button class="delete" type="submit">Delete</button>';
            echo '</form>';
            

            echo '</td>';

            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="10">No products found.</td></tr>';
    }

    echo '</table>';
    echo '<a class="add-product-button" href="addproduct.php">Add Product</a>';
    echo '</div></body></html>';
}
function editform($productId) {
    $product = $this->model->getProductID($productId);

    if ($product !== null) {
        $form = '
        <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="hidden" name="ProductID" value="' . $product['ProductID'] . '">
            <label for="ProductName">Product Name:</label>
            <input type="text" name="ProductName" id="ProductName" value="' . $product['ProductName'] . '" required>
            <span id="nameError" class="error"></span><br>

            <label for="ProductPicture">Product Pictures:</label>
            <input type="file" name="ProductPicture[]" multiple="multiple" accept=".jpg, .jpeg, .png, .gif"><br>
            <span id="pictureError" class="error"></span><br>';

        $productPictures = explode(',', $product['ProductPicture']);
        foreach ($productPictures as $picture) {
            $form .= '<img src="../uploads/' . $picture . '" width="80" height="80">';
        }

        $form .= '
            <label for="Description">Description:</label>
            <textarea name="Description" id="Description" required>' . $product['Description'] . '</textarea>
            <span id="descriptionError" class="error"></span><br>

            <label for="Weight">Weight:</label>
            <input type="number" name="Weight" id="Weight" value="' . $product['Weight'] . '" required>
            <span id="weightError" class="error"></span><br>

            <label for="Size">Size:</label>
            <input type="number" name="Size" id="Size" value="' . $product['Size'] . '">
            <span id="sizeError" class="error"></span><br>

            <label for="Price">Price:</label>
            <input type="number" name="Price" id="Price" value="' . $product['Price'] . '" required>
            <span id="priceError" class="error"></span><br>

            <label for="Availability">Availability:</label>
            <select name="Availability">
                <option value="1" ' . ($product['Availability'] == 1 ? 'selected' : '') . '>Available</option>
                <option value="0" ' . ($product['Availability'] == 0 ? 'selected' : '') . '>Not Available</option>
            </select><br>';
        
        // Database connection
        $con = mysqli_connect("172.232.216.8", "root", "Omarsalah123o", "Jewelry_project");

        // Fetch and display metal names and IDs
        $metalQuery = "SELECT MetalID, MetalName FROM Metal";
        $metalResult = mysqli_query($con, $metalQuery);

        if ($metalResult) {
            $form .= '<label for="MetalID">Metal:</label>
            <select name="MetalID">';
            while ($metal = mysqli_fetch_assoc($metalResult)) {
                $form .= "<option value='{$metal['MetalID']}'>{$metal['MetalName']}</option>";
            }
            $form .= '</select><br>';
        }

        $form .= '<label for="CategoryID">Category:</label>
            <select name="CategoryID" id="CategoryID">';

        // Fetch and display category names and IDs
        $categoryQuery = "SELECT CategoryID, CategoryName FROM Categories";
        $categoryResult = mysqli_query($con, $categoryQuery);

        if ($categoryResult) {
            while ($category = mysqli_fetch_assoc($categoryResult)) {
                $selected = ($product && $category['CategoryID'] == $product['CategoryID']) ? 'selected' : '';
                $form .= "<option value='{$category['CategoryID']}' $selected>{$category['CategoryName']}</option>";
            }
        }

        $form .= '</select><br>
            <input type="submit" name="submit" value="Update" style="background-color: #0056b3; color: #fff; padding: 10px 20px; border: none; cursor: pointer; position: relative; top: 50%; left: 40%;">
        </form>';
    } else {
        // Handle the case where $product is null (e.g., product not found)
        $form = 'Product not found.';
    }

    return $form;
}




}
?>
