<script>
    function addToCart(productData) {
        // Find the item in the cart data
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        let existingItem = cartItems.find(item => item.id === productData.id);

        if (existingItem) {
            existingItem.quantity++;
        } else {
            cartItems.push({
                ...productData,
                quantity: 1
            });
        }

        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartList();
        updateCheckoutCartList();
        updateCartTotal();
    }

    function updateCheckoutCartList() {
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        let tableBody = $('.shoping-cart-table > table > tbody');
        tableBody.empty();

        if (cartItems.length === 0) {
            $('.shoping-cart-total').hide();

            tableBody.append('<td class="mini-cart-item">Your cart is empty.</td>');
        } else {
            $('.shoping-cart-total').show();

            cartItems.forEach(function(item) {
                let cartRow = `
                    <tr>
                        <td class="cart-product-remove" data-product-id="${item.id}"><i class="fas fa-times-circle"></i></td>
                        <td class="cart-product-image">
                            <a href="#"><img src="${item.image ? item.image : App.baseUrl+'/assets/img/no-product-image.png'}" alt="Product Image"></a>
                        </td>
                        <td class="cart-product-info">
                            <h4><a href="#">${item.name}</a></h4>
                        </td>
                        <td class="cart-product-price">৳${item.price.toFixed(2)}</td>
                        <td class="cart-product-quantity">
                            <div class="cart-plus-minus">
                                <div class="dec qtybutton quantity-btn decrease" data-product-id="${item.id}">-</div>
                                <input type="text" value="${item.quantity}" name="qtybutton" class="cart-plus-minus-box" readonly>
                                <div class="inc qtybutton quantity-btn increase" data-product-id="${item.id}">+</div>
                            </div>
                        </td>
                        <td class="cart-product-subtotal">৳${(item.price * item.quantity).toFixed(2)}</td>
                    </tr>
                `;
                tableBody.append(cartRow);
            });
        }
    }

    function updateCartList() {
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        $('.mini-cart-product-area').empty();
        if (cartItems.length === 0) {
            $('.mini-cart-product-area').append('<div class="mini-cart-item">Your cart is empty.</div>');
            $('.mini-cart-footer').hide();
        } else {
            $('.mini-cart-footer').show();

            cartItems.forEach(function(item) {
                let cartItem = `
                    <div class="mini-cart-item d-flex align-items-center border-bottom mb-3">
                        <div class="mini-cart-img me-3">
                            <a href="#">
                            <img src="${item.image ? item.image : App.baseUrl+'/assets/img/no-product-image.png'}" alt="Image" class="img-fluid rounded-start" style="width: 80px; height: 80px;">
                            </a>
                            <span class="mini-cart-item-delete" data-product-id="${item.id}">
                            <i class="fas fa-times-circle"></i>
                            </span>
                        </div>
                        <div class="mini-cart-info flex-grow-1">
                            <h6><a href="#">${item.name}</a></h6>
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="quantity-wrapper d-flex align-items-center">
                                <button class="quantity-btn decrease rounded-0" data-product-id="${item.id}">-</button>
                                <input type="number" class="cart-item-quantity text-center border rounded-0 w-75" value="${item.quantity}" min="1" data-product-id="${item.id}" style="width: 30px;" disabled>
                                <button class="quantity-btn increase rounded-0" data-product-id="${item.id}">&plus;</button>
                            </div>
                            <span class="text-muted">৳${item.price}</span>
                            </div>
                        </div>
                    </div>

                `;
                $('.mini-cart-product-area').append(cartItem);
            });
        }
    }

    // update cart total
    function updateCartTotal() {
        let totalAmount = 0;
        let totalItems = 0;
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

        cartItems.forEach(function(item) {
            totalAmount += item.quantity * item.price;
            totalItems += item.quantity;
        });

        $('.total-amount').text("৳" + totalAmount.toFixed(2));
        $('.my-cart-badge').text(totalItems); // Update cart badge
    }

    $(document).on('click', '.mini-cart-item-delete, .cart-product-remove', function() {
        let productId = $(this).data('product-id');

        // Find the item in the cart data
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        let updatedCartItems = cartItems.filter(item => item.id !== productId);

        localStorage.setItem('cartItems', JSON.stringify(updatedCartItems));
        updateCartList();
        updateCheckoutCartList();
        updateCartTotal();
    });

    $(document).on('click', '.quantity-btn.increase', function() {
        let productId = $(this).data('product-id');

        // Find the item in the cart data
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        let item = cartItems.find(item => item.id === productId);

        if (item) {
            item.quantity++;
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartList();
            updateCheckoutCartList();
            updateCartTotal();
        }
    });

    $(document).on('click', '.quantity-btn.decrease', function() {
        let productId = $(this).data('product-id');

        // Find the item in the cart data
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        let item = cartItems.find(item => item.id === productId);

        if (item && item.quantity > 1) {
            item.quantity--;
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartList();
            updateCheckoutCartList();
            updateCartTotal();
        }
    });

    $(document).on('click', '.add-to-cart-btn', function(event) {
        event.preventDefault();
        let productData = {
            id: $(this).data('product').id,
            name: $(this).data('product').name,
            image: $(this).data('product').image,
            price: $(this).data('product').price
        };

        addToCart(productData);
    });

    $(document).ready(function() {
        updateCartList();
        updateCartTotal();
        updateCheckoutCartList();
    });

    function processCheckout() {
        event.preventDefault();
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

        // Send data to the server by AJAX
        $.ajax({
            url: "{{ route('proccess.checkout') }}",
            type: 'POST',
            "data": {
                "_token": '{{ csrf_token() }}',
                cartItems: JSON.stringify(cartItems)
            },
            success: function(response) {
                window.location.href = response.redirect_url;
            },
            error: function(xhr, status, error) {}
        });
    }
</script>


@if(session()->get('clear_cart'))
    <script>
        localStorage.setItem('cartItems', []);
    </script>
@endif