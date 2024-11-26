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
    <style>
        .card {
  width: 350px;
  padding: 10px;
  border-radius: 20px;
  background: #fff;
  border: none;
  height: 350px;
  position: relative;

}

.container {
  height: 100vh;

}

body{background-image:url({{ asset('img/hero-bg.jpg') }})}
.mobile-text {
  color: #989696b8;
  font-size: 15px;
}

.form-control {
  margin-right: 12px;

}

.form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color: #ff8880;
  outline: 0;
  box-shadow: none;
}

.cursor {
  cursor: pointer;
}
    </style>
</head>
<body>



    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card py-5 px-3 " style="width: 100%; max-width: 400px; border-radius: 10px; box-shadow: 0px 5px 40px 0px #4c5d6f;">
            <h2 class="text-center m-0">Forget Password</h2>
            <p class="text-center mobile-text">Enter the email, and we will send an OTP to your email</p>
            <form method="POST" action="{{ route('otp.send') }}">
                @csrf
            <!-- Email Input Section -->
            <div class="d-flex flex-column mt-4">
                <input type="email" class="form-control mb-3" placeholder="Registered Email..." required name="email">
            </div>

            <!-- Send Button Section -->
            <div class="text-center mt-4">
                <button class="btn btn-primary font-weight-bold rounded-3 w-100" type="submit">Send</button>
            </div>
            </form>
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

            <!-- Reminder Text -->
            <div class="text-center mt-3">
                <span class="d-block mobile-text">Please check your email for the OTP.</span>
            </div>
        </div>
    </div>

    <!-- Optional: Adding Some CSS -->
    <style>
        .card {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .cursor {
            cursor: pointer;
        }

        .mobile-text {
            font-size: 14px;
            color: #6c757d;
        }

        /* Button customizations */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Ensure the button takes full width on mobile */
        @media (max-width: 767px) {
            .mobile-text {
                font-size: 12px;
            }

            .btn-primary {
                width: 100%;
            }
        }
    </style>
