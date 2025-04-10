document.addEventListener("DOMContentLoaded", function() {
    const clearCartButton = document.querySelector('.btn-danger');
    const cartItemsContainer = document.querySelector('.cart-items');

    // Példa termékek, amiket a kosárba helyezünk
    const products = ['Termék 1', 'Termék 2', 'Termék 3'];

    // Kosárba helyezés funkció
    function addToCart(product) {
        const item = document.createElement('div');
        item.classList.add('cart-item');
        item.textContent = product;
        cartItemsContainer.appendChild(item);
    }

    // Példa: termékek hozzáadása a kosárhoz
    products.forEach(product => {
        addToCart(product);
    });

    clearCartButton.addEventListener('click', function() {
        const cartItems = document.querySelectorAll('.cart-item');
        cartItems.forEach(item => {
            item.remove(); // Törli a kosár elemeit
        });
    });
});