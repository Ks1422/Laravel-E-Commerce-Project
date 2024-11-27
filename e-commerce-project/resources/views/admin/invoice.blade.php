<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
    <h3>Name:{{$data->name}}</h3>
    <h3>Adress:{{$data->rec_address}}</h3>
    <h3>Phone:{{$data->phone}}</h3>

    <h2>Title:{{$data->product->title}}</h2>
    <h2>Price:{{$data->product->price}}</h2>
    <h2><img src="products/{{$data->product->image}}" width="150" height="150" alt=""></h2>
    </center>

</body>

</html>