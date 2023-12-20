<?php
// Include necessary files and set up your database connection
$con = mysqli_connect("172.232.216.8", "root", "Omarsalah123o", "Jewelry_project");

// Get the search term from the AJAX request
$searchTerm = mysqli_real_escape_string($con, $_GET['searchTerm']);

// Perform the search in your products table
// Replace with your actual database and table names
$sql = "SELECT * FROM product WHERE ProductName LIKE '%$searchTerm%'";
$result = mysqli_query($con, $sql);

// Display the search results
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="search-results-container">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="search-result-item">';
            echo '<a href="product-details.php?details_id=' . $row['id'] . '">';
            echo '<img src="../../uploads/' . $row['ProductPicture'] . '" alt="Product Image" class="result-image">';
            echo '</a>';
            echo '<p class="result-name">' . $row['ProductName'] . '</p>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p class="no-results">No results found.</p>';
    }
} else {
    // Handle query error
    echo '<p class="error-message">Error in the query: ' . mysqli_error($con) . '</p>';
}

// ... (your existing PHP code)
?>
<style>
    .search-results-container {
        display: flex;
        flex-wrap: wrap;
        max-height: 100px;
        overflow-y: auto;
        border-top: 1px solid #ddd;
    }

    .search-result-item {
        display: flex;
        text-align: left;
        margin-right: 10px;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 500px; /* Adjust the width as needed */
        height: 100px; /* Adjust the height as needed */
        transition: transform 0.2s;
    }

    .search-result-item:hover {
        transform: scale(1.05);
    }

    .result-image {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }

    .result-name {
        flex-grow: 1;
        font-weight: bold;
    }

    .no-results,
    .error-message {
        text-align: center;
        margin: 20px;
        padding: 10px;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
    }
</style>
