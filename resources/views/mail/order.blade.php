<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order mail</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body>

<h1>Order Successful!</h1>

<div>
    <h3>Order Details</h3>
    <p><strong>Order No : </strong>{{$order->truck_no}}</p>
    <p><strong>Customer Name: </strong>{{$order->name}}</p>
    <p><strong>Customer email: </strong>{{$order->email}}</p>
    <p><strong>Customer address: </strong>{{$order->address}}</p>
    <p><strong>Customer phone: </strong>{{$order->phone}}</p>
    <p><strong>Total Price: </strong>{{$order->price}}</p>
    <p><strong>Total quantity: </strong>{{$order->quantity}}</p>
    <p><strong>Total status: </strong>{{$order->status}}</p>
    <p><strong>Payment Method: </strong>{{$order->payment_method}}</p>
    <p><strong>Txn Id: </strong>{{$order->txn_id}}</p>
    <p><strong>Date: </strong>{{$order->created_at->format('y-m-d')}}</p>
</div>


<div>
    <h3>Product Details</h3>
    <table>
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->details as $key=>$details)
            <tr>
                <td>{{$details->product_name}}</td>
                <td>{{$details->product_price}}</td>
                <td>{{$details->quantity}}</td>
                <td>{{$details->quantity * $details->product_price}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<p>Thank You!</p>

</body>
</html>
