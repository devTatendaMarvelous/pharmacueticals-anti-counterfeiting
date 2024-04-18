<head>

    <title>Transaction Successful</title>

</head>

<body>



    <p>Dear customer, You have succefully completed a transaction of ${{$mailData['amount']}} at {{config('app.name')}}, with Card
        ending with {{ $mailData['number'] }}. Your new bank balance is USD {{$mailData['balance']}}.</p>

    <p>*DISCLAIMER*</p>

</body>

</html>
