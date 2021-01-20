<?php
require_once './MVC/Views/inc/master.php';
?>
<style>
    .eyes, .eyes:hover{
        color:#333;
        border:1px solid #ced4da ;
        border-top-right-radius:.25rem;
        border-bottom-right-radius:.25rem;
        background-color: #ced4da;
        padding: 0 .5rem;
    }
</style>
<div class="container" id="content">
    <hr>
    <div class="row justify-content-center pt-5">
        <div class="col-md-4">
            <div class="card">
                <header class="card-header">
                    <h3 class="card-title mb-4 mt-1">Đăng nhập</h3>
                </header>
                <article class="card-body">
                    <form method="post" id="login_form" onsubmit="login(event)">
                        <div class="form-group">
                            <label>Tên đăng nhập</label>
                            <input name="email" id="email" class="form-control" placeholder="Enter email" type="text"
                            value="<?php  echo $email_suggester =(isset($_COOKIE['username']) ? $_COOKIE['username'] : '') ?>">
                            <div id="messages_email"></div>
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <a class="float-right" href="ForgotPassword/defaultFunction">Quên mật khẩu?</a>
                            <label>Mật khẩu</label>
                            <div class="input-group" id="show_hide_password">
                                <input name="password" id="password" class="form-control" placeholder="******" type="password"
                                       value="<?php echo $password_suggester =(isset($_COOKIE['password']) ? $_COOKIE['password'] : '') ?>">
                                <div class="input-group-prepend">
                                    <a href="" class="eyes"><i class="fa fa-eye-slash mt-2" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <div class="checkbox">
                                <a class="float-right" href="RegisterAccount">Đăng ký tài khoản?</a>
                                <label><input type="checkbox" name="save-pasword"> Lưu mật khẩu </label>
                            </div> <!-- checkbox .// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" name="login_button" id='login_btn' class="btn btn-primary btn-block"> Đăng nhập </button>
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button onclick="loginGoogle()" type="button" name="google_button" id='google_btn' class="btn btn-outline-danger btn-block"> Google </button>
                            <button onclick="loginGoogle()" type="button" name="facebook_button" id='facebook_btn' class="btn btn-outline-primary btn-block">Facebook </button>

                        </div>
                    </form>
                </article>
            </div> <!-- card.// -->

        </div> <!-- col.// -->
    </div> <!-- row.// -->
</div>
<!---->
<script>

    function login(e){
        e.preventDefault();
        const post = {
            email: $('#email').val(),
            password: $('#password').val(),
            save: $('input[type="checkbox"]').prop("checked")
        }
        $.ajax({
            method: 'POST',
            url: '/../Toeic/api/login',
            headers: 'Content-Type:application/json',
            data: JSON.stringify(post),
            beforeSend: function() {
                $('#loader').show()
            },
            success: function (data) {
                if (data.success === true){
                    setTimeout(function () {
                        window.location.href = '/../Toeic/home';
                    }, 2000)
                }
            },
            complete: function (){
                setTimeout(function () {
                    $('#loader').hide()
                }, 2000)
            }
        })
    }

    function loginGoogle(){
        $.ajax({
            method: 'GET',
            url: '/../Toeic/api/google/auth',
            success: (data) =>{
                window.location = data['google']
            }
        })
    }
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>