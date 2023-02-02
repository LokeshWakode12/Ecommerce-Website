@extends('master')

@section('content')

<section>
    <div id="container">
        <div class="row">
            <div class="col-md-6 mx-auto" style="margin-left: 404px;">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="text-center">RESET PASSWORD</h4>
                    </div>
                <div class="card-body">
                        @csrf
                        <span class="text-info success_err"></span><br>
                        <input type="hidden" name="token" value = "{{ $token }}">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="enter email" value="{{ $email ?? old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="enter password" value="{{ old('password') }}">
                            <span class="text-danger password_err"></span>
                        </div><br>

                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="enter password" value="{{ old('newpassword') }}">
                            <span class="text-danger newpassword_err"></span>
                        </div><br>
                       
                        <div class="form-group">
                        <button type="submit" id="reset_btn" class="btn btn-dark btn-block mt-4" >RESET PASSWORD</button>
                        </div><br>
                        
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
    $("#reset_btn").on('click',function(e){

        var email = $("#email").val();
        var password = $("#password").val();
        var newpassword = $("#newpassword").val();

            $.ajax({
                        type: 'post',
                        url: '{{ route('reset-password') }}',
                        data: {
                            _token: '{{csrf_token()}}',
                            email:email,
                            password:password,
                            newpassword:newpassword,
                        },
                
                        success:function(data){
                            if($.isEmptyObject(data.error)){
                                if(data.success){
                                    clearerror();
                                    $('.success_err').html(data.success);
                                    window.location="{{route('login')}}";
                                }
                                else{
                                    clearerror();
                                    $('.success_err').html('***'+data.token+'***');
                                }
                            }else{
                                    clearerror();
                                    printErrorMsg(data.error);
                                }
                        }
            });
    });
    function printErrorMsg(msg)
    {
        $.each(msg,function(key,value){

            $('.'+key+'_err').html('***'+value+'***');
        });
    }
    function clearerror()
    {
        $('.newpassword_err').html('');
        $('.password_err').html('');
        $('.success_err').html('');
    }
    
});

</script>

@endsection