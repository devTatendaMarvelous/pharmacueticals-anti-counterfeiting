@extends('layouts.app')
@section('content')

    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
                                    @forelse ($items as $item )
                                        <tr class="product-box-contain">
                                            <td class="product-detail">
                                                <div class="product border-0">
                                                    <a href="product-left-thumbnail.html" class="product-image">
                                                        <img src="{{ asset('storage/'.$item->product_photo)  }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                    <div class="product-detail">
                                                        <ul>
                                                            <li class="name">
                                                                <a href="#">{{ $item->product_name }}</a>
                                                            </li>
                                                            <li class="name">
                                                                <a href="#"><strong>Sold By: </strong> {{ $item->name }}</a> <br>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="price">
                                                <h4 class="table-title text-content">Price</h4>
                                                <h5>${{ $item->selling_price }}</h5>

                                            </td>

                                            <td class="quantity">
                                                <h4 class="table-title text-content">Qty</h4>
                                                <div class="quantity-price">
                                                    {{$item->quantity}}
                                                </div>
                                            </td>

                                            <td class="subtotal">
                                                <h4 class="table-title text-content">Total</h4>
                                                <h5>${{ $item->selling_price * $item->quantity }}</h5>
                                            </td>

                                             <td class="save-remove">
                                                <h4 class="table-title text-content">Action</h4>

                                                <a class=" btn " href="{{route('carts.remove',[$item->id])}}" style="background: #FF5252; text-decoration: none;color:#fff; margin-left: -40px;margin-right: 40px">Remove</a>
                                            </td>
                                        </tr>
                                    @empty
                                        No Items
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            <h3>Cart Total</h3>
                        </div>

                        <div class="summery-contain">
                            {{-- <div class="coupon-cart">
                                <h6 class="text-content mb-2">Coupon Apply</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Enter Coupon Code Here...">
                                    <button class="btn-apply">Apply</button>
                                </div>
                            </div> --}}
                            <ul>
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price">${{ $total }}</h4>
                                </li>
                                <li class="align-items-start">
                                    <h4>Delivery</h4>
                                    <h4 class="price text-end">${{ $total*config('settings.tax') }}</h4>
                                </li>
                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Total (USD)</h4>
                                <h4 class="price theme-color">${{  $total*(1+config('settings.tax')) }}</h4>
                            </li>
                        </ul>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <button onclick="location.href = '{{ route('carts.checkout',[$cart_id,$total*(1+config('settings.tax')) ]) }}';"
                                        class="btn btn-animation proceed-btn fw-bold theme-bg-color">Proceed To Checkout</button>
                                </li>

                                <li>
                                    <button onclick="location.href = '/';"
                                        class="btn btn-light shopping-button text-dark">
                                        <i class="fa-solid fa-arrow-left-long"></i>Return To Shopping</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
@endsection
