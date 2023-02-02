@extends('master')
@section("content")
<div class="custom_product">
    <div class="container">
    <h2>Check in Status :) </h2>
    <p>Have a good day Sir/Ma'am  :)</p> <br>           
    <table class="table table-striped">
        <tbody>
        <tr>
            <td>Total price:</td>
            <td>Rs {{$total}}</td>
        </tr>
        <tr>
            <td>Taxes: </td>
            <td>Rs 0</td>
        </tr>
        <tr>
            <td>Delivery fee:</td>
            <td>Rs 10</td>
        </tr>
        <tr>
            <td>Grand Total:</td>
            <td>Rs {{$total + 10}}</td>
        </tr>
        </tbody>
    </table>
    </div>
    <div class="container">
    <form >
        @csrf
    <div class="email">
        <label for="address">Address: </label>
        <textarea name ="address" id="address" type="text" class="form-control"  ></textarea>
        <span class="text-danger address_err"><span>
    </div><br><br>
    <div class="form-group">
        <label for="address"><b>Payment Method: </b></label><br>
        <select class="form-select" aria-label="Default select example" name="payment" id="payment">
            <option selected value="" >SELECT OPTION</option>
            <option value="UPI ID" >UPI ID</option>
            <option value="EMI"  >EMI</option>
            <option value="Cash on Delivery"  >Cash on Delivery</option>
            </select><br>
        <span class="text-danger payment_err"><span>
    </div><br>
    
    <button type="submit" class="btn btn-danger" id="buy_btn">Buy Now</button>
    </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#buy_btn').click(function(e){

        e.preventDefault();

        var address = $("#address").val();
        var payment = $("#payment").val();

        $.ajax({
                type: 'post',
                url: '{{route('orderplaced')}}',
                data:{
                    _token: '{{csrf_token()}}',
                    address : address,
                    payment : payment,
                },
                success:function(data){
                    // console.log(data.error);
                    if($.isEmptyObject(data.error)){
                        if(data.success){
                            clearerror();
                            alert(data.success);
                            window.location='{{route('home')}}';
                        }
                    }
                    else{ 
                        clearerror();
                        printErrorMsg(data.error);
                    }   
                }
        });
    });
    function printErrorMsg(msg)
    {
        $.each(msg,function(key,value){
            $('.'+key+'_err').html('***'+value+"***");
        });
    }
    function clearerror()
    {
        $('.address_err').html('');
        $('.payment_err').html('');
    }
});

</script>
@endsection
