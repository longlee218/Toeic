<?php
require_once './MVC/Views/inc/master.php';
//echo json_encode($_SESSION['google_user'])
?>
<style>

</style>
<div class="container" id="content">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <header class="card-header">
                    <a href="Login" class="float-right btn btn-outline-primary mt-1">Đăng nhập</a>
                    <h3 class="card-title mt-2">Đăng ký</h3>
                </header>
                <article class="card-body">
                    <form method="post" onsubmit="register(event)" id="register-form">
                        <div class="form-row">
                            <div class="col form-group">
                                <label>Tên đăng nhập</label>
                                <input type="text" class="form-control" placeholder="" id="username" name="username">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="1" checked>
                                    <span class="form-check-label"> Nam </span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="0">
                                    <span class="form-check-label"> Nữ</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="2">
                                    <span class="form-check-label"> Khác</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Thành phố</label>
                                <input type="text" class="form-control" name="city" id="city">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tên trường</label>
                                <input type="text" class="form-control" name="school" id="school_name">
                            </div> <!-- form-group end.// -->
                            <div class="form-group col-md-6">
                                <label>Tên lớp</label>
                                <input type="text" class="form-control" name="class" id="class_name">
                            </div> <!-- form-group end.// -->
                        </div><!-- form-row.// -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nhập mật khẩu</label>
                                <input class="form-control" type="password" id="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nhập lại mật khẩu</label>
                                <input class="form-control" type="password" id="password_confirm">
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="messages"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-block" id="btn_register"> Đăng ký  </button>
                        </div> <!-- form-group// -->
                    </form>
                </article> <!-- card-body end .// -->
                <div class="border-top card-body text-center">Bạn đã có tài khoản? <a href="Login">Đăng nhập</a></div>
            </div> <!-- card.// -->
        </div> <!-- col.//-->

    </div> <!-- row.//-->
</div>
<!---->
<script>
    function register(event) {
        event.preventDefault();
        const form = $('#register-form')
        const data = getFormData(form)
        $.ajax({
            method: 'POST',
            url: '/../Toeic/api/register',
            data: JSON.stringify(data),
            headers: {ContentType: 'application/json',},
            success: (res) => {
                if (!res.success) {
                    let alert_danger = $('#danger-alert')
                    $(alert_danger).html(`<strong>Error: </strong>${res.mess}`)
                    $(alert_danger).show()
                }
            }
        })
    }
</script>