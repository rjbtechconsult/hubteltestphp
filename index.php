<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubtel | Login</title>
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
                        <h2 class="d-block d-md-none font-weight-700">Sign in with your phone number</h2>
                    </div>

                    <form id="loginForm" class="text-start needs-validation">
                        <div class="mb-3">

                            <label for="number" class="form-label">Login with your number <span class="text-danger">*</span></label>
                            <div class="input-group mb-4">
                                <div class="input-group-text">(+233) - </div>
                                <input type="tel" class="form-control" id="number" maxlength="10" aria-describedby="numberHelp">
                                <div class="invalid-feedback">
                                    Please enter a correct phone number
                                </div>
                            </div>
                           
                            <div class="d-grid mt-3">
                                <button id="submit" class="btn btn-primary" disabled type="submit">Login</button>
                            </div>
                            <div class="text-center text-md-end mt-2">
                                <small>Need help?</small>
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
  
  <!-- Modal -->
  <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body d-flex flex-column justify-content-center">
            <span class="d-flex flex-column">
                <span class="mx-auto mb-3">
                    <img class="info-icon" src="assets/images/info.svg" alt="">
                </span>
                <div class="mb-3 text-center">
                    <p class="mb-2">
                        (For Ghanaian users)
                    </p>
                    <p class="m-0">
                        Dial *713*90# to see the 4-digit OTP message to log in
                    </p>
                </div>
                <form action="./otp.php" class="col-11 col-md-10 align-self-center" id="otpForm">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Enter OTP Code</button>
                    </div>
                </form>
            </span>
        </div>
      </div>
    </div>
  </div>
  
    

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

    $(function(){

        $('#number').on('input',function(){
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');

            let numLength = parseInt($(this).val().length);
            if(numLength == 10){
                $('#submit').attr('disabled',false);
            }else{
                $('#submit').attr('disabled',true);
            }

            let num = $(this).val();
            if(!$.isNumeric(num)){
                $('#number').addClass('is-invalid');
            }else{
                $('#number').removeClass('is-invalid');
            }
        })

        $('#loginForm').submit(function(e){
            e.preventDefault();
            let form = $(this);

            if($('#number').val()==""){
                $('#number').addClass('is-invalid');
            }else{
                let valid = validatePhoneNumber($('#number').val());
                if(valid){

                    $.ajax({
                        url: './api/send-otp.php',
                        dataType: "json",
                        type: "Post",
                        async: true,
                        data: {'phoneNumber':$('#number').val() },
                        success: function (response) {
                            if(response.status === true){
                                $('#number').removeClass('is-invalid');
                                $('#otpModal').modal('show');
                            }
                        },
                        error: function (xhr, exception) {
                            
                        }
                    }); 

                   
                }else{
                    $('#number').addClass('is-invalid');
                }
            }
        })

        // $('#otpForm').submit(function(e){
        //     e.preventDefault();
        //     location.href = "./otp.html"
        // })

        function validatePhoneNumber(input_str) {
            var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

            return re.test(input_str);
        }

        function phonenumber(inputtxt){
            var phoneno = /^\d{10}$/;
            if(inputtxt.value.match(phoneno)){
                return true;
            }else{
                return false;
            }
        }


    });

</script>
</body>
</html>