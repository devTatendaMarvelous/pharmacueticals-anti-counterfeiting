<x-dashboard>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="title-header title-header-block package-card">
                        <div>
                            <h5>Order {{$order->order_number}}</h5>
                        </div>
                        <div class="card-order-section">
                            <ul>
                                <li>{{ $carbon::parse($order->updated_at)->format('d M Y ') }}
                                </li>
                                <li>{{count($products)}} item{{count($products)>1? 's':''}}</li>
                                <li>Total ${{$order->order_amount}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-inner cart-section order-details-table">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="table-responsive table-details">
                                    <table class="table cart-table table-borderless stripe">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th colspan="2">Order Items</th>
                                            <th class="text-end" colspan="2">

                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @forelse($products as $product)
                                            <tr class="table-order">
                                                <td>
                                                        <img src="{{asset('storage/'.$product->product_photo)}}"
                                                             class="img-fluid blur-up lazyload" alt="" style="max-width: 70px;max-font-size: 70px">

                                                </td>
                                                <td>
                                                    <p>Product Name</p>
                                                    <h5>{{$product->product_name}}</h5>
                                                </td>
                                                <td>
                                                    <p>Sold by</p>
                                                    <h5>{{$product->name}}</h5>
                                                </td>


                                                <td>
                                                    <p>Quantity</p>
                                                    <h5>{{$product->quantity}}</h5>
                                                </td>
                                                <td>
                                                    <p>Price</p>
                                                    <h5>${{$product->selling_price}}</h5>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>


                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- section end -->
                </div>
            </div>
        </div>
    </div>

</x-dashboard>
