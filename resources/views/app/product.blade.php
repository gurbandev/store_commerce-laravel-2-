<div class="position-relative bg-white border rounded">
    <div class="row g-0">
        <div class="col-7">
            <img src="{{  $product->image ? Storage::url('products/sm/'.$product->image) : asset('img/sm/product.jpg') }}"
                 alt="{{ $product->getName() }}" class="img-fluid rounded-start">
        </div>
        <div class="col p-2">
            <div class="d-flex flex-column h-100">
                <div class="fw-semibold mb-auto">
                    <a href="{{ route('products.show', $product->slug) }}" class="link-dark text-decoration-none stretched-link">
                        {{ $product->getName() }}
                    </a>
                </div>
                @if($product->isDiscount())
                    <div class="text-secondary">
                        {{ number_format($product->price, 2, '.', ' ') }}
                        <small>TMT</small>
                    </div>
                    <div class="fs-5 fw-semibold text-danger">
                        {{ number_format($product->getPrice(), 2, '.', ' ') }}
                        <small>TMT</small>
                    </div>
                @else
                    <div class="fs-5 fw-semibold text-primary">
                        {{ number_format($product->price, 2, '.', ' ') }}
                        <small>TMT</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>