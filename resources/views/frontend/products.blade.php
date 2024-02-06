@extends('layouts.app')
@section('content')
    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-12 col-xl-12">
                    <div class="title title-flex">
                        <div>
                            <h2>Available Products </h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="{{asset('assets/svg/leaf.svg')}}#leaf"></use>
                                </svg>
                            </span>
                            <p>Select A Branch  You Want To Buy From</p>
                        </div>
                    </div>
                    <div class="section-b-space">
                        <div class="product-border border-row overflow-hidden">
                            <div class="product-box-slider no-arrow">
                                @forelse ( $products as $product)
                                    <div>
                                        <div class="row m-0">
                                            <div class="col-12 px-0">
                                                <div class="product-box">
                                                    <div class="product-image">
                                                            <a href="product-left-thumbnail.html">
                                                                <img src="{{$product->product_photo? asset('storage/'.$product->product_photo):asset('assets/images/vegetable/product/3.png')}}"
                                                                    class="img-fluid blur-up lazyload" alt="">
                                                            </a>
                                                    </div>
                                                    <div class="product-detail">
                                                            <a href="product-left-thumbnail.html">
                                                                <h6 class="name">
                                                                    {{ $product->product_name }}
                                                                </h6>
                                                                <p class="name">{{ $product->product_description }}
                                                                </p>
                                                            </a>
                                                            <h5 class="sold text-content">
                                                                <span class="theme-color price">${{ $product->selling_price }}</span>
                                                            </h5>
                                                            <div class="add-to-cart-box">
                                                                <form action="{{ route('carts.store',[$product->id]) }}" method="POST">
                                                                    @csrf
                                                                     <input class="form-control mb-3 input-number qty-input" type="number"
                                                                                    name="quantity" value="1">
                                                                    <input type="submit" class="btn-primary" value="Add To Cart"/>
                                                                </form>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="title title-flex">
                                            <p>No Products At This Branch At The Moment</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection
