<head>

    <title>{{ config('app.name') }}</title>

</head>

<body>
    <p>Dear customer, Your transaction at onlinemarket.co.zw, on your Card
        ending with {{ $mailData['number'] }} was declined on {{$mailData['date']}} at {{$mailData['time']}} due to insufficient funds.</p>
    <p><strong> *DISCLAIMER*</strong></p>

</body>

</html>
