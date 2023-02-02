<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-comm</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.6.2.min.js" ></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

</head>
<body>

    {{View::make('header')}}
    
    @yield("content")    
    
    {{View::make('Footer')}}

</body>
<style>

    .custom-login{
        height : 500px;
        padding-top : 100px;
    }

    .img-slider{
        height: 500px !important;
        margin: auto;
    }

    .custom-product {
        height: 700px;
    }

    .trending-rapper{
        height: 30px;
    }

    .bar{
        background-color:#2b9b9b7a;
    }

    .trending-img{
        height:200px;
    }

    .trending-item{
        float:left;
        width:15%;
    }

    .detail-img{
        height:300px;
    }
    
    .cart-item_div{
        border-bottom:2px solid black;
        margin-bottom: 20px ;
        padding-bottom:20px ;
    }
    .searched-item{
        padding-left:100px;
    }
    .panel-default {
    border-color: #ddd;
    margin-top: 350px;
    }
    
</style>
</html>