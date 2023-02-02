@extends('master')
@section("content")
    <div class="custom_product">
        <div class="col-sm-10">
            <div class="trending-wrapper" >
                <h2>My Orders :)</h2><br><br>
                @foreach($myorders as $item)
                <div class="row searched-item cart-item_div ">
                    <div class="col-sm-3 ">
                        <a href="detail/{{$item->id}}">
                            <img class="trending-img" src="{{$item->gallery}}">
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <div class="">
                            <h3>Name: {{$item->name}}</h3>
                            <h4>Delivery status: {{$item->status}}</h4>
                            <h4>Address: {{$item->address}}</h4>
                            <h4>Payment status: {{$item->product_status}}</h4>
                            <h4>Payment method: {{$item->payment_method}}</h4>
                        </div>
                    </div>  
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

