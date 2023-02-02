@extends('master')
@section("content")
    <div class="custom_product">
        <div class="col-sm-10">
        <div style="float:right">
            @if(count($products) > 0)
            <button class="btn btn-secondary"><a href="/ordernow">Order Now</a></button>
            @endif
            </div>
            <div class="trending-wrapper" >
                <h2>Result for product</h2><br><br>
                @foreach($products as $item)
                <div class="row searched-item cart-item_div ">
                    <div class="col-sm-3 ">
                        <a href="detail/{{$item->id}}">
                            <img class="trending-img" src="{{$item->gallery}}">
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <div class="">
                            <h4>{{$item->name}}</h4>
                            <h4>{{$item->description}}</h4>
                            <h4>Rs {{$item->price}}</h4>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <a href="/removecart/{{$item->cart_id}}">
                        <button class="btn btn-danger">Remove item</button>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection