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

                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table all-package theme-table table-product" id="table_id">
                                <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Date Manufactured</th>
                                    <th>Expiry Date</th>
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
                                        <td>{{ $product->manufactured_date }}</td>
                                        <td>{{ $product->expiry_date }}</td>

                                        <td>
                                            <p class="
                                            @if ($product->is_active)
                                                 status-close">
                                                <span>Active</span>
                                                @else
                                                    status-danger">
                                                <span>Deactivated</span>
                                                @endif

                                            </p>

                                        </td>
                                        <td>
                                            <ul>
                                                @if($product->is_activate)
                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                           data-bs-target="#updateProduct{{ $product->id }}">
                                                           Deactivate
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                           data-bs-target="#updateProduct{{ $product->id }}">
                                                            Activate
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
                                                       data-bs-target="#deleteProduct{{ $product->id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                        <!-- Delete Modal Box Start -->
                                        <div class="modal fade theme-modal remove-coupon"
                                             id="deleteProduct{{ $product->id }}" aria-hidden="true" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header d-block text-center">
                                                        <h5 class="modal-title w-100" id="exampleModalLabel22">Delete {{$product->name}}</h5>
                                                    </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning btn-md fw-bold"
                                                                    data-bs-dismiss="modal">Cancel
                                                            </button>
                                                            <a class="btn btn-animation btn-md fw-bold" href="{{route('products.delete',[$product->id])}}">Yes Delete</a>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
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

                                                                <input type="date" class="mb-3 form-control"
                                                                       name="manufactured_date" value="{{ $product->manufactured_date }}" required>
                                                                <input type="date" class="mb-3 form-control"
                                                                       name="expiry_date" value="{{ $product->expiry_date }}" required>
                                                                <input type="file" class="mb-3 form-control"
                                                                       name="product_photo" placeholder="photo">
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
                            <label>Manufactured Date</label>
                            <input type="date" class="mb-3 form-control"
                                   name="manufactured_date" placeholder="Date Manufactured" required>
                            <label>Expiry Date</label>
                            <input type="date" class="mb-3 form-control"
                                   name="expiry_date" placeholder="Expiry Date" required>
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
                            <input type="file" class="mb-3 form-control"
                                   name="product_photo" placeholder="photo" required>
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


    <script>
        function makeCode (id,token) {
            const qr=document.getElementById(`qrcode${id}`)
            qr.innerHTML = "";
            var qrcode = new QRCode(qr, {
                width : 100,
                height : 100
            });
            qrcode.makeCode(token)
            console.log(token)
            document.getElementById(`viewQRbtn${id}`).click();
        }
        function downloadImage(id,name){


            var imageUrl = $(`#qrcode${id}.img`).prevObject[0].images[5].getAttribute('src') // Replace with the URL of the image you want to download

            $(`#downloadLink${id}`).attr({
                    href: imageUrl,
                    download:`${name}_Qr.png` // Replace with the desired filename for the downloaded image
                })[0].click();

        }
    </script>
    <x-blockchainjs/>


</x-dashboard>
