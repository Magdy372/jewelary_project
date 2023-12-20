function searchProducts() {
    var searchTerm = document.getElementById('searchTerm').value;

    $.ajax({
        type: 'POST',
        url: 'search.php',
        data: { searchTerm: searchTerm },
        dataType: 'json',
        success: function(data) {
            var resultsDiv = document.getElementById('searchResults');
            resultsDiv.innerHTML = '';

            for (var i = 0; i < data.length; i++) {
                var productName = data[i].ProductName;
                var productPicture = '../../uploads/' + data[i].ProductPicture;

                // Display the results
                resultsDiv.innerHTML += '<p><strong>' + productName + '</strong><br><img src="' + productPicture + '" alt="Product Picture"></p>';
            }
        }})}
