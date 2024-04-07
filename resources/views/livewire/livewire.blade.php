<div>
    <!-- Display the cart count dynamically -->
    Cart Count: {{ $cartCount }}
</div>

<script>
    // Listen for cart count updates and update the displayed count
    window.addEventListener('cartCountUpdated', event => {
        document.getElementById('cartCount').innerText = event.detail.cartCount;
        // After updating the cart count in your Livewire component
$this->emit('cartCountUpdated', ['cartCount' => $this->cartCount]);

    });
</script>