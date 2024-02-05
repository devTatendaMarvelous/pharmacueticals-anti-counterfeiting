<x-dashboard>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Order List</h5>
                    {{-- <a href="#" class="btn btn-solid">Download all orders</a> --}}
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package order-table theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Order Code</th>
                                    <th>Date</th>
                                    <th>Payment Method</th>
                                    <th>Delivery Status</th>
                                    <th>Amount</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($orders as $order )

                                <tr data-bs-toggle="offcanvas" href="#order-details">
                                    <td>
                                        {{$order->name}}
                                    </td>

                                    <td> {{$order->order_number}}</td>

                                    <td>{{ $order->delivery_date }}</td>

                                    <td>{{$order->currency.''. $order->payment_method }}</td>

                                    <td class="order-success">
                                        <span>{{ $order->status }}</span>
                                    </td>

                                    <td>${{ $order->order_amount }}</td>

                                    <td>
                                        <ul>
                                            <li>


                                                <a href="{{route('orders.show',[$order->id])}}">
                                                    <i class="ri-eye-line"></i>
                                            </li>


                                        </ul>
                                    </td>
                                </tr>
                                @empty
                                <center>
                                    <h3>No Orders for now</h3>
                                </center>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-dashboard>
