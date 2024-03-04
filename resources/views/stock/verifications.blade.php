<x-dashboard>
            <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="title-header option-title d-sm-flex d-block">
                                        <h5>Product Verification Requests </h5>
                                    </div>
                                    <div>
                                        <div class="table-responsive">
                                            <table class="table all-package theme-table table-product" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Product Image</th>
                                                        <th>Product Name</th>
                                                        <th>Category</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                        <th>Action On Request</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ( $requests as $req )
                                                        <tr>
                                                            <td>
                                                                <div class="table-image">
                                                                    <img src="{{ asset('storage/'.$req->stock->product->product_photo) }}" class="img-fluid"
                                                                        alt="">
                                                                </div>
                                                            </td>
                                                            <td>{{ $req->stock->product->product_name }}</td>
                                                            <td>{{ $req->stock->product->category->category_name }}</td>
                                                            <td class="td-price">${{ $req->stock->product->selling_price }}</td>
                                                            <td>
                                                                <p class="
                                                            @if ($req->stock->product_status==='Low')
                                                                status-danger
                                                            @elseif ($req->stock->product_status==='Reorder')
                                                                status-warning
                                                            @elseif ($req->stock->product_status==='Good')
                                                                status-close
                                                            @endif
                                                            ">
                                                                    <span>Stock level: {{ $req->stock->product_status }}</span>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <ul>
                                                                    @if( $req->status==='pending' )
                                                                        <li>
                                                                            <a href="javascript:void(0)" class="btn btn-primary text-white"  data-bs-toggle="modal" data-bs-target="#approveVerification">
                                                                                Approve
                                                                            </a>
                                                                        </li>
                                                                            <li>

                                                                                <a href="javascript:void(0)" class="btn btn-danger text-white"  data-bs-toggle="modal" data-bs-target="#rejectVerification">
                                                                                    Reject
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal Start -->
                                                        <div class="modal fade" id="rejectVerification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                             aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Reject Verification For {{  $req->stock->product->product_name  }}</h5>
                                                                        <p>Are you sure you want to reject?</p>
                                                                        <p>If so enter the reason for rejection below</p>

                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        <div class="button-box ">

                                                                            <form action="{{ route('verifications.reject',[$req->id]) }}" method="POST" >
                                                                                @csrf
                                                                                <textarea class="form-control d-flex" style="width: 100%;" placeholder="Rejection notes" name="notes"></textarea>
                                                                                <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                                                                                <button type="submit" class="btn  btn--yes btn-primary">Reject</button>
                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal End -->

                                                        <!-- Modal Start -->
                                                        <div class="modal fade" id="approveVerification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                             aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Reject Verification For {{  $req->stock->product->product_name  }}</h5>
                                                                        <p>Are you sure you want to approve?</p>


                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        <div class="button-box ">

                                                                            <form action="{{ route('verifications.approve',[$req->id]) }}" method="POST"  >
                                                                                @csrf


                                                                                <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                                                                                <button type="submit" class="btn  btn--yes btn-primary">Yes Approve</button>
                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal End -->

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

    <script>
        const verify=(serial_number)=>{
            console.log(serial_number)
            //TODO send request to block chain to create a record for the and generate the verification token to be returned and passed as part of the request to change the product verification status
        }
    </script>
</x-dashboard>
