<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Course Details">
    <meta name="keywords" content="Course, details, registration, fees">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Course Details</title>
    <link rel="icon" href="{{ asset('img/icon/logo.png') }}"/>

    <!-- Bootstrap 5 and Custom Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/hstyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.3rem;
            font-weight: bold;
        }
        .badge {
            font-size: 0.9rem;
        }
        .list-group-item {
            font-size: 1rem;
        }
        .btn-sm {
            font-size: 0.85rem;
        }
        .text-muted {
            color: #6c757d;
        }
        .accordion-button {
            font-size: 1.1rem;
            padding: 1rem;
        }
        .accordion-button:not(.collapsed) {
            background-color: #0d6efd;
            color: white;
        }
        .accordion-item {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 10px;
        }
        body {
            background-image: url({{ asset('img/hero-bg.jpg') }});
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .container-custom {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 30px;
        }
        .table th, .table td {
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal; /* Ensure wrapping of text */
            word-wrap: break-word; /* Break long words to avoid overflow */
        }
        .form-group input {
            font-size: 1rem;
        }
        .form-control {
            border-radius: 8px;
        }

        /* Ensure text wrapping for various elements */
        .table-responsive {
            overflow-x: auto;
        }

        .form-control {
            word-wrap: break-word; /* Ensure long words are broken */
        }

        /* Add more responsive styling if needed */
        @media (max-width: 767px) {
            .container-custom {
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .form-control {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 0.9rem;
            }

            h2 {
                font-size: 1.3rem;
            }

            .table th, .table td {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    @include('user.includes.header')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="container-custom shadow-lg">
                    <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Change Password</h2>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" id="old_password" name="old_password" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100">Update Password</button>
                        </div>
                    </form>

                    <!-- Display Active Sessions -->
                    <h2 class="text-center mb-4">Logged In Devices</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Device</th>
                                    <th>IP Address</th>
                                    <th>Location</th>
                                    <th>Logged In At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessionsWithLocation as $session)
                                    <tr>
                                        <td>{{ $session['user_agent'] }}</td>
                                        <td>{{ $session['ip_address'] }}</td>
                                        <td>{{ $session['location'] }}</td>
                                        <td>{{ $session['last_activity'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Log Out From All Devices Button -->
                    <form action="{{ route('logout.all') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Log Out From All Devices</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>  
</html>
