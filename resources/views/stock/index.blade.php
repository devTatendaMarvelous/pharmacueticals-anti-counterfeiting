
<x-dashboard>
    <script src="{{asset('assets/js/ethers.js')}}"></script>
    <script>
        var provider = new ethers.providers.JsonRpcProvider('http://127.0.0.1:7545', {
            chainId: 1337
        });
        console.log('tait')
        var contractABI = JSON.parse( @json(contractABI())).abi; // Replace with the ABI of your smart contract
        var contractAddress = JSON.parse( @json(contractAddress())).address

        var privateKey = "{{privateKey()}}"; // Replace with your private key


        var wallet = new ethers.Wallet(privateKey, provider);
        // Create a contract instance and connect it to the signer
        var contract = new ethers.Contract(contractAddress, contractABI, wallet);
        var signer = provider.getSigner();
        // Get the address of the account


        function isConnected  ()  {
            return signer.getAddress().then((result) => {
                console.log(result)
            }).catch((error) => {
                alert('Error retrieving connected account');
            })
        }

        function verifyProd(productId = '', pharmacy = '', serial = '') {
            document.getElementById(`btnVerify${productId}`).setAttribute('style', 'display:none')
            if (isConnected()) {
                contract.addVerification(productId, pharmacy, serial).then((res) => {

                    console.log(res)
                    const verifyURL = "{{ url('/') }}"

                    $.ajax({
                        url: `${verifyURL}/store-token/${productId}`,
                        method: 'GET',
                        data: {token: res.hash},
                        success: function (response) {
                            window.location.href = `${verifyURL}/stocks`
                        }
                    });
                })
            }
        }
    </script>










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
                                    <th>Manufactured By</th>
                                    <th>Date Manufactured</th>
                                    <th>Expiry Date</th>
                                    <th>Current Qty</th>
                                    <th>Price</th>
                                    <th>Verification Token</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ( $stock as $product )
                                    <tr>
                                        <td>
                                            <div class="table-image">
                                                <img src="{{ asset('storage/'.$product->product->product_photo) }}"
                                                     class="img-fluid"
                                                     alt="">
                                            </div>
                                        </td>

                                        <td>{{ $product->product->product_name }}</td>
                                        <td>{{ $product->product->manufacturer->user->name }}</td>
                                        <td>{{ $product->product->manufactured_date }}</td>
                                        <td>{{ $product->product->expiry_date }}</td>
                                        <td>{{ $product->quantity }}</td>

                                        <td class="td-price">${{ $product->selling_price }}</td>
                                        <td>@if($product->is_verified)
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   onclick="makeCode({{$product->id}},'{{$product->verification_token}}')"
                                               class="btn btn-primary">
                                                Reveal QR Code
                                            </a>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                               data-bs-target="#viewQR{{$product->id}}"
                                               id="viewQRbtn{{$product->id}}">
                                            </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
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
                                                            @if( $product->is_verified===1 )

                                                                status-close
                                                            @elseif( $product->is_verified===2 )
                                                                status-warning
                                                            @else
                                                                 status-danger
                                                            @endif
                                                            ">
                                                <span>{{  $product->is_verified===1? 'Verified':($product->is_verified===2?'Verification Requested':'UnVerified') }}</span>
                                            </p>
                                        </td>
                                        <td>
                                            <ul>
                                                @if( !$product->verificationRequest )
                                                    <li>
                                                        <a href="{{ route('stocks.verify',[$product->id]) }}"
                                                           class="btn btn-primary text-white">
                                                            Request Verification
                                                        </a>
                                                    </li>
                                                @elseif($product->verificationRequest->status=='approved')
                                                    <li>
                                                        <a href="javascript:void(0)" class="btn btn-primary text-white" id="btnVerify{{$product->id}}"
                                                           onclick="verifyProd({{$product->id}}, '{{auth()->user()->name}}', '{{$product->product->serial}}')">
                                                            Verify
                                                        </a>
                                                    </li>
                                                @endif
                                                @if($product->is_verified==1)
                                                        @if( $product->is_published===0 )
                                                            <li>
                                                                <a href="{{ route('stocks.publish',[$product->id]) }}"
                                                                   class="btn btn-primary text-white">
                                                                    Publish
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="{{ route('stocks.unpublish',[$product->id]) }}"
                                                                   class="btn btn-secondary">
                                                                    UnPublish
                                                                </a>
                                                            </li>
                                                        @endif
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
                                        <!-- Add Product Modal Box Start -->
                                        <div class="modal fade theme-modal remove-coupon" id="viewQR{{$product->id}}"
                                             aria-hidden="true" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header d-block text-center">
                                                        <h5 class="modal-title w-100" >QR Code for {{$product->product_name}}
                                                        </h5>
                                                    </div>
                                                    <div class="container d-flex justify-content-center align-items-center pb-5 row">
                                                        <div class="col-12 d-flex justify-content-center pb-3">
                                                            <div id="qrcode{{$product->id}}" style="width:100px; height:100px; margin-top:15px; "></div>
                                                        </div>
                                                        <h6>{{$product->verification_token}}</h6>
                                                        <div class="col-12 d-flex justify-content-center pt-3">
                                                            <a id="downloadLink{{$product->id}}" href="#"  class="btn btn-primary"  onclick="downloadImage({{$product->id}},'{{$product->product->manufacturer->user->name.'_'.$product->product->product_name}}')">Download </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- sidebar effect -->

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
                    <h5 class="modal-title w-100">Add Stock
                    </h5>
                    <div class="modal-title w-100" id="title">
                    </div>
                </div>
                <form action="{{ route('stocks.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name="product_id" id="product_id">
                            <input type="text" class="mb-3 form-control"
                                   name="serial" placeholder="Batch Number  " onkeyup="checkSerial()" id="serial" required>
                            <p class="text-danger" style="color:red;" id="serial-error"></p>
                            <div id="stock-data" style="display: none;">
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

                                <textarea name="product_description" class="form-control" id="" cols="30" rows="10"
                                          placeholder="Product Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-md fw-bold"
                                data-bs-dismiss="modal">Cancel
                        </button>
                        <input class="btn btn-animation btn-md fw-bold" type="submit" id="add-btn"
                               value="Add Product" style="display: none;" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- sidebar effect -->

  <!-- select2 js -->
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/select2-custom.js')}}"></script>
    <script>


        const checkSerial = () =>{
            const serial=$('#serial').val()
            if(serial.length < 9){
               $('#serial-error').text("Serial Number must be at least 9 characters")
                $('#stock-data').hide()
                $('#add-btn').hide()
            }else{

                $.ajax({
                    url: `{{ url('/') }}/get-serial/${serial}`,
                    method: 'GET',
                    data: {

                    },
                    success: function(response) {
                        // Handle the successful response here
                       if(response.exists){
console.log(response.product)
                           $('#title').text(response.product.product_name)
                           $('#product_id').val(response.product.id)

                           $('#serial-error').text("")
                           $('#stock-data').show()
                           $('#add-btn').show()
                       }else{
                           $('#stock-data').hide()
                           $('#add-btn').hide()
                           $('#serial-error').text("Serial Number does not match any existing products")
                       }
                    },
                    error: function(xhr, status, error) {
                        // Handle the error here
                        console.error(error);
                    }
                });
            }
        }

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



</x-dashboard>
