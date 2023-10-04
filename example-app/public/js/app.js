const addToCartButton = document.querySelector('.add-to-cart');

// Get the cart count element
const cartCountElement = document.getElementById('cart-count');

// Initialize the cart count
let cartCount = 0;

// Add a click event listener to the button
addToCartButton.addEventListener('click', function(event) {
    event.preventDefault();

    // You can send an AJAX request to add the item to the cart here
    // For demonstration purposes, we'll just increase the count by 1
    cartCount++;

    // Update the cart count display
    cartCountElement.textContent = cartCount;
});