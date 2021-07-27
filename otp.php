<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubtel | Enter OTP</title>
    <link rel="shortcut icon" type="image" href="assets/images/favicon.png" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/scss/style.css">

</head>
<body>

    <div class="login container">

        <span class="content col-md-8">
            <div class="row">
                <div class="col-md-6 text-center d-flex flex-column left-col my-auto">

                    <div class="col-10 align-self-center login-header">
                        <a href="./">
                            <img class="logo mb-3" src="assets/images/logo.svg" alt="">
                        </a>
                    </div>

                    <form id="otpForm" class="text-start">
                        <div class="mb-3">

                            <label for="otp" class="form-label">OTP sent to +233 - 547759141</label>

                            <div class="input-group mb-4">
                                <div class="input-group-text">HHYE - </div>
                                <input type="text" class="form-control" id="otp" placeholder="Enter code here" maxlength="5" aria-describedby="otpHelp" required>
                                <div class="invalid-feedback">
                                    Please enter a valid OTP code
                                </div>
                            </div>

                            <div class="d-grid mt-3">
                                <button id="submit" disabled class="btn btn-primary mb-2" type="submit">Verify Code</button>
                                <button class="btn btn-default" type="button">Resend Code</button>
                            </div>

                            <div class="login-footer d-block d-md-none">
                                <p class="text-center text-small">
                                    Don’t have the app? Get it here
                                </p>
                                <div class="d-flex">
                                    <span class="mx-auto">
                                        <img class="me-1 googleplay-icon" src="assets/images/Google_Play_Arrow_logo.png" alt="">
                                        <img src="assets/images/googleplaytext.svg" alt="">
                                    </span>
                                </div>
                            </div>

                          </div>
                    </form>
                </div>

                <div class="col-md-6 login-col-right d-none d-md-flex">
                    <div class="outer my-auto">
                        <div class="or d-none d-md-flex">OR</div>
                        <div class="inner text-center d-flex right-col">
                            <span class="my-auto">
                                <img class="qr" src="assets/images/qr.svg" alt="">
                                <p class="m-0">
                                    Do you have the Hubtel app?
                                </p>
                                <p class="font-weight-bold m-0">
                                    <strong>Sign in faster via QR code</strong>
                                </p>
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </span>

    </div>
  

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

    $(function(){

        $('#otp').on('input',function(){
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');

            let numLength = parseInt($(this).val().length);
            if(numLength == 5){
                $('#submit').attr('disabled',false);
            }else{
                $('#submit').attr('disabled',true);
            }

            let num = $(this).val();
            if(!$.isNumeric(num)){
                $('#otp').addClass('is-invalid');
            }else{
                $('#otp').removeClass('is-invalid');
            }
        })

        $('#otpForm').submit(function(e){
            e.preventDefault();

            $.ajax({
                url: './api/validate-otp.php',
                dataType: "json",
                type: "Post",
                async: true,
                data: {'otp':$('#otp').val() },
                success: function (response) {
                    if(response.valid){
                        location.href="./welcome.php"
                    }else{
                        $('#otp').addClass('is-invalid');
                    }
                },
                error: function (xhr, exception) {
                    
                }
            }); 
        })
    });
</script>
</body>
</html>