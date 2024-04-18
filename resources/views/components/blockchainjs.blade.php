@push('scripts')
    <script src="{{asset('assets/js/ethers.js')}}"></script>

    <script>
        const provider = new ethers.providers.JsonRpcProvider('http://127.0.0.1:7545', {
            chainId: 1337
        });
        const contractABI = JSON.parse( @json(contractABI())).abi; // Replace with the ABI of your smart contract
        const contractAddress = JSON.parse( @json(contractAddress())).address

        const privateKey = "{{privateKey()}}"; // Replace with your private key


        const wallet = new ethers.Wallet(privateKey, provider);
        // Create a contract instance and connect it to the signer
        const contract = new ethers.Contract(contractAddress, contractABI, wallet);
        const signer = provider.getSigner();
        // Get the address of the account
        const isConnected = () => {
            return signer.getAddress().then((result) => {
                console.log(result)
            }).catch((error) => {
                alert('Error retrieving connected account');
            })
        }
        const getAllVerifications = () => {
            if (isConnected()) {
                contract.getAllVerifications().then(function (transactions) {
                    transactions.map((transaction) => {
                        const timestamp = parseInt(transaction.timestamp._hex, 16) * 1000
                        const date = new Date(timestamp)
                        // console.log(date)
                        const drugId = parseInt(transaction.productId._hex, 16)
                        console.log(drugId)
                        console.log(transaction)
                    })
                }).catch(function (error) {
                    console.error(error);
                });
            } else {
            }
        }

        const verifyProd = (productId = '', pharmacy = '', serial = '') => {
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
        const  getTransactionHash=(transactionHash = '')=> {
            if (isConnected()) {
                // Specify the transaction hash you want to retrieve
                transactionHash = '0xbd92c9aee699356c6283e014de81760f5b808afbd1365bfe5550e64d54360251';

                provider.getTransaction(transactionHash).then((transaction) => {


                   const iface=new ethers.utils.Interface(contractABI)
                    const decodedData = iface.parseTransaction( transaction);
                     console.log('Decoded Data:', decodedData);

                })
            }
        }

        getTransactionHash()
    </script>
@endpush
