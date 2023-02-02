@extends('master')
@section("content")
<div class="container custom-login">
    <div class = "row">
        <div class = "col-sm-4 col-sm-offset-4">
                    <span class="text-danger err"></span>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="username" aria-describedby="emailHelp"  />
                    <span class="text-danger name_err"></span>
                </div><br>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" aria-describedby="emailHelp" required/>
                    <span class="text-danger email_err"></span>
                </div><br>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="password" id="exampleInputPassword1">
                    <span class="text-danger password_err"></span>
                </div><br>
                <button  class="btn btn-primary" id="save_form" >Register</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    $("#save_form").on('click',function(e){

        var name = $('#name').val();
        var email = $("#email").val();
        var password = $("#password").val();

            $.ajax({
                        type: 'post',
                        url: '/save_user',
                        dataType: 'JSON',
                        data: {
                            _token: '{{csrf_token()}}',
                            name:name,
                            email:email,
                            password:password,
                        },
                
                        success:function(data){
                            if($.isEmptyObject(data.error)){
                                if(data.success){
                                    clearerror()
                                    alert("Sucessfully registered");
                                    window.location="{{route('login')}}";
                                }else{
                                    clearerror()
                                    $('.err').html(data.exists);
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
            $('.'+key+'_err').html('***'+value+'***');
        });
    }
    function clearerror()
    {
        $('.err').html('');
        $('.name_err').html('');
        $('.email_err').html('');
        $('.password_err').html('');
    }
});

</script>

@endsection

