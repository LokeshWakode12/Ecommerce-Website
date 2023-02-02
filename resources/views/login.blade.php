@extends('master')
@section("content")
<div class="container custom-login">
    <div class = "row">
        <span id=""></span>
        <div class = "col-sm-4 col-sm-offset-4">
            <span class="text-danger err"></span>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Enter your Email : </label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Test@gmail.com" />
                    <span class="text-danger email_err"></span>
                </div><br>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="password" />
                    <a href="{{route('forget')}}" style="float:right">Forget Password ?</a>
                    <span class="text-danger password_err"></span>
                </div><br>
                <button  class="btn btn-primary" type="submit" id="login_btn" >Login</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#login_btn').click(function(e){

        e.preventDefault();

        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
                type: 'post',
                url: '{{ route('user_login') }}',
                data:{
                    _token: '{{csrf_token()}}',
                    email:email,
                    password:password,
                },
                success:function(data){
                    if($.isEmptyObject(data.error)){
                        if(data.success){
                            clearerror()
                            window.location="{{route('home')}}";
                        }
                        else{
                            clearerror()
                            $('.err').html(data.notexists);
                        }
                    }
                    else{
                        clearerror()
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
        $('.err').html('');
        $('.email_err').html('');
        $('.password_err').html('');
    }
    

});

</script>

@endsection