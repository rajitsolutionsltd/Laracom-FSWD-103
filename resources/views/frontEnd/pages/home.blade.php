@extends('frontEnd.layouts.masters')

@section('content')
    <!-- SLIDER AREA START (slider-3) -->
    @include('frontEnd.inc.slider')
    <!-- SLIDER AREA END -->

    <!-- PRODUCT TAB AREA START (product-item-3) -->
    <div class="ltn__product-tab-area ltn__product-gutter pt-85 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">Our Products</h1>
                    </div>
                    <div class="ltn__tab-menu ltn__tab-menu-2 ltn__tab-menu-top-right-- text-uppercase text-center">
                        <div class="nav">
                            @foreach ($categories as $category)
                                <a class="{{ $loop->index == 0 ? 'active show' : '' }}" data-bs-toggle="tab"
                                    href="#categoryTab-{{ $category->id }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-content">
                        @foreach ($categories as $category)
                            <div class="tab-pane fade {{ $loop->index == 0 ? 'active show' : '' }}"
                                id="categoryTab-{{ $category->id }}">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                        @foreach ($category->products as $product)
                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                                    <div class="product-img">
                                                        <a href="product-details.html"><img
                                                                src="{{ asset($product->image ? Storage::url($product->image) : 'assets/img/no-product-image.png') }}"
                                                                alt="#" style="height: 250px;"></a>
                                                        <div class="product-hover-action">
                                                            <ul>
                                                                <li>
                                                                    <a title="Quick View"
                                                                        onclick="quickProductView({{ $product->id }})">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="product-item">
                                                                    <a title="Add to Cart" class="add-to-cart-btn"
                                                                        data-product="{{ $product }}">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <h2 class="product-title"><a href="product-details.html">
                                                                {{ $product->name }}
                                                            </a></h2>
                                                        <div class="product-price">
                                                            <span>{{ $product->price }} .Tk</span>
                                                        </div>
                                                        <div class="product-in-stock">
                                                            <strong class="text-danger me-2">In
                                                                Stock:</strong><span>{{ $product->stock_quantity }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT TAB AREA END -->
@endsection

@push('scripts')
    <script>
        function quickProductView(productId) {
            $.ajax({
                "url": "{{ url('quick-product-view') }}/" + productId,
                "method": "POST",
                "dataType": 'json',
                "data": {
                    "_token": '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#load_modal').html(response.html);
                    $('#quick_view_modal').modal('show');
                },
                error: function(error) {
                    console.log(error)
                }

            });
        }
    </script>

    @include('frontEnd.pages.particles.cart_script')
@endpush
