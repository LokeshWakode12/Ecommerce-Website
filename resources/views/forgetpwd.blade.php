@extends('master')
@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-mt-4" style=" margin-left: 360px; margin-top: 100px; ">
            
            <h5>FORGOT PASSWORD</h5><hr>
          <form >
            @csrf
            <div class="form-group">
            <span class=" text-info email_success"></span><br>
            <label>Email:-</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="Enter your registered email here"  value=" {{ old('email') }} ">
            <span class="text-danger email_err"><span>
            </div>
        <div class="form-group mt-2">
        <button type="submit" id = "send_btn" class="btn btn-primary">Send Reset Link</button>
        </div>
        </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#send_btn').click(function(e){

        e.preventDefault();

        var email = $("#email").val();

        $.ajax({
                type: 'post',
                url: '{{ route('newpass') }}',
                data:{
                    _token: '{{csrf_token()}}',
                    email : email,
                },
                success:function(data){
                    if($.isEmptyObject(data.error)){
                        if(data.success){
                            clearerror();
                            $('.email_success').html(data.success);  
                        }
                        else{
                            clearerror();
                            $('.email_err').html(data.notexists); 
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
        $('.email_err').html('');
        $('.email_success').html('');  
    }
});

</script>

@endsection