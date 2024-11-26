<!-- resources/views/auth/password/reset.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} - Reset Password</title>

    <!-- Add your stylesheets -->
    <link rel="icon" href="{{ asset('img/icon/logo.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .wrong .fa-check {
            display: none;
        }

        .good .fa-times {
            display: none;
        }

        .valid-feedback,
        .invalid-feedback {
            margin-left: calc(2em + 0.25rem + 1.5rem);

        }
        body{
            background-image:url({{ asset('img/hero-bg.jpg') }});
        }
    </style>

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-5">
            <h2 class="text-center">Reset Password</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ request()->query('email') }}" />
                <!-- Password -->
                <div class="form-group">
                    <label for="password">New Password</label>
                    <div class="input-group d-flex">
                        <span class="input-group-text border-0" id="password">
                            <i class="fas fa-lock fa-2x me-1"></i>
                        </span>
                        <input type="password" class="form-control rounded mt-1" placeholder="Type your password" aria-label="password" aria-describedby="password" id="password-input" name="password" required>
                        <div class="valid-feedback">Good</div>
                        <div class="invalid-feedback">Wrong</div>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-group d-flex">
                    <span class="input-group-text border-0" id="password">
                        <i class="fas fa-lock fa-2x me-1"></i>
                    </span>
                    <input type="password" class="form-control rounded mt-1" id="password_confirmation" name="password_confirmation" placeholder="Type your password" required>
                </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>

                <!-- Password Requirements Alert -->
                <div class="col-12 mt-4 w-auto h-auto">
                    <div data-mdb-alert-init class="alert px-4 py-3 mb-0 d-none" role="alert" data-mdb-color="warning" id="password-alert">
                        <ul class="list-unstyled mb-0">
                            <li class="requirements leng">
                                <i class="fas fa-check text-success me-2"></i>
                                <i class="fas fa-times text-danger me-3"></i>
                                Your password must have at least 8 chars
                            </li>
                            <li class="requirements big-letter">
                                <i class="fas fa-check text-success me-2"></i>
                                <i class="fas fa-times text-danger me-3"></i>
                                Your password must have at least 1 uppercase letter.
                            </li>
                            <li class="requirements num">
                                <i class="fas fa-check text-success me-2"></i>
                                <i class="fas fa-times text-danger me-3"></i>
                                Your password must have at least 1 number.
                            </li>
                            <li class="requirements special-char">
                                <i class="fas fa-check text-success me-2"></i>
                                <i class="fas fa-times text-danger me-3"></i>
                                Your password must have at least 1 special character.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Submit Button -->

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
        </div>
    </div>

    <!-- Add JavaScript for validation -->
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            const password = document.getElementById("password-input");
            const passwordAlert = document.getElementById("password-alert");
            const requirements = document.querySelectorAll(".requirements");
            const leng = document.querySelector(".leng");
            const bigLetter = document.querySelector(".big-letter");
            const num = document.querySelector(".num");
            const specialChar = document.querySelector(".special-char");

            requirements.forEach((element) => element.classList.add("wrong"));

            password.addEventListener("focus", () => {
                passwordAlert.classList.remove("d-none");
                if (!password.classList.contains("is-valid")) {
                    password.classList.add("is-invalid");
                }
            });

            password.addEventListener("input", () => {
                const value = password.value;
                const isLengthValid = value.length >= 8;
                const hasUpperCase = /[A-Z]/.test(value);
                const hasNumber = /\d/.test(value);
                const hasSpecialChar = /[!@#$%^&*()\[\]{}\\|;:'",<.>/?`~]/.test(value);

                leng.classList.toggle("good", isLengthValid);
                leng.classList.toggle("wrong", !isLengthValid);
                bigLetter.classList.toggle("good", hasUpperCase);
                bigLetter.classList.toggle("wrong", !hasUpperCase);
                num.classList.toggle("good", hasNumber);
                num.classList.toggle("wrong", !hasNumber);
                specialChar.classList.toggle("good", hasSpecialChar);
                specialChar.classList.toggle("wrong", !hasSpecialChar);

                const isPasswordValid = isLengthValid && hasUpperCase && hasNumber && hasSpecialChar;

                if (isPasswordValid) {
                    password.classList.remove("is-invalid");
                    password.classList.add("is-valid");

                    requirements.forEach((element) => {
                        element.classList.remove("wrong");
                        element.classList.add("good");
                    });

                    passwordAlert.classList.remove("alert-warning");
                    passwordAlert.classList.add("alert-success");
                } else {
                    password.classList.remove("is-valid");
                    password.classList.add("is-invalid");

                    passwordAlert.classList.add("alert-warning");
                    passwordAlert.classList.remove("alert-success");
                }
            });

            password.addEventListener("blur", () => {
                passwordAlert.classList.add("d-none");
            });
        });
    </script>
</body>

</html>
