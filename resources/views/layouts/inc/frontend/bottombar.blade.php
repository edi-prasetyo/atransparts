<!-- Bottom Navigation (mobile only) -->
<nav class="navbar fixed-bottom bg-white shadow border-top d-block d-sm-none">
    <div class="container-fluid d-flex justify-content-around text-center py-1">

        <a href="{{ url('/') }}" class="text-decoration-none text-muted">
            <iconify-icon icon="mingcute:home-3-line" width="24" height="24"></iconify-icon><br>
            <small>Home</small>
        </a>

        <a href="{{ url('/products') }}" class="text-decoration-none text-muted">
            <iconify-icon icon="mingcute:shopping-bag-1-line" width="24" height="24"></iconify-icon><br>
            <small>Produk</small>
        </a>

        <a href="{{ url('/warranty') }}" class="text-decoration-none text-muted">
            <iconify-icon icon="mingcute:archive-line" width="24" height="24"></iconify-icon><br>
            <small>Garansi</small>
        </a>

        <a href="https://wa.me/{{ $option_nav->whatsapp }}" class="text-decoration-none text-muted">
            <iconify-icon icon="mingcute:phone-line" width="24" height="24"></iconify-icon><br>
            <small>Contact</small>
        </a>

    </div>
</nav>
