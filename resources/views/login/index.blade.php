<?php
session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>PAR | Prima Armada Raya</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="/assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="/assets/login/css/main.css">
<!--===============================================================================================-->

</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/login/images/img-01.jpg');">
            <div class="wrap-login100 p-t-90 p-b-30">
                <div class="" align="center">
                    <img src="assets/login/images/par2.png" width="200px" alt="AVATAR" align="center">
                </div>

                    <div id="loader2" style="display: none;" align="center">
                        <img src="assets/login/images/balls-white.gif" width="100px" align="center">
                    </div>
                    {{ csrf_field() }}
                    <!-- ========== LOGIN ========== -->
                    <div id="login-form" style="display: block;">
                        <br>
                            <!-- {{ csrf_field() }} -->
                            <div class="wrap-input100 validate-input m-b-10">
                                <input class="input100 logins username" placeholder="Username" type="text">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input m-b-10">
                                <input class="input100 logins password" placeholder="Password" type="password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </div>

                            <div class="container-login100-form-btn p-t-10" id="buttonsx">
                                <button class="masuk100-form-btn" id="login-submit">
                                    Masuk
                                </button>
                            </div>
                            <br><br>
                    </div>
            </div>
        </div>
    </div>

<!--===============================================================================================-->  
    <script src="/assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="/assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="/assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="/assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="/assets/login/js/main.js"></script>
<!--===============================================================================================-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--===============================================================================================-->


    <script type="text/javascript">
        
        $('#login-submit').on('click', function () {

        $("#loader2").attr("style","display: block;");
        $("#login-form").attr("style","display: none;");

        var data = {
            _token:$('input[name=_token]').val(),
            username: $('.username').val(),
            password: $('.password').val()
        };

        var empty = false;
        $('input.logins').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });
        if (empty) { 
            swal({
                title: "Tidak bisa masuk!",
                text: "Isi semua isian!",
                icon: "error",
                buttons: false,
                timer: 2000,
            });

            $("#loader2").attr("style","display: none;");
            $("#login-form").attr("style","display: block;");

        } else {

            // Ajax Post 
            $.ajax({
                type: "post",
                url: "{{ route('login_submit') }}",
                data: data,
                cache: false,
                success: function (data)
                {
                    if (data.role == 1 && data.status == 'success'){

                        swal("Sign In Success!", {
                            icon: "success",
                            buttons: false,
                            timer: 2000,
                        });

                        setTimeout(function(){ window.location.href='home'; }, 1500);
                   

                    } else if (data.status == 'error'){

                        swal("Username or Password Wrong!", {
                            icon: "error",
                            buttons: false,
                            timer: 2000,
                        });

                        $("#loader2").attr("style","display: none;");
                        $("#login-form").attr("style","display: block;");

                    }

                }
            });
        }


    });

    </script>

</body>
</html>