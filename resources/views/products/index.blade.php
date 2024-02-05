<x-dashboard>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Products List</h5>
                        <div class="d-inline-flex">
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                               data-bs-target="#addProduct"
                               class="btn btn-primary">
                                Add Product
                            </a>
                        </div>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)">import</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Export</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table all-package theme-table table-product" id="table_id">
                                <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Current Qty</th>
                                    <th>Price</th>
                                    <th>Verification Token</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ( $products as $product )
                                    <tr>
                                        <td>
                                            <div class="table-image">
                                                <img src="{{ asset('storage/'.$product->product_photo) }}"
                                                     class="img-fluid"
                                                     alt="">
                                            </div>
                                        </td>

                                        <td>{{ $product->product_name }}</td>

                                        <td>{{ $product->category_name }}</td>

                                        <td>{{ $product->quantity }}</td>

                                        <td class="td-price">${{ $product->selling_price }}</td>
                                        <td>{{ $product->verification_token }}</td>
                                        <td>
                                            <p class="
                                                            @if ($product->product_status==='Low')
                                                                status-danger
                                                            @elseif ($product->product_status==='Reorder')
                                                                status-warning
                                                            @elseif ($product->product_status==='Good')
                                                                status-close
                                                            @endif
                                                            ">
                                                <span>Stock level: {{ $product->product_status }}</span>
                                            </p>
                                            <p class="
                                                            @if( $product->is_verified===0 )
                                                                status-danger
                                                            @elseif( $product->is_verified===2 )
                                                                status-warning
                                                            @else
                                                                status-close
                                                            @endif
                                                            ">
                                                <span>{{  $product->is_verified===0? 'Unverified':($product->is_verified===2?'Verification Requested':'Verified') }}</span>
                                            </p>
                                        </td>
                                        <td>
                                            <ul>
                                                @if( !$product->verificationRequest )
                                                    <li>
                                                        <a href="{{ route('products.verify',[$product->id]) }}"
                                                           class="btn btn-primary text-white">
                                                            Request Verification
                                                        </a>
                                                    </li>
                                                @elseif($product->verificationRequest->status=='approved')
                                                    <li>
                                                        <a href="javascript:void(0)" class="btn btn-primary text-white" id="btnVerify{{$product->id}}"
                                                           onclick="verifyProd({{$product->id}}, '{{auth()->user()->name}}', '{{$product->serial}}')">
                                                            Verify
                                                        </a>
                                                    </li>
                                                @endif
                                                @if( $product->is_published===0 )

                                                    <li>
                                                        <a href="{{ route('products.publish',[$product->id]) }}"
                                                           class="btn btn-primary text-white">
                                                            Publish
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('products.unpublish',[$product->id]) }}"
                                                           class="btn btn-secondary">
                                                            UnPublish
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#updateProduct{{ $product->id }}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#exampleModalToggle">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                        <!-- Delete Modal Box Start -->
                                        <div class="modal fade theme-modal remove-coupon"
                                             id="updateProduct{{ $product->id }}" aria-hidden="true" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header d-block text-center">
                                                        <h5 class="modal-title w-100" id="exampleModalLabel22">Update
                                                            Product</h5>

                                                    </div>
                                                    <form action="{{ route('products.update',[$product->id]) }}"
                                                          method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="container">
                                                                <input type="text" class="mb-3 form-control"
                                                                       name="product_name"
                                                                       value="{{ $product->product_name }}" required>
                                                                <input type="text" class="mb-3 form-control"
                                                                       name="buying_price"
                                                                       value="{{ $product->buying_price }}" required>
                                                                <input type="text" class="mb-3 form-control"
                                                                       name="selling_price"
                                                                       value="{{ $product->selling_price }}" required>
                                                                <input type="text" class="mb-3 form-control"
                                                                       name="quantity" placeholder="Additional Quantity"
                                                                       value="0" required>
                                                                <input type="file" class="mb-3 form-control"
                                                                       name="product_photo" placeholder="photo">
                                                                <textarea name="product_description"
                                                                          class="form-control" id="" cols="30"
                                                                          rows="10">{{ $product->product_description }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning btn-md fw-bold"
                                                                    data-bs-dismiss="modal">Cancel
                                                            </button>
                                                            <input class="btn btn-animation btn-md fw-bold"
                                                                   type="submit" value="Update Product"/>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
    <!-- Add Product Modal Box Start -->
    <div class="modal fade theme-modal remove-coupon" id="addProduct"
         aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Add Product
                    </h5>
                </div>
                <form action="{{ route('products.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name="branch_id" id=""
                                   value="">
                            <input type="text" class="mb-3 form-control"
                                   name="product_name" placeholder="Name" required>
                            <select name="category_id" class="form-select mb-3" required>
                                <option>Choose Category</option>
                                @forelse ($categories as $category)
                                    <option
                                        value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @empty
                                    No categories Available
                                @endforelse
                            </select>
                            <input type="text" class="mb-3 form-control"
                                   name="serial" placeholder="Serial Number" required>
                            <input type="text" class="mb-3 form-control"
                                   name="buying_price" placeholder="Buying Price" required>
                            <input type="text" class="mb-3 form-control"
                                   name="selling_price" placeholder="Selling Price"
                                   required>
                            <input type="text" class="mb-3 form-control"
                                   name="quantity" placeholder="Product Quantity" required>
                            <input type="text" class="mb-3 form-control"
                                   name="minimun_order"
                                   placeholder="Minimum Stock Quantity" required>
                            <input type="file" class="mb-3 form-control"
                                   name="product_photo" placeholder="photo" required>
                            <textarea name="product_description" class="form-control" id="" cols="30" rows="10"
                                      placeholder="Product Description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-md fw-bold"
                                data-bs-dismiss="modal">Cancel
                        </button>
                        <input class="btn btn-animation btn-md fw-bold" type="submit"
                               value="Add Product"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- sidebar effect -->
<x-blockchainjs/>
</x-dashboard>
