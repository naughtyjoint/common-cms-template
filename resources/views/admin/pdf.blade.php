<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #itemTable {
            border-collapse: collapse;
            width: 30%;
        }

        #itemTable td {
            text-align: center;
        }

        #itemTable td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .font-zh {
            font-family: "openhuninn";
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body class="font-zh">
@foreach($data as $key => $order)
    <div>
        <p>訂單編號：{{ $order->id }}</p>
        <p>訂購人：{{ $order->customer['name'] }}</p>
        <p>電話：{{ $order->customer['phone'] }}</p>
        <p>地址：{{ $order->customer['address'] }}</p>
        <p>付款方式：{{ $order->payment }}</p>
        <p>總額：{{ $order->price }}</p>
        <table id="itemTable">
            <thead>
            <tr>
                <th>品項</th>
                <th>數量</th>
            </tr>
            </thead>
            <tbody>
            @foreach(json_decode($order->order_detail, true)['data'] as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['amount'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if($key + 1 != $data->count())
        <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>
