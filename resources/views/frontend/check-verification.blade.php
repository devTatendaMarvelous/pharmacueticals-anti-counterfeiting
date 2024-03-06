@extends('layouts.app')
@section('content')
    <style>

        .qr-container {
            width: 100%;
            max-width: 500px;
            margin: 5px;
        }

        .qr-container h1 {
            color: #ffffff;
        }

        .section {
            background-color: #ffffff;
            padding: 50px 30px;
            border: 1.5px solid #b2b2b2;
            border-radius: 0.25em;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
        }

        #my-qr-reader {
            padding: 20px !important;
            border: 1.5px solid #b2b2b2 !important;
            border-radius: 8px;
        }

        #my-qr-reader img[alt="Info icon"] {
            display: none;
        }

        #my-qr-reader img[alt="Camera based scan"] {
            width: 100px !important;
            height: 100px !important;
        }

        button {
            padding: 10px 20px;
            border: 1px solid #b2b2b2;
            outline: none;
            border-radius: 0.25em;
            color: white;
            font-size: 15px;
            cursor: pointer;
            margin-top: 15px;
            margin-bottom: 10px;
            background-color: #008000ad;
            transition: 0.3s background-color;
        }

        button:hover {
            background-color: #008000;
        }

        #html5-qrcode-anchor-scan-type-change {
            text-decoration: none !important;
            color: #1d9bf0;
        }

        video {
            width: 100% !important;
            border: 1px solid #b2b2b2 !important;
            border-radius: 0.25em;
        }
    </style>
    <!-- Product Section Start -->
    <section class="product-section">
            <div class="row container">
                <div class="text-danger d-flex justify-content-center px-5" id="error"></div>
                <div class=" d-flex justify-content-center" id="content-area">
                    <div class=" card px-5 py-3 mb-5 "  id="form">
                        <h3 class="p-3">Scan QR Code</h3>
                        <div class="qr-container  col-12">
                            <div class="section">
                                <div id="my-qr-reader">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center  saving" style="display: none;color:#1C5B77;">
                        <i class="fa fa-spin fa-spinner fa-4x"></i>
                        <h4 id="fetch-status">Fetching product from the blockchain...</h4>
                    </div>
                </div>
            </div>
    </section>
    <!-- Product Section End -->

    <script src="{{asset('assets/js/ethers.js')}}"></script>

    <script src="{{asset('qrcode/html5-qrcode.min.js')}}"></script>
    <script >
        // script.js file

        function domReady(fn) {
            if (
                document.readyState === "complete" ||
                document.readyState === "interactive"
            ) {
                setTimeout(fn, 1000);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        domReady(function () {

            // If found you qr code
            function onScanSuccess(decodeText, decodeResult) {

                $('.saving').show();
                $('#form').hide();
                setTimeout(function () {
                    getTransactionHash(decodeText);
                },2000)

                // alert("You Qr is : " + decodeText, decodeResult);
            }

            let htmlscanner = new Html5QrcodeScanner(
                "my-qr-reader",
                { fps: 10, qrbos: 250 }
            );
            htmlscanner.render(onScanSuccess);
        });


        const area = $('#content-area')

        area.append()
        const contractABI = JSON.parse( @json(contractABI())).abi;
        const provider = new ethers.providers.JsonRpcProvider("http://127.0.0.1:7545", {
            chainId: 1337
        });
        const url = "{{url('/')}}"
        const getTransactionHash = (transactionHash) => {

            // const transactionHash = $('#token').val();
            console.log(transactionHash)

            // transactionHash = "0xbd92c9aee699356c6283e014de81760f5b808afbd1365bfe5550e64d54360251";
            provider.getTransaction(transactionHash).then((transaction) => {
                document.getElementById('fetch-status').textContent = 'Matching the transaction with the product...';
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
                                <h5 class="card-title"><strong>Product: </strong>${response.product_name}</h5>
                                <p class="card-text"><strong>Serial: </strong>${response.serial}</p>
                                <h5 class="card-title"><strong>Pharmacy Selling: </strong> ${response.pharmacy_name}</h5>
                                <h5 class="card-title"><strong>Date Manufactured: </strong> ${response.manufactured_date}</h5>
                                <h5 class="card-title"><strong>Expiry Date: </strong> ${response.expiry_date}</h5>
                                <h5 class="card-title"><strong>Manufacturer: </strong> ${response.name}</h5>
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
                                <h5 class="card-title text-center">The QR Code supplied does not match any verification transaction in  the blockchain </h5>
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
