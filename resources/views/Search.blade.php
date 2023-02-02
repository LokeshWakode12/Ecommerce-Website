@extends('master')
@section("content")
<div class="custom-product">
    <div class="custom-product">
    <div class="">
        <h2>Your search list</h2>
        @foreach($search as $item)
            <div class="searched-item">
                <br>
                <div class="col-sm-2 ">
                <a href="detail/{{$item['id']}}">
                    <img class="trending-img"src="{{$item['gallery']}}">
                </div>
                    <div class="col-sm-4">
                        <h2>{{$item['name']}}</h2>
                        <h4>{{$item['description']}}</h4>
                    </div>
                </a>    
            </div>
        @endforeach
    </div>  
</div>
@endsection


