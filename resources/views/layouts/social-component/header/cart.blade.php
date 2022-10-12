<div class="dropdown dropdown-cart">
    <button class="dropdown-toggle text-white" type="button" data-toggle="dropdown" aria-expanded="false">
        <i class="icofont-shopping-cart"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <div class="item-heading">
            <h6 class="heading-title">Shopping Cart: <span id="count-cart">-</span></h6>
        </div>
        <div class="item-body" id="response-cart">

        </div>
        <div class="item-footer">
            <a href="{{ route('social.cart') }}" class="view-btn">View All Product</a>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $.ajax({
            type: "GET",
            url: @json(url('api/cart/'.Auth::id())),
            success: function (response) {
                let data = response.data;
                $('#count-cart').html(data.length);
            }
        });
    </script>
@endpush
