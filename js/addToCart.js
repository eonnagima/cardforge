document.querySelector("#add-to-cart").addEventListener('click', function(e) {
    e.preventDefault();

    // Retrieve the product alias from the button's dataset
    var productAlias = this.dataset.productAlias;
    
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Configure the AJAX request
    xhr.open('POST', 'ajax/add_to_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    
    // Define a function to handle the server response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    // Parse the JSON response from the server
                    var response = JSON.parse(xhr.responseText);
                    // Update the cart count in the header
                    document.getElementById('cart-count').innerText = response.cartCount;
                    // Log debugging information
                    console.log('Debug info:', response.debug);
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    console.error('Response text:', xhr.responseText);
                }
            } else {
                console.error('Request failed with status:', xhr.status);
                console.error('Response text:', xhr.responseText);
            }
        }
    };
    
    // Send the AJAX request with the product alias in JSON format
    xhr.send(JSON.stringify({ product_alias: productAlias }));

    document.querySelector("#go-to-cart").classList.toggle('hidden');
    document.querySelector("#add-to-cart").classList.toggle('hidden');
});