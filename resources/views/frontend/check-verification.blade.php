@extends('layouts.app')
@section('content')
    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3 container">
                <div class="text-danger d-flex justify-content-center p-5" id="error"></div>
                <div class="card-header d-flex justify-content-center" id="content-area">
                    <div class="row card p-2 mb-5 mt-5"  id="form">
                        <h3 class="p-3">Check Verification</h3>
                        <div>
                            <input class="form-control" placeholder="Enter Verification token..." id="token">
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <input class="btn col-12 " type="submit" value="Check"
                                   style="background:  #1c5b77; color:#fff; margin-right:5px;" onclick="getTransactionHash()">
                        </div>
                    </div>
                    <div class="text-center  saving" style="display: none;color:#1C5B77;">
                        <i class="fa fa-spin fa-spinner fa-4x"></i>
                        <h4>Fetching transaction...</h4>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Product Section End -->

    <script src="{{asset('assets/js/ethers.js')}}"></script>
    <script>
        const area = $('#content-area')

        area.append()
        const contractABI = JSON.parse( @json(contractABI())).abi;
        const provider = new ethers.providers.JsonRpcProvider("http://127.0.0.1:7545", {
            chainId: 1337
        });
        const url = "{{url('/')}}"
        const getTransactionHash = () => {

            const transactionHash = $('#token').val();
            console.log(transactionHash)
            $('.saving').show();
            $('#form').hide();
            // transactionHash = "0xbd92c9aee699356c6283e014de81760f5b808afbd1365bfe5550e64d54360251";
            provider.getTransaction(transactionHash).then((transaction) => {
                // Decode the transaction data
                const iface = new ethers.utils.Interface(contractABI)
                // const decodedData = iface.parseTransaction( transaction);
                const decodedData = iface.parseTransaction(transaction);
                console.log(decodedData)
                const productId = parseInt(decodedData.args.productId._hex, 16)
                const url = "{{url('/')}}"
                $.ajax({
                    url: `${url}/get-product/${productId}`,
                    method: 'GET',
                    success: function (response) {
                        // Handle the response from the PHP helper function

                        $('.saving').hide();
                        console.log(response);
                        const mod = $(`
                            <div class="card p-3 mb-5" style="width: 18rem;">
                              <img class="card-img-top" src="${url}/storage/${response.product_photo}" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title"><strong>Pharmacy: </strong> ${response.product_name}</h5>
                                <h5 class="card-title"><strong>Product: </strong>${response.product_name}</h5>
                                <p class="card-text"><strong>Category: </strong>${response.category.category_name.slice(0, 94)}</p>
                                <a href="#" class="btn btn-primary">${response.product_name} is verified</a>
                              </div>
                            </div>
                        `)
                        area.append(mod)
                    },
                    error: function (xhr, status, error) {
                        // Handle any errors
                        console.error('Error:', error);
                    }
                });
            }).catch((error) => {
                const mod = $(`
                            <div class="row d-flex justify-content-center">
                                <h5 class="card-title text-center">Record Not found </h5>
                                <p class="card-text text-center">Click the button below to try again</p>
                                <a href="#" class="btn col-7" style="background:  #1c5b77; color:#fff; margin-right:5px;" onclick="retry()"><i class="fa fa-undo"></i> Retry</a>
                            </div>
                        `)
                $('#error').append(mod)
                    $('.saving').hide();
                    // $('#form').show();

            })
        }
const retry=()=>{
   window.location.href=`${url}/check-verification`
}
    </script>

@endsection
