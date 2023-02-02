@extends('master')
@section("content")
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img class="detail-img" src="{{$product['gallery']}}" >
        </div>
        <div class="col-sm-6" >
            <a href = "/"><b> <-GO BACK </b></a>
            <h2>{{$product['name']}}</h2>
            <h3>Price : Rs {{$product['price']}} </h3>
            <h3>Description : {{$product['description']}}</h3>
            <h3>Category : {{$product['category']}}</h3>
            <br>
            <form action="/add_to_cart" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product['id']}}" />
                <button class="btn btn-primary">Add to Cart</button>
            </form>
            <br><br>
            <form action="/add_to_buy" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product['id']}}" />
            <button class="btn btn-danger" >Buy now</button><br>
            </form>
        </div>
    </div>
</div>
@endsection


