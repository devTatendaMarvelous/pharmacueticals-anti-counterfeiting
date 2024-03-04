@extends('layouts.app')
@section('content')

     <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">
                        <div class="category-menu ">
                            <h3>Filter By Category</h3>
                            <ul>
                                @forelse ($categories as $Category )
                                     <li>
                                        <div class="category-list mb-2">
                                            <h5>
                                                <a href="{{ route('category',[$Category->id]) }}">{{ $Category->category_name }}</a>
                                            </h5>
                                        </div>
                                    </li>
                                @empty
                                    <h4>No Categories Found</h4>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-9 col-xl-8">
                    <div class="title title-flex">
                        <div>
                            <h2>Top Save Today</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                            <p>Don't miss this opportunity at a special discount just for this week.</p>
                        </div>
                    </div>

                    <div class="section-b-space">
                        <div class="product-border border-row overflow-hidden">
                            <div class="product-box-slider no-arrow p-3">
                                @forelse ($products as $product )
                                <div>
                                    <div class="row m-0 p-1">
                                        <div class="col-12 px-0">
                                            <div class="product-box card ">
                                                <div class="product-image">
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('storage/'.$product->product->product_photo) }}" class="img-fluid blur-up lazyload" alt="{{ $product->product->product_name }}">
                                                    </a>
                                                </div>
                                                <div class="product-detail text-center">
                                                    <a href="javascript:void(0)">
                                                        <h6 class="name">{{ $product->product->product_name }}</h6>
                                                    </a>
                                                    <h5 class="sold text-content">
                                                        <span class="theme-color price">${{$product->selling_price }}</span>
                                                    </h5>
                                                    <div class="product-rating mt-sm-2 mt-1">
                                                        <h6 class="theme-color text-center">Order Quantity</h6>
                                                    </div>
                                                    <div >
                                                        <form action="{{ route('carts.store',[$product->id]) }}" method="POST" class="d-flex justify-content-center row">
                                                                    @csrf
                                                            <input class="form-control mb-3 col-12 " type="number"
                                                                            name="quantity" value="1">
                                                            <input type="submit" class="btn btn-success text-white col-12" style="background: #1C5B77;" value="Add To Cart"/>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                     <h4>No Products Found</h4>
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
