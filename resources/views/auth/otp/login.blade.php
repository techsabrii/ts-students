<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/icon/logo.png') }}"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/icon/logo.png') }}"/>
    <title>TS-Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>




    <style>
        body{background-image:url({{ asset('img/hero-bg.jpg') }})}.height-100{height:100vh}.card{width:400px;border:none;height:350px;box-shadow: 0px 5px 40px 0px #4c5d6f;z-index:1;display:flex;justify-content:center;align-items:center}.card h6{color:red;font-size:20px}.inputs input{width:40px;height:40px}input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button{-webkit-appearance: none;-moz-appearance: none;appearance: none;margin: 0}.card-2{background-color:#fff;box-shadow: 0px 5px 40px 0px #4c5d6f;padding:10px;width:350px;height:100px;bottom:-50px;left:20px;position:absolute;border-radius:5px}.card-2 .content{margin-top:50px}.card-2 .content a{color:red}.form-control:focus{box-shadow:none;border:2px solid red}.validate{border-radius:20px;height:40px;background-color:red;border:1px solid red;width:140px}
    </style>
<body>


    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
                <h6>Please enter the one-time password <br> to verify your account</h6>
                <div>
                    <span>A code has been sent to</span>
                    <small>Your Email</small>
                </div>
                <form method="POST" action="{{ route('otp.verify.submit') }}">
                    @csrf
                    <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                        <input class="m-2 text-center form-control rounded" type="text" name="otp[0]" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" name="otp[1]" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" name="otp[2]" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" name="otp[3]" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" name="otp[4]" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" name="otp[5]" maxlength="1" />
                    </div>

                    <!-- Hidden input to store combined OTP -->
                    <input type="hidden" name="otp_combined" id="otp_combined" />

                    <div class="mt-4">
                        <button type="submit" class="btn btn-danger px-4 validate">Validate</button>
                    </div>
                </form>
            </div>

            <div class="card-2">
                @if(session('success'))
                    <div class="alert alert-success floating-alert" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger floating-alert" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="content d-flex justify-content-center align-items-center">
                    <span>Didn't get the code?</span>
                    <a href="{{ url('login')}}" class="text-decoration-none ms-3">Retry</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll('#otp input');
            const hiddenField = document.getElementById('otp_combined');

            // Function to handle OTP input and combine them
            function handleOTPInput() {
                inputs.forEach((input, index) => {
                    // Automatically focus on the next input field when a digit is entered
                    input.addEventListener('input', function() {
                        // Combine the values of all OTP input fields
                        let otp = '';
                        inputs.forEach(i => otp += i.value); // Combine all OTP digits

                        // Update hidden field with the combined OTP
                        hiddenField.value = otp;

                        // If current input has a value, focus on the next input field
                        if (input.value.length === 1 && index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    });

                    // Allow moving back to previous input when backspace is pressed
                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Backspace' && input.value === '') {
                            if (index > 0) {
                                inputs[index - 1].focus();
                            }
                        }
                    });
                });
            }

            handleOTPInput();
        });
    </script>

