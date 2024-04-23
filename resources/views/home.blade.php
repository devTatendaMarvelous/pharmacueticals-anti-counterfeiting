<x-dashboard>

    <div class="container-fluid">
        <div class="row">
            <!-- chart caard section start -->
            @if(auth()->user()->type!='Manufacturer')
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Revenue</span>
                                <h4 class="mb-0 counter">${{ $revenue }}
                                    <span class="badge badge-light-primary grow">
                                        <i data-feather="trending-up"></i>8.5%</span>
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-2-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Orders</span>
                                <h4 class="mb-0 counter">{{ $orders }}
                                    <span class="badge badge-light-danger grow">
                                        <i data-feather="trending-down"></i>8.5%</span>
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-shopping-bag-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Selling Products</span>
                                <h4 class="mb-0 counter">{{ $products }}
                                    <a href="add-new-product.html" class="badge badge-light-secondary grow">
                                        ADD NEW</a>
                                </h4>
                            </div>

                            <div class="align-self-center text-center">
                                <i class="ri-chat-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Customers</span>
                                <h4 class="mb-0 counter">{{ $clients }}
                                    <span class="badge badge-light-success grow">
                                        <i data-feather="trending-down"></i>8.5%</span>
                                </h4>
                            </div>

                            <div class="align-self-center text-center">
                                <i class="ri-user-add-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- chart card section End -->
            @if(auth()->user()->type!='Manufacturer')
            <!-- Recent orders start-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Recent Orders </h5>
                                {{-- <a href="#" class="btn btn-solid">Download all orders</a> --}}
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package order-table theme-table" id="table_id">
                                        <thead>
                                            <tr>
                                                {{-- <th>Client</th> --}}
                                                <th>Order Code</th>
                                                <th>Date</th>
                                                <th>Payment Method</th>
                                                <th>Delivery Status</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($order_list as $order)
                                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                                    {{-- <td>
                                        {{$order->name}}
                                    </td> --}}

                                                    <td> {{ $order->order_number }}</td>

                                                    <td>{{ $order->delivery_date }}</td>

                                                    <td>{{ $order->currency . '' . $order->payment_method }}</td>

                                                    <td class="order-success">
                                                        <span>{{ $order->status }}</span>
                                                    </td>

                                                    <td>${{ $order->order_amount }}</td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif
        </div>
    </div>
    <!-- Container-fluid Ends-->

</x-dashboard>
