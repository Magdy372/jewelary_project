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
        </select><br>

        <label for="CategoryID">Category:</label>
        <select name="CategoryID" id="CategoryID" required>
            <option value="">Select Category</option>
            <option value="1">Necklaces</option>
            <option value="2">Pendants</option>
            <option value="3">Rings</option>
            <option value="4">Bracelets</option>
            <option value="5">Earrings</option>
            <option value="6">Colored Stones</option>
            <option value="7">Anklets</option>
            <option value="8">Gold Bars</option>
            <option value="9">Gold Coins</option>
            <option value="10">Sets and metal 18k Gold</option>
        </select>
        <span id="categoryError" class="error"></span><br>

        <label for="MetalID">Metal:</label>
        <select name="MetalID" id="MetalID" required>
            <option value="">Select Metal</option>
            <option value="1">18k Gold</option>
            <option value="2">21k Gold</option>
            <option value="3">24k Gold</option>
            <option value="4">Yellow Gold</option>
            <option value="5">Rose Gold</option>
        </select>
        <span id="metalError" class="error"></span><br>

        <input type="submit" name="submit" value="Submit" style="background-color: #0056b3; color: #fff; padding: 10px 20px; border: none; cursor: pointer; position: relative; top: 50%; left: 40%;">
    </form>
    </div>';

    return $form;
}
}
?>
